<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	    
    private $baseModel = 0;
    private $currentTable = 'auth';
    private $state = array(
        0 => array('Категории','service_category'),
        1 => array('Опции фильтрации','category_options'),
        2 => array('Значения опций','options_value'),
        3 => array('Элементы категорий(контент)','sale_item'),
        4 => array('Группы','item_group'),
        5 => array('Описания элементов','item_description'),
        6 => array('Новости элементов','item_news'),
        7 => array('Отзывы элементов','item_review'),
        8 => array('Скидки элементов','item_discount'),
        9 => array('Фото элементов','item_photo'),
        10 => array('Рейтинг элементов','item_rating')
    );
    private $categoryName = 'Авторизация';
    
        function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('grocery_CRUD');
                $this->load->library('PHPExcel');
                $this->load->library('session');
                
                $ci = &get_instance();
                $ci->load->model('grocery_CRUD_Model');
                $this->baseModel = $ci->grocery_CRUD_Model;
            
	}
        
        function _remap($method, $param)
        {
            $pars = $this->uri->segment_array();    //unsetting uri last segments
            unset($pars[1]);
            unset($pars[2]);

            if ($method != null && $this->session->userdata('logged_in') === true || $method === 'login')
            {
                call_user_func_array(array($this, $method), $pars);
            }
            else
            {
                $this->auth();
            }
        }
        
        function login()
        {
            if(isset($_POST['username']) && isset($_POST['password']))
            {
                $login = $_POST['username'];
                $password = $_POST['password'];
                if(md5($login.$password) === md5('admin40000monkeybananapushintheasshole'))
                {
                    $this->session->set_userdata('logged_in',true);
                    $this->index();
                }
            }
            else
            {
                echo "Ошибка входа: Имя пользователя и пароль не должны быть пустыми.";
                $this->auth();
            }
        }
        
        function logout()
        {
            $this->session->set_userdata('logged_in',false);
            $this->auth();
        }

        function auth()
        {
            $this->load->helper('form');
            
            $output = form_open('admin/login');
            $userData = array('name' => 'username','placeholder' => 'Имя пользователя');
            $output .= form_input($userData);
            $passData = array('name' => 'password','placeholder' => 'Пароль');
            $output .= form_input($passData);
            $output .= form_submit('my_submit', 'Войти');
            
            $this->render((object)array('output' => $output, 'js_files' => array(), 'css_files' => array()));
        }

        function setCurentState($stateNum)
        {
            $this->categoryName = $this->state[$stateNum][0];
            $this->currentTable = $this->state[$stateNum][1];
        }
	
	function render($output = null)
        {
            $output->currentTable = $this->currentTable;
            $output->categoryName = $this->categoryName;
            $this->load->view('admin.php',$output);	
	}
	
        function import()
        {
            if(!isset($_POST['table']) || !$this->baseModel->db_table_exists($_POST['table']))
            {
                echo "Table not found";
                return;
            }
            $table = $_POST['table'];
            $config['upload_path'] = 'assets/uploads/';
            $config['allowed_types'] = 'xls|xlsx';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload())
            {
                $data = array('upload_data' => $this->upload->data());
            }
            else
            {
                echo "Upload failed:";
                echo $this->upload->display_errors();
            }
            if(!isset($data['upload_data']['full_path']))        
                return;
            
            $path = $data['upload_data']['full_path'];
            $inputFileType = 'Excel5';
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($path);

            $this->baseModel->set_basic_table($table);
            $filedSet = $this->baseModel->get_field_types($table);

            $worksheet = $objPHPExcel->getWorksheetIterator()->current();
            $highestRow         = $worksheet->getHighestRow();

            for ($row = 2; $row <= $highestRow; ++ $row)
            {
                $fieldCounter = 0;
                $valueSet = array();
                $emptyCol = 0;
                foreach ($filedSet as $filed)
                {
                    $columnHeader = $worksheet->getCellByColumnAndRow($fieldCounter, 1);
                    $cell = $worksheet->getCellByColumnAndRow($fieldCounter, $row);
                    if($columnHeader->getValue() != NULL)
                    {
                        if($cell->getValue() != NULL)
                            $valueSet[$columnHeader->getValue()] = $cell->getValue();
                        else
                        {
                            $valueSet[$columnHeader->getValue()] = '';
                            $emptyCol++;
                        }
                    }
                    $fieldCounter++; 
                }
                if(count($valueSet) != 0 && $emptyCol != $fieldCounter)
                    $this->baseModel->db_insert($valueSet);
            }   
            $pa = "<script> document.location.href = '".$_SERVER['HTTP_REFERER']."' </script>";
            echo $pa;
        }
        
	function categories()
	{
                $this->setCurentState(0);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
		$crud->set_field_upload('icon','assets/uploads/files');
                
                $crud->set_relation_n_n('options', 'ref_category_options',
                    'category_options', 'categoryid', 
                    'optionid', 'name', 'priority');
                
                $crud->set_relation_n_n('item', 'ref_category_item',
                'sale_item', 'categoryid', 
                'itemid', 'name', 'priority');
                
                $output = $crud->render();
		$this->render($output);
                
	}
        
        function options()
	{
                $this->setCurentState(1);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                
                $crud->set_relation_n_n('value', 'ref_option_value',
                'options_value', 'optionid', 
                'valueid', 'name', 'priority');
                
		$crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
	}
	
        function values()
	{
                $this->setCurentState(2);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                
                $crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
	}
        
        function items()
        {
                $this->setCurentState(3);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                
                $crud->set_field_upload('icon','assets/uploads/files');
                $crud->set_field_upload('head_picture','assets/uploads/files');
                
                $crud->set_relation_n_n('groups', 'ref_item_group',
                'item_group', 'itemid', 
                'groupid', 'name', 'priority');
                
                $crud->set_relation_n_n('option_values', 'ref_item_optionvalue',
                'options_value', 'itemid', 
                'valueid', 'name', 'priority');
                
                $crud->set_relation_n_n('discounts', 'ref_item_discount',
                'item_discount', 'discountid', 
                'itemid', 'name', 'priority');
                
                $output = $crud->render();
                $this->render($output);
        }

        function descriptions()
        {
                $this->setCurentState(5);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function news()
        {
                $this->setCurentState(6);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }

        function reviews()
        {
                $this->setCurentState(7);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function discounts()
        {
                $this->setCurentState(8);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $output = $crud->render();
                $this->render($output);
        }
        
        function photos()
        {
                $this->setCurentState(9);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('itemId','sale_item','name');
                $crud->set_field_upload('photo','assets/uploads/files');
                $output = $crud->render();
                $this->render($output);
        }
        
        function item_ratings()
        {
                $this->setCurentState(10);
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('itemId','sale_item','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function groups()
        {
            $this->setCurentState(4);
            $crud = new grocery_CRUD();
            $crud->set_table($this->currentTable);
            $crud->set_field_upload('icon','assets/uploads/files');
            $output = $crud->render();
            $this->render($output);
        }
        
        function index()
	{
            $this->categories();
	}	
	
	function offices_management()
	{
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
			
			$output = $crud->render();
			
			$this->_example_output($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			
			$crud->required_fields('lastName');
			
			$crud->set_field_upload('file_url','assets/uploads/files');
			
			$output = $crud->render();

			$this->_example_output($output);
	}
	
	function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
			
			$output = $crud->render();
			
			$this->_example_output($output);
	}	
	
	function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->_example_output($output);
	}
	
	function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			
			$output = $crud->render();
			
			$this->_example_output($output);
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
	function film_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');
		
		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		
		$output = $crud->render();
		
		$this->_example_output($output);
	}
	
}
?>