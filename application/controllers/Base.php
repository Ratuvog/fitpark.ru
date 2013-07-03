<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Base extends CI_Controller {

    protected $allowedPages = array();
    protected $privateAllowedPages = array();

    // Name default view *.php
    protected $defaultPage = 'clubs/clubs';
    protected $titlePage = 'nothing';

    // Name header view and data
    protected $header = 'header';
    protected $headerData = array('titleText'=>"ФитПарк. %s Тренажерные залы,
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
   
    protected $localCity = 'samara';
    
    protected $js_files = array();
    protected $css_files = array();
            
    function __construct()
    {
        parent::__construct();
//        $this->twiggy->set('user','dima')->template('_layouts/index')->display();
//        exit;
        $this->config->load('global_const');

        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('language');
        $this->load->helper('mutator_helper');

        $this->load->library('session');
        $this->load->library('idna_convert');

        $this->load->model('fitpark_model');
        $this->initTwiggy();
        $this->initNavigation();
        $this->initSearchWidget();
        $this->breadCrumbsData[] = array(
            'href'  => base_url(),
            'title' => 'Главная'
        );
        
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
            $this->customRedirect(prep_url($this->headerData['currentCity']->url));
    }

    function initTwiggy()
    {
        $this->load->spark('Twiggy/0.8.5');
        $this->twiggy->register_function('lang');
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

    private function cityByIP()
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
        //redirect($this->idna_convert->encode($url));
    }

    // Before render scene check view-data variable for initialization
    protected function renderScene($view = null)
    {
        $this->initMetaData();
        $this->initCssData();
        $this->initJSData();
        
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
        /*
         * Текущий город
         */
        $city = $this->cityByIP();
        $this->headerData['currentCity'] = $this->fitpark_model->getCity($city);
        $this->footerData['currentCity'] = $this->headerData["currentCity"];

//        print_r($this->headerData['currentCity']->symbol_path);
//        exit;
        $this->localCity = $this->headerData["currentCity"]->english_name;
    }
    
    protected function initMetaData()
    {
        $this->headerData['titleText'] = sprintf($this->headerData['titleText'], lang('title'));

        $this->headerData['keywords'] = "%s. Бассейн, тренажерный зал, аэробика, танцы, йога, пилатес, тренажеры.";
        $this->headerData["keywords"] = sprintf($this->headerData["keywords"],lang("common_keys"));

        $this->headerData["desc"] = "%s. Отзывы, рейтинг, фотографии, цены, описание.";
        $this->headerData["desc"] = sprintf($this->headerData["desc"],lang("common_desc"));
        
        $this->headerData['favicon'] = $this->config->item('favicon');
    }

    private function initListAvaibleCity()  
    {
        /*
        * Доступные города
        */
        //TODO: Гербы грузить через админку; добавить в city соотв. поле
        $this->headerData['availableCity'] = $this->fitpark_model->getAvailableCity();
        foreach($this->headerData['availableCity'] as $city) {
            $city->url = prep_url($city->url);
            $city->symbol_path = site_url(
                array(
                    "image",
                    "blazons",
                    $city->english_name.".jpg"
                )
            );
        }
    }

    public function initCssData()
    {
        $css_files = array( 
            "/css/common/fitpark.css",
            "/js/fancybox/jquery.fancybox.css",
            "/js/fancybox/helpers/jquery.fancybox-buttons.css",
            "/js/fancybox/helpers/jquery.fancybox-thumbs.css",
        );
        
        if($this->css_files)
            $css_files = array_merge($this->css_files, $css_files);
        
        foreach(array_keys($css_files) as $key)
            $css_files[$key] = site_url($css_files[$key]);
        $this->headerData['css_files'] = $css_files;    
    }

    public function initJSData()
    {
        $js_files = array( 
            "/js/header.js",
            "/js/common.js",
            "/js/cb/jquery.colorbox.js",
            "/js/jquery.form.validation.js",
            "/js/fancybox/jquery.fancybox.pack.js",
            "/js/fancybox/helpers/jquery.fancybox-buttons.js",
            "/js/fancybox/helpers/jquery.fancybox-media.js",
            "/js/fancybox/helpers/jquery.fancybox-thumbs.js",
            "/js/fancybox/jquery.fancybox.pack.js",
            "/js/validator_helper.js",
            "/js/raty-2.5.2/jquery.raty.js",
            "/js/slider/jquery.bxslider.js",
            "/js/noty/jquery.noty.js",
            "/js/noty/layouts/topRight.js",
            "js/noty/themes/default.js"
        );
        
        if($this->js_files)
            $js_files = array_merge($this->js_files, $js_files);
        
        foreach(array_keys($js_files) as $key)
            $js_files[$key] = site_url($js_files[$key]);
        $this->headerData['js_files'] = $js_files;   
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
