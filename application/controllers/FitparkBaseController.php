<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FitparkBaseController extends CI_Controller {

    protected $allowedPages = array();
    protected $privateAllowedPages = array();

    // Name default view *.php
    protected $defaultPage = 'clubs/clubs';
    protected $titlePage = '';

    // Name header view and data
    protected $header = 'header';
    protected $headerData = array();

    // BreadCrumbs view and data
    protected $breadCrumbs = 'breadCrubms';
    protected $breadCrumbsData = array();

    // Name footer view and data
    protected $footer = 'footer';
    protected $footerData = array();

    // Name main view and data
    protected $view = '';
    protected $viewData = array();

    // DataBase model
    protected $baseModel;
    protected $addModel;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
        $this->load->library('session');

        $ci = &get_instance();
        $ci->load->model('grocery_CRUD_Model');
        $ci->load->model('my_model');
        $ci->load->model('fitpark_model');

        $this->baseModel = $ci->grocery_CRUD_Model;
        $this->addModel = $ci->my_model;
    }

    function init(){}
                
    function _remap($method, $param)
    {
        $pars = $this->uri->segment_array();    //unsetting uri last segments
        $cnt = count($pars);
        for($i = 1; $i < $cnt; $i++)
        {
            unset($pars[$i]);
        }
        $isPublicPage = in_array($method, $this->allowedPages);
        $isPrivatePage = in_array($method, $this->privateAllowedPages);
        $isLoggedIn = $this->session->userdata('logged_in') === true;

        if ($method != null)
        {
            if(($isLoggedIn && $isPrivatePage) || $isPublicPage)
            {
                call_user_func_array(array($this, $method), $pars);
            }
            else
            {
                echo 'HER!!!!!';
//                $this->auth();
            }
        }
        else
        {
            $this->toDefaultPage();
        }
    }

    public function index()
    {
        $this->init();
        $this->renderScene();
    }

    protected function toDefaultPage()
    {
        $this->renderScene($this->defaultPage);
    }

    // Before render scene check view-data variable for initialization
    protected function renderScene($view = null)
    {
        if($view == null)
            $view = $this->view;

        $this->load->view($this->header, $this->headerData);
        //$this->load->view($this->breadCrumbs, $this->breadCrumbsData);
        $this->load->view($view, $this->viewData);
        $this->load->view($this->footer, $this->footerData);
    }

}
?>
