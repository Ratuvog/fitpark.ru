<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');
class ManagerPrivate extends FitparkBaseController {

    protected $clubId = 0;
    private $categoryName = 'Личный кабинет';
    private $controllerName = 'ManagerPrivate';
    private $authError = 'OK';
    function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
        $this->load->library('session');
        $this->load->library('image_CRUD');
        
        $this->load->model('manager_private');
        
        $this->init();
    }
    
    function  init()
    {
        $this->breadCrumbsData[] = array(
            'href'  => site_url(array($this->controllerName)),
            'title' => 'Личный кабинет'
        );
    }
            
    function _remap($method, $param) 
    {
        $pars = $this->uri->segment_array();    //unsetting uri last segments
        unset($pars[1]);
        unset($pars[2]);

        if ($method != null && $this->session->userdata('logged_in') === true || $method === 'login')
            call_user_func_array(array($this, $method), $pars);
        else
            $this->auth();
    }
    
    function auth()
    {
        $this->view = 'manager/auth'; // by default
        $this->categoryName = "Авторизация";

        $this->viewData['categoryName'] = $this->categoryName;
        $this->viewData['authError'] = $this->authError;
        
        $this->headerData['titleText'] = "ФитПарк. Личный кабинет.";
        
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
    
    function club($clubId)
    {
        if(!$clubId)
            $this->clubs();
        
        $userId = $this->session->userdata('userid');
        if(!$userId)
            return $this->auth();
        
        if($this->manager_private->owner($clubId) != $userId)
            $this->clubs();
        
        $this->view = 'manager/private';
        
        $this->viewData['club'] = $this->manager_private->club($clubId);
        $this->viewData['cities'] = $this->manager_private->cities();
        
        $cityId = $this->viewData['club'][0]->cityid;
        $this->viewData['ditricts'] = $this->manager_private->districts($cityId);

        $this->categoryName = $this->viewData['club'][0]->name;
        $this->viewData['categoryName'] = $this->categoryName;
        $this->headerData['titleText'] = "ФитПарк. Личный кабинет. ".$this->categoryName;
        $this->breadCrumbsData[] = array(
            'href'  =>  site_url(array($this->controllerName, 'club', $clubId)),
            'title' =>  $this->categoryName
        );

        $this->renderScene();
    }
    
    function clubs()
    {
        $userId = $this->session->userdata('userid');
        if(!$userId)
            return $this->auth();

        $this->view = 'manager/list';
        
        $this->categoryName = 'Cписок клубов';
        $this->viewData['categoryName'] = $this->categoryName;
        $this->headerData['titleText'] = "ФитПарк. Личный кабинет.";
        
        $this->breadCrumbsData[] = array(
            'href'  => site_url(array($this->controllerName, 'clubs')),
            'title' => $this->categoryName
        );
        
        $this->viewData['clubs'] = $this->manager_private->clubs($userId);
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
    
}
?>
