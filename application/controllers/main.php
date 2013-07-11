<?php
require_once(APPPATH.'controllers/Base.php');
class Main extends Base {

    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->database();
        
        $this->viewData = array();
        /**
         * обнуляем все ненужные view, оставляя только view для контента
         */
        $this->header      = FALSE;
        $this->breadCrumbs = FALSE;
        $this->footer      = FALSE;

        $this->initMetaData();
        $this->initCssData();
        $this->initJSData();
        $this->viewData = $this->headerData;
        $availableServices = $this->fitpark_model->getServices();

        $numbers = array();
        for($i = 0; $i < count($availableServices) ; $i++)
            $numbers += $i;
        
        $this->viewData["services"] = array();
        
        if(!empty($numbers))
        {
            for($i = 0; $i<3 ; $i++)
            {
                $index = rand(0, count($numbers)-1);
                $currentItem = $numbers[$index];
                $availableServices[$currentItem]->icon = site_url(array("image",$availableServices[$currentItem]->icon));
                $this->viewData["services"][] = $availableServices[$currentItem];
                array_splice($numbers, $index, 1);
            }
        }

        $this->viewData["clubs"] = $this->fitpark_model->getClubList("popularity",3,0,array());
        foreach ($this->viewData["clubs"] as &$value)
            $value->url = prep_url(site_url(array('club',$value->id)));

        $this->view = "index";
        $this->renderScene();
        //$this->initMeta();
      //  $this->twiggy->set($this->viewData)->template("main")->display();
    }

    function initMeta()
    {
        $this->twiggy->title($this->headerData["titleText"]);
        $this->twiggy->meta("keywords", $this->headerData["keywords"]);
        $this->twiggy->meta("description", $this->headerData["desc"]);
    }
}
?>
