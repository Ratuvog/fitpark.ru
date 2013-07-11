<?php
require_once(APPPATH.'controllers/Base.php');
class Main extends Base {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();

        $this->view = "main";
        $this->viewData = new stdClass();
        $this->initMetaData();
        $this->initCssData();
        $this->initJSData();
        
        $this->breadCrumbs = FALSE;
    }
    
    function index()
    {
        $this->load->model('club');
        $this->viewData->clubs = $this->club->get_rand(5); // Выборка 5 случайных клубов

        foreach ($this->viewData->clubs as &$value)
            $value->url = prep_url(site_url(array('club', $value->id)));

        $this->renderScene();
    }
}
?>
