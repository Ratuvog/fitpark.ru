<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FitparkBaseController extends CI_Controller {

    protected $allowedPages = array();
    protected $privateAllowedPages = array();
    
    // Name default view *.php
    protected $defaultPage = 'club';
    protected $titlePage = 'club';
    
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

    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    /**/
    function init()
    {
        
    }

    function _remap($method, $param)
    {
        $pars = $this->uri->segment_array();    //unsetting uri last segments
        unset($pars[1]);
        unset($pars[2]);

        $isPublicPage = in_array($method, $this->privateAllowedPages);
        $isPrivatePage = in_array($method, $this->allowedPages);
        $isLoggedIn = $this->session->userdata('logged_in') === true;
        
        if ($method != null)
        {
            if(($isLoggedIn && $isPrivatePage) || $isPublicPage)
            {
                call_user_func_array(array($this, $method), $pars);
            }
            else
            {
                $this->auth();
            }
        }
        else
        {
            $this->toDefaultPage();
        }
    }
    
    public function index()
    {
        $this->renderScene();
    }
    
    private function toDefaultPage()
    {
        $this->renderScene($this->defaultPage);
    }
    
    // Before render scene check view-data variable for initialization
    private function renderScene($view = null)
    {
        if($view == null)
            $view = $this->view;
        
        $this->load->view($this->header, $this->headerData);
        $this->load->view($this->breadCrumbs, $this->breadCrumbsData);
        $this->load->view($view, $this->viewData);
        $this->load->view($this->footer, $this->footerData);
    }

}
?>
