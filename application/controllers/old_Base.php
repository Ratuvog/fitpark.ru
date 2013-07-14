<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base1 extends CI_Controller {

    protected $allowedPages = array();
    protected $privateAllowedPages = array();

    // Name default view *.php
    protected $defaultPage = 'clubs/clubs';
    protected $titlePage = 'nothing';

    protected $head = 'head';
    protected $headData = array('titleText'=>"ФитПарк. %s Тренажерные залы,
            фитнес центры, отзывы, стоимость, рейтинги, акции, скидки.");

    // Name header view and data
    protected $header = 'header';
    protected $headerData = array();

    // BreadCrumbs view and data
    protected $breadCrumbs = 'breadcrumbs';
    protected $breadCrumbsData = array();

    // Name footer view and data
    protected $footer = 'footer';
    protected $footerData = array();

    // Name main view and data
    protected $view = '';
    protected $viewData = array();
   
    protected $localCity = 'samara';
    
    protected $js_files = array();
    protected $css_files = array();
            
    function __construct()
    {
        parent::__construct();

        $this->config->load('global_const');

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('language');
        $this->load->helper('mutator_helper');
        $this->load->helper('image');

        $this->load->library('session');

        $this->load->library('idna_convert');
        $this->load->helper("geolocation");

        $this->load->model('fitpark_model');
        
        $this->breadCrumbsData[] = array(
            'href'  => base_url(),
            'title' => 'Главная'
        );
        
        $this->initNavigation();
        $this->initSearchWidget();

        // Definition the city on IP-address of the user
        $this->initGeographicalData();

        // install localization file according to local city name
        $this->lang->load(mb_convert_case($this->localCity, MB_CASE_LOWER),
                          mb_convert_case($this->localCity, MB_CASE_LOWER));
              
        /*
         * В данном случае сессии использованы только лишь в качестве этакого менеджера настроек
         * который доступен во все приложении
         */
        $this->session->set_userdata("city", $this->headerData['currentCity']->id);

        $this->initListAvaibleCity();

        if($this->idna_convert->decode($_SERVER["HTTP_HOST"]) != $this->headerData['currentCity']->url)
            $this->customRedirect($this->prepareUrl($this->headerData['currentCity']->url));
    }

    private function prepareUrl($host) {
        $url = $host;
        if($_SERVER["PHP_SELF"]) {
            $path = explode("/", $_SERVER["PHP_SELF"]);
            $index = array_search("index.php",$path);
            if($index === FALSE) {
                $url.=$_SERVER["PHP_SELF"];
            } else {
                unset($path[$index]);
                $url.=implode("/",$path);
            }
        }

        if($_SERVER["QUERY_STRING"]) {
            $url.="?".$_SERVER["QUERY_STRING"];
        }
        return prep_url($url);
    }

    function initNavigation()
    {
        $navigation = array(
            array(
                'name' => 'Главная',
                'url'  => base_url()
            ),
            array(
                'name' => 'Список клубов',
                'url'  => site_url(array('clubs'))
            ),
            array(
                'name' => 'Менеджерам',
                'url'  => site_url(array('Manager'))
            )
        );
        $this->headerData['navigation'] = $navigation;
    }

    function initSearchWidget() {
        $this->headerData["searchUrl"] = site_url(array("clubs","search"));
    }

    protected function cityByIP()
    {
        $host = $this->idna_convert->decode($_SERVER["HTTP_HOST"]);
        $hostArray = explode('.', $host);
        if(count($hostArray)!=3) {
            return getCityFromIp($this->input->ip_address());
        } else {
            return $hostArray[0];
        }
    }

    function init(){}


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
        redirect($this->idna_convert->encode($url));
    }

    // Before render scene check view-data variable for initialization
    protected function renderScene($view = null)
    {
        $this->initMetaData();
        $this->initCssData();
        $this->initJSData();
        if($view == null)
            $view = $this->view;

        if($this->head)
            $this->load->view($this->head, $this->headData);   
        
        if($this->header)
            $this->load->view($this->header, $this->headerData);

        if($this->breadCrumbs)
            $this->load->view($this->breadCrumbs, array("stack" => $this->breadCrumbsData) );

        if($view)
            $this->load->view($view, $this->viewData);

        if($this->footer)
            $this->load->view($this->footer, $this->footerData);
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

    private function initGeographicalData()
    {
        $city = $this->cityByIP();
        $this->headData['currentCity'] = $this->fitpark_model->getCity($city);
        $this->headerData['currentCity'] = $this->headData['currentCity'];
        $this->footerData['currentCity'] = $this->headData['currentCity'];

        $this->localCity = $this->headerData["currentCity"]->english_name;
    }
    
    protected function initMetaData()
    {
        $this->headData['titleText'] = sprintf($this->headData['titleText'], lang('title'));

        $this->headData['keywords'] = "%s. Бассейн, тренажерный зал, аэробика, танцы, йога, пилатес, тренажеры.";
        $this->headData["keywords"] = sprintf($this->headData["keywords"],lang("common_keys"));

        $this->headData["desc"] = "%s. Отзывы, рейтинг, фотографии, цены, описание.";
        $this->headData["desc"] = sprintf($this->headData["desc"],lang("common_desc"));
        
        $this->headData['favicon'] = $this->config->item('favicon');
    }

    private function initListAvaibleCity()  
    {
        //TODO: Гербы грузить через админку; добавить в city соотв. поле
        $this->headerData['availableCity'] = $this->fitpark_model->getAvailableCity();
        
    }

    public function initCssData()
    {
        $css_files = array( 
            "css/common/fitpark.css",
            "js/fancybox/jquery.fancybox.css",
            "js/fancybox/helpers/jquery.fancybox-buttons.css",
            "js/fancybox/helpers/jquery.fancybox-thumbs.css",
        );
        
        if($this->css_files)
            $css_files = array_merge($this->css_files, $css_files);
        
        foreach(array_keys($css_files) as $key)
            $css_files[$key] = site_url($css_files[$key]);
        $this->headData['css_files'] = $css_files;    
    }

    public function initJSData()
    {
        $js_files = array( 
            "js/header.js",
            "js/common.js",
            "js/cb/jquery.colorbox.js",
            "js/jquery.form.validation.js",
            "js/fancybox/jquery.fancybox.pack.js",
            "js/fancybox/helpers/jquery.fancybox-buttons.js",
            "js/fancybox/helpers/jquery.fancybox-media.js",
            "js/fancybox/helpers/jquery.fancybox-thumbs.js",
            "js/fancybox/jquery.fancybox.pack.js",
            "js/validator_helper.js",
            "js/raty-2.5.2/jquery.raty.js",
            "js/slider/jquery.bxslider.js"
//            "js/noty/jquery.noty.js",
//            "js/noty/layouts/topRight.js",
//            "js/noty/themes/default.js"
        );
        
        if($this->js_files)
            $js_files = array_merge($this->js_files, $js_files);
        
        foreach(array_keys($js_files) as $key)
            $js_files[$key] = site_url($js_files[$key]);
        $this->headData['js_files'] = $js_files;   
    }
    
    function append_js($files)
    {
        $this->js_files += $files;
    }
    
    function append_css($files)
    {
        $this->css_files += $files;
    }

}
?>