<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 6/19/13
 * Time: 10:32 PM
 * To change this template use File | Settings | File Templates.
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');

class FAQ extends Base {

    function __construct()
    {
        parent::__construct();
        $this->load->model('fitpark_qa_model');
        $this->view = "QA/qa";
        $this->allowedPages = array('getQuestion',"addQuestion");
        $this->privateAllowedPages = array();
        $this->init();
    }

    function getQuestion($theme = 1) {
//        Breadcrumbs
        $this->breadCrumbsData[] = array(
            'href'  => prep_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']),
            'title' => "Вопросы и ответы"
        );

        $questions = $this->fitpark_qa_model->getAnsweredQuestions($theme);
        $themes    = $this->fitpark_qa_model->getAvailableThemes();
        foreach ($questions as &$value) {
            $value->avatar = site_url(array("image", "experts_avatar", $value->avatar));
        }

        $this->viewData["questions"]   = $questions;
        $this->viewData['activeTheme'] = $theme;
        $this->viewData["themes"] = $themes;
//        print_r($this->viewData["themes"]);
//        exit;
        foreach($this->viewData["themes"] as &$currentTheme) {
            $currentTheme["url"] = site_url(array('question',$currentTheme["id"]));
        }
//
        $this->renderScene();
    }

    function addQuestion()
    {
        $insertData = array(
            'user'     => $this->input->post("user"),
            'email'    => $this->input->post("email"),
            'question' => $this->input->post("question")
        );

        $this->fitpark_qa_model->addQuestion($insertData);
        $this->customRedirect(site_url(array('question')));
    }
}

?>