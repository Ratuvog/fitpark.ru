<?php
class Main extends CI_Controller {
    function index(){
        $this->load->database();
        $this->load->helper('url');
        $this->load->model("fitpark_model");
        $availableServices = $this->fitpark_model->getServices();
        $data = array();
        $numbers = array();
        for($i = 0; $i < count($availableServices) ; $i++) {
            array_push($numbers, $i);
        }
        $data["services"] = array();
        for($i = 0; $i<3 ; $i++) {
            $index = rand(0, count($numbers)-1);
            $currentItem = $numbers[$index];
            $availableServices[$currentItem]->icon = site_url(array("image",$availableServices[$currentItem]->icon));
            $data["services"][] = $availableServices[$currentItem];
            array_splice($numbers, $index, 1);
        }

        $data["clubs"] = $this->fitpark_model->getClubList("popularity",3,0,array());
        foreach ($data["clubs"] as &$value) {
            $value->head_picture = site_url(array("image", "club",$value->head_picture));
        }
//        print_r($data["clubs"]);
        $this->load->view("index",$data);
    }
}
?>
