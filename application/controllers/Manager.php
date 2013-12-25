<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
class Manager extends Base {

    public $view = 'manager/private';
    public $controllerName = 'manager';
    public $breadcrumbs = array();
    public $authError = 'OK';

    private $publicPages = array("login", "logout", "signup", "signup_submit");
    
    function __construct()
    {
        parent::__construct();

        $this->title = sprintf("Панель менеджера. ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));

        $this->load->model('manager_private');
    }

    /*
     * Перед переходом на любую страницу ЛК
     * проверяем авторизацию пользователя
     */
    function _remap($method, $param)
    {
        if (in_array($method, $this->publicPages) || $this->session->userdata('logged_in') === true)
            call_user_func_array(array($this, $method), $param);
        else
            $this->authorization();
    }
    
    function authorization()
    {
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Вход для менеджера",
            'url'  => site_url('manager')
        );

        $this->content->view = 'manager/auth';
        $this->content->data->content_title->title = 'Панель менеджера';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->authError = $this->authError;

        $this->renderScene();
    }
    
    function login()
    {
        if ($this->session->userdata('logged_in') === true)
            $this->customRedirect('manager');

        if($this->input->post('login') && $this->input->post('pass'))
        {
            $password = $this->input->post('pass');
            $login = $this->input->post('login');
            $userInfo = $this->manager_private->manager($login);
            if (!$userInfo)
            {
                $this->authError = 'Пользователя с таким именем не существует';
                return $this->authorization();
            }
            if(md5($login.$password) === $userInfo->password && $userInfo->activity == 1)
            {
                $this->session->set_userdata('logged_in', true);
                $this->session->set_userdata('userid', $userInfo->id);
                $this->customRedirect('manager');
            }
            else
            {
                $this->authError = 'Введен неправильный логин или пароль';
                return $this->authorization();
            }
        }
        else
        {
            $this->authError = 'Введен неправильный логин или пароль';
            $this->authorization();
        }
    }

    function logout()
    {
        $this->session->set_userdata('logged_in',false);
        $this->session->unset_userdata('userid');
        $this->customRedirect('manager');
    }

    function signup($success = false)
    {
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Регистрация",
            'url'  => site_url('manager/signup')
        );

        if ($success)
            $this->content->view = 'manager/success-registration';
        else
            $this->content->view = 'manager/registration';

        $this->content->data->content_title->title = 'Панель менеджера';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->authError = $this->signupError;

        $this->renderScene();
    }

    function signup_submit()
    {
        $this->load->library('form_validation');

        $rules = array(
            array(
                'field'   => 'login',
                'label'   => 'Логин',
                'rules'   => 'trim|required|callback_check_login|xss_clean'
            ),
            array(
                'field'   => 'password',
                'label'   => 'Пароль',
                'rules'   => 'trim|required|matches[passconf]|min_length[6]'
            ),
            array(
                'field'   => 'passconf',
                'label'   => 'Подтверждение пароля',
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'email',
                'label'   => 'E-mail',
                'rules'   => 'trim|required|xss_clean'
            ),
            array(
                'field'   => 'phone',
                'label'   => 'Телефон',
                'rules'   => 'trim|required|xss_clean'
            )
        );

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == FALSE)
        {
            $this->signupError = $this->form_validation->error_string();
            $this->signup();
        }
        else
        {
            $this->load->model('Manager_model');
            $data = array(
                'name' => $this->input->post('username'),
                'login' => $this->input->post('login'),
                'password' => md5($this->input->post('login').$this->input->post('password')),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'comment' => $this->input->post('comment')
            );
            $this->Manager_model->insert($data);

            $this->customRedirect('manager/signup/success');
        }
    }

    function check_login($value)
    {
        $this->load->model('Manager_model');
        if (count($this->Manager_model->byName($value)) > 0)
        {
            $this->form_validation->set_message('check_login', 'Пользователем с таким логином уже существует');
            return false;
        }

        return true;
    }
   
    function index()
    {
        $this->clubs();
    }
        
    protected function deleteImage($club_id, $id) {
        if ($this->manager_private->deleteImage($id))
            echo json_encode(array("success"=>true));
        else
            echo json_encode(array("success"=>false, "data"=>"Не удалось удалить фотографию"));
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
    
    function club($clubId)
    {
        if (!$this->check_manager($clubId))
            $this->customRedirect('manager');

        $this->view = 'manager/private';

        $this->content->data->club = $this->manager_private->club($clubId);
        $this->content->data->cities = $this->manager_private->cities();

        $cityId = $this->content->data->club->cityid;
        $this->content->data->districts = $this->manager_private->districts($cityId);
        $this->content->data->services= $this->manager_private->services($clubId);

        $this->breadcrumbs[] = (object)array(
            'url' => base_url(),
            'name' => "Главная"
        );

        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array('manager/clubs')),
            'name' =>  "Панель менеджера"
        );

        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array($this->controllerName, 'club', $clubId)),
            'name' =>  $this->content->data->club->name
        );

        $this->content->view = $this->view;
        $clubName = $this->content->data->club->name;
        $this->content->data->content_title->title = $clubName;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }

    function photo($clubId)
    {
        if (!$this->check_manager($clubId))
            $this->customRedirect('manager');

        $this->view = "manager/photos";
        $images = $this->manager_private->getPhotosObject(site_url('manager/club/'.$clubId.'/photo'));
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
            'url'  =>  site_url(array($this->controllerName, 'club', $clubId, "photo")),
            'name' =>  "Фотографии клуба"
        );

        $this->content->view = $this->view;

        $this->content->data->club = $this->manager_private->club($clubId);
        $clubName = $this->content->data->club->name;
        $this->content->data->content_title->title = 'Фотографии клуба '.$clubName;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }

    function requests($clubId)
    {
        $this->content->data->club = $this->manager_private->club($clubId);
        $clubId = $this->content->data->club->id;
        $this->breadcrumbs[] = (object)array(
            'url' => base_url(),
            'name' => "Главная"
        );

        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array('manager/clubs')),
            'name' =>  "Панель менеджера"
        );

        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array($this->controllerName, 'club', $clubId)),
            'name' =>  $this->content->data->club->name
        );

        $this->breadcrumbs[] = (object)array(
            'url'  =>  site_url(array($this->controllerName, 'club', $clubId, 'requests')),
            'name' =>  'Заявки на абонементы'
        );
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->content_title->title = "Заявки на абонементы";
        $this->content->view = "manager/request";
        $this->renderScene();
    }

    function clubs()
    {
        $this->title = sprintf("%. Фитнес-клубы, описание, техника, видео. ФитПарк",
            "Панель менеджера");

        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Панель менеджера",
            'url'  => site_url(array('manager', 'clubs'))
        );

        $userId = $this->session->userdata('userid');
        if (!$userId)
            $this->logout();

        $this->content->view = 'manager/list';
        $this->content->data->content_title->title = "Список доступных клубов";
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->clubs = $this->manager_private->clubs($userId);
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
        if (!$this->check_manager($this->input->post('clubid')))
            $this->customRedirect('manager');

        $keys = array('name', 'site', 'phone', 'cityid', 'districtId', 'address', 'work_hours');
        $saveData = array();
        foreach ($keys as $k)
            $saveData[$k] = $this->input->post($k);
        echo json_encode(array('status' => $this->manager_private->updateCommon($saveData, $this->input->post('clubid'))));
    }
    
    function savePrices()
    {
        if (!$this->check_manager($this->input->post('clubid')))
            $this->customRedirect('manager');

        $keys = array('singlePrice', 'sub1', 'sub3', 'sub6', 'sub12');
        $saveData = array();
        foreach ($keys as $k)
            $saveData[$k] = $this->input->post($k);
        echo json_encode(array('status' => $this->manager_private->updateCommon($saveData, $this->input->post('clubid'))));
    }
    
    function saveDescription()
    {
        if (!$this->check_manager($this->input->post('clubid')))
            $this->customRedirect('manager');

        $saveData['description'] = $this->input->post('descript');
        echo json_encode(array('status' => $this->manager_private->updateCommon($saveData, $this->input->post('clubid'))));
    }
    
    function saveServices()
    {
        if (!$this->check_manager($this->input->post('clubid')))
            $this->customRedirect('manager');

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
        if (!$this->check_manager($this->input->post('clubId')))
            $this->customRedirect('manager');

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

    private function check_manager($clubId)
    {
        if (!$clubId)
            return false;

        if (!$this->session->userdata('userid'))
            return false;
        $userId = $this->session->userdata('userid');

        return $this->manager_private->owner($clubId) == $userId;
    }
}
?>
