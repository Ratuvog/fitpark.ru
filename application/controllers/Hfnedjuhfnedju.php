<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hfnedjuhfnedju extends CI_Controller {
	    
    private $baseModel = 0;
    private $currentTable = 'auth';
    private $state = array(
        'category' => array('Категории','service_category'),
        'filters' => array('Фильтры','fitnesclub_filter'),
        'cities' => array('Города','city'),
        'districts' => array('Районы','district'),
        'clubs' => array('Фитнес-клубы','fitnesclub'),
        'orders' => array('Порядок вывода клубов', 'orders'),
        'services' => array('Услуги клуба','fitnesclub_services'),
        'subscribes' => array('Абонементы','fitnesclub_subscribe'),
        'reviews' => array('Отзывы','fitnesclub_review'),
        'descriptions' => array('Описания','fitnesclub_description'),
        'photos' => array('Фотографии','fitnesclub_photo'),
        'order_list_active' => array('Заявки на изменение', ''),
        'club_changes' => array('Модерация изменений клуба', ''),
        'exercises'    => array('Упражнения','exercises'),
        'qa'           => array('Вопрос-ответ', 'QA'),
        'sales'           => array('Вопрос-ответ', 'sale'),
        'comments'     => array('Комментарии', 'fitnesclub_review'),
        'abonement'     => array('Заявка на абонемент', 'Abonements'),
        'feedback'     => array('Звонок в клуб', 'feedback'),
        'guest'     => array('Посетить клуб', 'guest'),
        'question'     => array('Вопрос менеджеру клуба', 'question'),
        'paidShows' => array('Платные показы', 'paidShows')
    );
    private $categoryName = 'Авторизация';
    
        function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
                $this->load->helper('image');
                
		$this->load->library('grocery_CRUD');
        $this->load->library('PHPExcel');
        $this->load->library('session');
        $this->load->library('image_CRUD');
        $this->load->library('image_Moo');

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

        $output = form_open(site_url('Hfnedjuhfnedju/login'));
        $userData = array('name' => 'username','placeholder' => 'Имя пользователя');
        $output .= form_input($userData);
        $passData = array('name' => 'password','placeholder' => 'Пароль');
        $output .= form_input($passData);
        $output .= form_submit('my_submit', 'Войти', 'class="btn btn-primary login-button"');

        $this->render((object)array('output' => $output, 'js_files' => array(), 'css_files' => array()));
    }

    function setCurentState($stateNum)
    {
        $this->categoryName = $this->state[$stateNum][0];
        $this->currentTable = $this->state[$stateNum][1];
    }
	
	function render($output = null, $view = 'admin/admin', $hasJsCss = true)
        {
            if(!$hasJsCss) {
                $output->css_files = array();
                $output->js_files = array();
            }
            
            $this->load->model('counters');
            $output->counters = $this->counters->get(array('city','fitnesclub','district','fitnesclub_services'));
            
            $this->load->model('buffer_club');
            $output->changeOrderCount = count($this->buffer_club->get('active'));
            
            $output->currentTable = $this->currentTable;
            $output->categoryName = $this->categoryName;
            
            $this->load->view($view, $output);	
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
            $config['allowed_types'] = 'xls';
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
        $this->load->library('extended_grocery_CRUD');
        $crud = new extended_grocery_CRUD();
        $crud->set_table($this->currentTable);

        $crud->set_field_upload('icon','assets/uploads/files');
        $crud->set_relation_n_n('promotion', 'cities_advertisement',
           'fitnesclub', 'city_id', 'club_id', 'name', 'priority', null, 'cityid'
        );

        $output = $crud->render();
        $this->render($output);
    }

    function exercise()
    {
        $this->setCurentState('exercises');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('typeId', 'exerciseType', 'name');
        $crud->set_field_upload('image','image/exercises');
        $crud->set_field_upload('image1', 'image/exercises');
        $crud->set_field_upload('image2', 'image/exercises');
        $crud->set_field_upload('image3', 'image/exercises');
        $crud->set_field_upload('image4', 'image/exercises');
        $crud->set_field_upload('image5', 'image/exercises');
        $this->render($crud->render());
    }

    function qa()
    {
        $this->setCurentState('qa');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('qathemeid', 'qatheme', 'name');
        $crud->set_relation('expertid', 'experts', 'name');
        $this->render($crud->render());
    }

    function sales()
    {
        $this->setCurentState('sales');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('clubId', 'fitnesclub', 'name');
        $crud->set_relation('cityId', 'city', 'name');
        $this->render($crud->render());
    }

    function comments()
    {
        $this->setCurentState('comments');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('fitnesclubid', 'fitnesclub', 'name');
        $this->render($crud->render());
    }
    function abonement()
    {
        $this->setCurentState('abonement');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('clubid', 'fitnesclub', 'name');
        $this->render($crud->render());
    }
    
    function feedback()
    {
        $this->setCurentState('feedback');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('clubid', 'fitnesclub', 'name');
        $this->render($crud->render());
    }
    function guest()
    {
        $this->setCurentState('guest');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('clubid', 'fitnesclub', 'name');
        $this->render($crud->render());
    }
       

    function question()
    {
        $this->setCurentState('question');
        $crud = new grocery_CRUD();
        $crud->set_table($this->currentTable);
        $crud->set_relation('clubid', 'fitnesclub', 'name');
        $this->render($crud->render());
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
                $crud->set_field_upload('head_picture','image/club');

                $crud->set_relation_n_n('services', 'fitnesclub_rel_services',
                'fitnesclub_services', 'clubId', 
                'serviceId', 'name', 'priority');
                
                $crud->set_relation('districtId', 'district', 'name');
                $crud->set_relation('cityid', 'city', 'name');
                
                $crud->add_action("Добавить фото", site_url('image/png/glyphicons_011_camera.png'),
                                  site_url('Hfnedjuhfnedju/photos/'), '');
                
                $output = $crud->render();
                $this->render($output);
        }

        function services()
        {
                $this->setCurentState('services');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_field_upload('icon','image/services_icon');
                $output = $crud->render();
                $this->render($output);
        }

        function paidShows()
        {
            $this->setCurentState('paidShows');
            $crud = new grocery_CRUD();
            $crud->set_table($this->currentTable);
            $crud->set_relation('clubId','fitnesclub','name');
            $crud->set_relation('paidBlockId','paidBlocks','name');
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
                $image_crud = new image_CRUD();
                $this->setCurentState('photos');
                $image_crud->set_table($this->currentTable);

                $image_crud->set_primary_key_field('id');
                $image_crud->set_url_field('photo');
                $image_crud->set_image_path('image/club');
                $image_crud->set_title_field('title');
                $image_crud->set_relation_field('fitnesclubid');
                $output = $image_crud->render();
                $this->render($output);
        }
        
        function orders()
        {
                $this->setCurentState('orders');
                $crud = new grocery_CRUD();
                $crud->set_table($this->currentTable);
                $crud->set_relation_n_n('Fitnesclubs', 'order_list',
                        'fitnesclub','orderId',
                        'clubId','name','priority');
                $crud->fields("name", "active", "Fitnesclubs");
                
                $output = $crud->render();
                $this->render($output);
        }
        
        function order_list_active()
        {
            $this->setCurentState('order_list_active');
            
            $this->load->model('buffer_club');
            $output->changes = $this->buffer_club->get('active');
            $output->changes_rejected = $this->buffer_club->get('reject');
            $output->changes_aproved = $this->buffer_club->get('aprove');
            
            $output->states = $this->buffer_club->states();
            
            $this->load->model('city');
            $output->cities = $this->city->map();
            
            $this->load->model('Manager_model');
            $output->manager = $this->Manager_model->map();

            $this->render($output, 'admin/change_list', false);
        }
        
        function order_list_all()
        {
            $this->setCurentState('order_list_active');
            
            $this->load->model('buffer_club');
            $output->changes = $this->buffer_club->get();
            
            $output->states = $this->buffer_club->states();
            
            $this->load->model('city');
            $output->cities = $this->city->map();
            
            $this->load->model('Manager_model');
            $output->manager = $this->Manager_model->map();

            $this->render($output, 'admin/change_list_all', false);
        }
        
        function club_changes($club)
        {
            $this->setCurentState('club_changes');
            
            $this->load->model('buffer_club');
            $output->club = $this->buffer_club->byId($club);
            
            $this->load->model('city');
            $output->cities = $this->city->map();
            
            $this->load->model('district');
            $output->districts = $this->district->map();
            
            $this->load->model('buf_club_service');
            $output->club_services = $this->buf_club_service->byClub($club);
            
            $this->load->model('service');
            $output->services = $this->service->map();

            $image_crud = new image_CRUD();

            $image_crud->set_table("fitnesclub_photo");
            $image_crud->set_primary_key_field('id');
            $image_crud->set_url_field('photo');
            $image_crud->set_thumbnail_prefix("");
            $image_crud->set_image_path('image/club');
            $image_crud->set_relation_field('fitnesclubid');

            $output->images = $image_crud->render();

            $this->load->model('Manager_model');
            $output->manager = $this->Manager_model->map();

            $this->render($output, 'admin/club_changes', false);
        }
        
        function changes_aproved($club)
        {
            $this->load->model('buffer_club');
            $buf = $this->buffer_club->byId($club, false);
            
            $this->load->model('club_model');
            $this->club_model->updateFromBuffer($buf);
            
            $this->load->model('buf_club_service');
            $buf_services = $this->buf_club_service->byClub($club);
            
            $this->load->model('service');
            $this->service->updateFromBuffer($buf_services, $club);
            
            $this->load->model('photo');
            $this->photo->updateFromBuffer($club);
            
            $status = array('state' => 2, 'comment' => '');
            $this->buffer_club->setData($club, $status);
            redirect(site_url('Hfnedjuhfnedju/order_list_active'));          
        }
        
        function changes_rejected($club)
        {
            $this->load->model('buffer_club');
            $status = array('state' => 3, 'comment' => $this->input->post('comment'));
            $this->buffer_club->setData($club, $status);

            redirect(site_url('Hfnedjuhfnedju/order_list_active'));          
        }
                
        function index()
        {
                redirect('Hfnedjuhfnedju/clubs');
        }
}
?>