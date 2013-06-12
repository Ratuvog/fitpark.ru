<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class FitparkBaseController extends CI_Controller {

    protected $allowedPages = array();
    protected $privateAllowedPages = array();

    // Name default view *.php
    protected $defaultPage = 'clubs/clubs';
    protected $titlePage = 'nothing';

    // Name header view and data
    protected $header = 'header';
    protected $headerData = array('titleText'=>"ФитПарк. Фитнес клубы Самары, тренажерные залы,
            фитнес центры, отзывы, стоимость, рейтинги, акции, скидки.");

    // BreadCrumbs view and data
    protected $breadCrumbs = 'breadcrumbs';
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

    // Название пустого фото
    protected $emptyPhoto = "no-foto.jpg";

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
        $this->load->library('session');
        $this->load->library('idna_convert');
        $ci = &get_instance();
        $ci->load->model('grocery_CRUD_Model');
        $ci->load->model('my_model');
        $ci->load->model('fitpark_model');

        $this->baseModel = $ci->grocery_CRUD_Model;
        $this->addModel = $ci->my_model;

        $this->breadCrumbsData[] = array(
            'href'  => base_url(),
            'title' => 'Главная'
        );
        $this->breadCrumbsData[] = array(
            'href'  =>  site_url(array('clubs')),
            'title' => 'Список клубов'
        );
        /*
         * Текущий город
         */
        $this->headerData['currentCity'] = $this->fitpark_model->getCity($this->getCity());
        /*
         * В данном случае сессии использованы только лишь в качестве этакого менеджера настроек
         * который доступен во все приложении
         */
        $this->session->set_userdata("city",$this->headerData['currentCity']->id);

        /*
        * Доступные города
        */
        $this->headerData['availableCity'] = $this->fitpark_model->getAvailableCity();

        if($this->idna_convert->decode($_SERVER["HTTP_HOST"])!=$this->headerData['currentCity']->url)
            $this->customRedirect(prep_url($this->headerData['currentCity']->url));
    }

    private function getCity()
    {
        $this->load->helper("geolocation");
        $host = $this->idna_convert->decode($_SERVER["HTTP_HOST"]);
        $hostArray = explode('.', $host);
        if(count($hostArray)!=3) {
            return getCityFromIp($this->input->ip_address());
        } else {
            return $hostArray[0];
        }
    }

    function init(){
    }

    function _remap($method, $param)
    {
        $pars = $this->uri->segment_array();    //unsetting uri last segments
        $cnt = count($pars);
        for($i = 1; $i < $cnt; $i++)
        {
            unset($pars[$i]);
        }
        call_user_func_array(array($this, $method), $pars);
    }

    public function show404()
    {
        $this->output->set_status_header('404');
        $this->customRedirect('override_404');
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

    protected function customRedirect($url)
    {
        $this->load->view("customRedirect", array("redirectUrl"=>$url));
    }

    // Before render scene check view-data variable for initialization
    protected function renderScene($view = null)
    {
        if($view == null)
            $view = $this->view;
        if($this->header)
            $this->load->view($this->header, $this->headerData);
        if($this->breadCrumbs)
            $this->load->view($this->breadCrumbs, array("stack" => $this->breadCrumbsData) );
        if($view)
            $this->load->view($view, $this->viewData);
        if($this->footer)
            $this->load->view($this->footer, $this->footerData);
    }

    protected function initBreadCrumbs()
    {
        $stack = (array)$this->session->userdata('breadcrumbs');
        $newstack = array();
        foreach ($stack as $item)
        {
            if($item === $this->titlePage)
                break;

            if($item != 0)
                array_push($newstack, $item);
        }

        array_push($newstack, $this->titlePage);
        $this->session->set_userdata('breadcrumbs', $newstack);
        return array('stack' => $newstack);
    }

    protected function setEmptyPhoto($inData) {
        foreach ($inData as &$data) {
            foreach ($data as $key=>$value) {
                if($key=="head_picture") {
                    if(!$data[$key])
                        $data[$key] = site_url(array("image",  $this->emptyPhoto));
                    else
                        $data[$key] = site_url(array("image", "club", $data[$key]));
                }
            }
        }
        return $inData;
    }

    protected function setEmptyPhotoObject($inData) {
        foreach ($inData as &$data) {
            foreach ($data as $key=>$value) {
                if($key=="head_picture") {
                    if(!$data->$key)
                        $data->$key = site_url(array("image", $this->emptyPhoto));
                    else
                        $data->$key = site_url(array("image", "club",  $data->$key));
                }
            }
        }
        return $inData;
    }

}
?>
