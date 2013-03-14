<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	    
    private $baseModel = 0;
    private $currentTable = 'auth';
    private $state = array(
        'category' => array('Категории','service_category'),
        'filters' => array('Фильтры','fitnesclub_filter'),
        'cities' => array('Города','city'),
        'districts' => array('Районы','district'),
        'clubs' => array('Фитнес-клубы','fitnesclub'),
        'services' => array('Услуги клуба','fitnesclub_services'),
        'subscribes' => array('Абонементы','fitnesclub_subscribe'),
        'reviews' => array('Отзывы','fitnesclub_review'),
        'descriptions' => array('Описания','fitnesclub_description'),
        'photos' => array('Фотографии','fitnesclub_photo')
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
        
	/*function categories()
	{
                $this->setCurentState('category');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
		$crud->set_field_upload('icon','assets/uploads/files');
                
                $crud->set_relation_n_n('Фильтры', '',
                    $this->currentTable, 'categoryid', 
                    'optionid', 'name', 'priority');
                
                $crud->set_relation_n_n('item', 'ref_category_item',
                'fitnesclub', 'categoryid', 
                'itemid', 'name', 'priority');
                
                $output = $crud->render();
		$this->render($output);
                
	} */
        
        function filters()
	{
                $this->setCurentState('filters');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);           
		$crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
	}
	
        function cities()
        {
                $this->setCurentState('cities');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                
                $crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
        }
        
        function districts()
	{
                $this->setCurentState('districts');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('cityid', 'city', 'name');
                $crud->set_field_upload('icon','assets/uploads/files');
                
		$output = $crud->render();
		$this->render($output);
	}
        
        function clubs()
        {
                $this->setCurentState('clubs');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                
                $crud->set_field_upload('icon','assets/uploads/files');
                $crud->set_field_upload('head_picture','assets/uploads/files');
                
                $crud->set_relation_n_n('services', 'fitnesclub_rel_services',
                'fitnesclub_services', 'clubId', 
                'serviceId', 'name', 'priority');
                
                $crud->set_relation('districtId', 'district', 'name');
                
                $output = $crud->render();
                $this->render($output);
        }

        function services()
        {
                $this->setCurentState('services');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $output = $crud->render();
                $this->render($output);
        }
        
        function subscribes()
        {
                $this->setCurentState('subscribes');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $output = $crud->render();
                $this->render($output);
        }

        function reviews()
        {
                $this->setCurentState('reviews');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('fitnesclubid','fitnesclub','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function descriptions()
        {
                $this->setCurentState('descriptions');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('clubid','fitnesclub','name');
                $output = $crud->render();
                $this->render($output);
        }
        
        function photos()
        {
                $this->setCurentState('photos');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation('fitnesclubid','fitnesclub','name');
                $crud->set_field_upload('photo','assets/uploads/files');
                $output = $crud->render();
                $this->render($output);
        }
            
        function index()
	{
            $this->clubs();
	}		
}
?>