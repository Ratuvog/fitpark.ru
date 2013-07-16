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
        $this->content->data->content_title->title = "Вопросы и ответы";


        $this->title = sprintf("ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));
    }

    function getQuestion($theme = 1) {
//        Breadcrumbs
        $this->content->view = 'QA/qa';
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Клубы",
            'url' => prep_url($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])
        );

        $this->content->data->questions = $this->fitpark_qa_model->getAnsweredQuestions($theme);
        $this->content->data->themes    = $this->fitpark_qa_model->getAvailableThemes();
        foreach ($this->content->data->questions as &$value) {
            $value->avatar = site_url(array("image", "experts_avatar", $value->avatar));
        }

        foreach($this->content->data->themes as &$currentTheme) {
            $currentTheme["url"] = site_url(array('question',$currentTheme["id"]));
        }

        $this->content->data->activeTheme = $theme;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
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