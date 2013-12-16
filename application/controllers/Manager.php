<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
class Manager extends Base {

    public $view = 'manager/private';
    public $controllerName = 'Manager';
    public $breadcrumbs = array();
    public $authError = 'OK';
    
    function __construct()
    {
        parent::__construct();
//        $this->breadcrumbs []= (object)array(
//            'name' => "Главная",
//            'url' => base_url()
//        );
//
//        $this->breadcrumbs []= (object)array(
//            'name' => "Личный кабинет",
//            'url' => ""
//        );
        $this->load->model('manager_private');
    }

    /*
     * Перед переходом на любую страницу ЛК
     * проверяем авторизацию пользователя
     */
    function _remap($method, $param) 
    {
        if($this->session->userdata('logged_in') === true || $method === 'login')
            call_user_func_array(array($this, $method), $param);
        else
            $this->auth();
    }
    
    function auth()
    {
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Вход менеджерам клубов",
            'url'  => site_url('sales')
        );
        $this->content->view = 'manager_in';
        $this->content->data->content_title->title = 'Менеджерам клубов';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->authError = $this->authError;
        $this->renderScene();
    }
    
    function login()
    {
        if($this->input->post('login') && $this->input->post('pass'))
        {
            $login = $this->input->post('login');
            $password = $this->input->post('pass');
            $userInfo = $this->manager_private->manager($login);
            if(!$userInfo) 
            {
                $this->authError = 'Пользователя с таким именем не существует';
                return $this->auth();
            }
            
            if(md5($login.$password) === $userInfo->password)
            {
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('userid', $userInfo->id);
                $this->index();
            }
            else
            {
                $this->authError = 'Введен неправильный логин или пароль';
                return $this->auth();
            }
        }
        else
        {
            $this->authError = 'Введен неправильный логин или пароль';
            $this->auth();
        }
    }

    function logout()
    {
        $this->session->set_userdata('logged_in',false);
        $this->session->unset_userdata('userid');
        $this->auth();
    }
   
    function index()
    {
        $this->clubs();
    }
        
    protected function deleteImage($id) {
        $this->manager_private->deleteImage($id);
        $this->customRedirect(site_url(array("Manager","getClub", $club->id, "photo")));
        echo json_encode(array("success"=>TRUE));
    }
        
    protected function uploadFile($clubId)
    {
        $uploadPath = $_SERVER["DOCUMENT_ROOT"]."/".$this->config->item("images_club_path").
                      $_FILES['qqfile']['name'];
        if(move_uploaded_file($_FILES['qqfile']['tmp_name'],$uploadPath)) {
            $this->manager_private->insertImage($_FILES['qqfile']['name'], $clubId);
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }
    
    function getClub($clubId = 0 , $tab = "base")
    {
        if($clubId == "delete_file") {
            return $this->deleteImage($tab);
        }

        if($clubId =="upload_file" ) {
            return $this->uploadFile($tab);
        }
        if(!$clubId)
            return $this->clubs();

        $userId = $this->session->userdata('userid');
        if(!$this->session->userdata('userid'))
            return $this->logut();

        if($this->manager_private->owner($clubId) != $userId)
            return $this->clubs();

        $this->view = 'manager/private';

        $this->content->data->club = $this->manager_private->club($clubId);
        $this->content->data->cities = $this->manager_private->cities();

        $cityId = $this->content->data->club->cityid;
        $this->content->data->districts = $this->manager_private->districts($cityId);
        $this->content->data->services= $this->manager_private->services($clubId);
        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array('Manager/clubs')),
            'name' =>  "Панель менеджера"
        );

        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array($this->controllerName, 'getClub', $clubId)),
            'name' =>  $this->content->data->club->name
        );

        if(isset($tab) && $tab == "photo") {
            $this->renderPhoto($clubId);
        } else {
            $this->renderBaseInfo($clubId);
        }
    }

    private function renderPhoto($clubId) {

        $this->view = "manager/photos";
        $images = $this->manager_private->getPhotosObject($clubId);
        $output = $images->render();
        foreach ($output->css_files as $file) {
            $fileArray = explode("/",$file);

            array_splice($fileArray, 0,3);

            $this->css_files[] = implode("/",$fileArray);
        }

        foreach ($output->js_files as $file) {
            $fileArray = explode("/",$file);
            array_splice($fileArray, 0,3);
            $this->js_files[] = implode("/",$fileArray);
        }

        $this->content->data->output = $output;
        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array($this->controllerName, 'getClub', $clubId, "photo")),
            'name' =>  "Фотографии клуба"
        );
        $this->content->view = $this->view;
        $this->content->data->content_title->title = 'Фото клуба клубов';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }

    private function renderBaseInfo($clubId) {

//        $this->headerData['titleText'] = "ФитПарк. Личный кабинет. ".$this->categoryName;
        $this->content->view = $this->view;
        $this->content->data->content_title->title = 'Базовая информация списка клубов';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }

    function clubs()
    {
        $this->title = sprintf("%s, описание, техника, видео. ФитПарк",
            "хер");

        $this->description = sprintf("%s. Подробное описание, порядок выполнения, нюансы упражнения, видео.",
            "хур");

        $this->keywords = "хер";

        $this->breadcrumbs []= (object)array(
            'name' => "Панель менеджера",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Спиосок клубов",
            'url'  => site_url('manager')
        );

        $userId = $this->session->userdata('userid');
        if(!$userId)
            return $this->auth();

        $this->content->view = 'manager/list';
        $this->content->data->content_title->title = "Список доступных клубов";
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->clubs = $this->manager_private->clubs($userId);
        $this->renderScene();
    }
    
    function photo($clubId)
    {
        $userId = $this->session->userdata('userid');
        if(!$userId)
            return $this->auth();

        if($this->manager_private->owner($clubId) != $userId)
            return $this->clubs();
        
        $image_crud_cur = new image_CRUD();
        $image_crud_cur->set_table('fitnesclub_photo');
        $image_crud_cur->set_primary_key_field('id');
        $image_crud_cur->set_url_field('photo');
        $image_crud_cur->set_image_path('image/club/');
        $image_crud_cur->set_relation_field('fitnesclubid');
        
        $this->content->data->cur_photos = $image_crud_cur->render();
        
        $this->view = 'manager/photos';
        
        $this->content->data->club = $this->manager_private->club($clubId);
        $this->breadcrumbs[] = array(
            'url'  => site_url(array($this->controllerName, 'photo', $clubId)),
            'name' => 'Фотографии'
        );
        $this->content->view = $this->view;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;

        $this->renderScene();
    }

    /*Ajax functions*/
    function districts()
    {
        $cityId = $this->input->post('cityId');
        if(!$cityId)
            return json_encode(array('status'=>'ERR'));
        
        echo json_encode(array('status' => 'OK', 'msg' => $this->manager_private->districts($cityId)));
    }
    
    function saveCommon()
    {
        $keys = array('name', 'site', 'phone', 'cityid', 'districtId', 'address', 'work_hours');
        $saveData = array();
        foreach ($keys as $k)
            $saveData[$k] = $this->input->post($k);
        echo json_encode(array('status' => $this->manager_private->updateCommon($saveData, $this->input->post('clubid'))));
    }
    
    function savePrices()
    {
        $keys = array('singlePrice', 'sub1', 'sub3', 'sub6', 'sub12');
        $saveData = array();
        foreach ($keys as $k)
            $saveData[$k] = $this->input->post($k);
        echo json_encode(array('status' => $this->manager_private->updateCommon($saveData, $this->input->post('clubid'))));
    }
    
    function saveDescription()
    {
        $saveData['description'] = $this->input->post('descript');
        echo json_encode(array('status' => $this->manager_private->updateCommon($saveData, $this->input->post('clubid'))));
    }
    
    function saveServices()
    {
        $services = array();
        foreach(array_keys($_POST) as $key)
        {
            $pos = stripos($key, "serv");
            if($pos !== false)
                $services[substr($key, 4)] = $_POST[$key];
        }
        echo json_encode(array('status' => $this->manager_private->updateServices($services, $this->input->post('clubid'))));
    }
    
    function lastTimeUpdate()
    {
        echo json_encode($this->manager_private->lastTimeUpdate($this->input->post('clubid')));
    }

    function logoUpload() {
        $uploadPath =$_SERVER["DOCUMENT_ROOT"]."/".
                     $this->config->item("images_club_path").$_FILES['files']['name'][0];
        if(move_uploaded_file($_FILES['files']['tmp_name'][0],$uploadPath)) {
            $clubId = $this->input->post("clubId");
            $this->manager_private->updateHeadImage($clubId,$_FILES['files']['name'][0]);
            echo json_encode(array("success" => true));
        } else {
            echo json_encode(array("success" => false));
        }
    }
    
}
?>
