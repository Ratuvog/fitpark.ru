<?php
require_once(APPPATH.'controllers/FitparkBaseController.php');
class Main extends FitparkBaseController {

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
        $data = array();
        $numbers = array();
        for($i = 0; $i < count($availableServices) ; $i++) {
            array_push($numbers, $i);
        }
        $this->viewData["services"] = array();
        for($i = 0; $i<3 ; $i++) {
            $index = rand(0, count($numbers)-1);
            $currentItem = $numbers[$index];
            $availableServices[$currentItem]->icon = site_url(array("image",$availableServices[$currentItem]->icon));
            $this->viewData["services"][] = $availableServices[$currentItem];
            array_splice($numbers, $index, 1);
        }

        $this->viewData["clubs"] = $this->fitpark_model->getClubList("popularity",3,0,array());
        foreach ($this->viewData["clubs"] as &$value) {
            $value['head_picture'] = site_url(array("image", "club", $value['head_picture']));
        }

        $this->renderScene("index");
    }
}
?>
