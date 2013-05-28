<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');

class errors extends FitparkBaseController {
    public function err404()
    {
        $this->breadCrumbsData = array();
        $this->breadCrumbsData[] = array(
            'href'  => base_url(),
            'title' => 'Главная'
        );
        $this->breadCrumbsData[] = array(
            'href'  => current_url(),
            'title' => 'Ошибка 404'
        );
        $this->view = 'error404.php';
        $this->renderScene();
    }
}
