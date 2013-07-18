<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/16/13
 * Time: 10:24 PM
 * To change this template use File | Settings | File Templates.
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
class Training_program extends Base {
    public $view = 'trainig_program/trainig_program';
    
    function __construct()
    {
        parent::__construct();
        $this->load->config("training_program");
        $this->load->model("coach");
        $this->load->model("programs");
        $this->load->model("program_images");
        $this->title = sprintf("Составление программы тренировок. ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));
    }

    function index()
    {
        $this->renderScene();
    }

    function addProgram()
    {
        $id = $this->programs->create($_POST);
        $newProgramImagesPath = $this->config->item("program_image_path").$id;
        $images = array();
        if(mkdir($newProgramImagesPath)) {
            foreach ($_FILES['files']['name'] as $key => $val) {
                move_uploaded_file($_FILES['files']['tmp_name'][$key],
                                   $newProgramImagesPath."/".$_FILES['files']['name'][$key]);
                $images[] = $_FILES['files']['name'][$key];
            }
            $this->program_images->add($id,$images);

            $this->content->view = 'common/success_action';
            $this->breadcrumbs []= (object)array(
                'name' => "Главная",
                'url' => base_url()
            );

            $this->breadcrumbs []= (object)array(
                'name' => "Программа тренировок",
                'url' => site_url('training_program')
            );

            $this->content->data->content_title->title = "Заявка успешно отправлена";
            $this->content->data->redirect_url = base_url();
            $this->content->data->success_message = "Уведомление о выполнении заказа вам придет по электронной почте.
                                А пока вы можете посмотреть другие предложения нашего портала.";
            $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
            parent::renderScene();
        } else {
            die("Картинки не удалось загрузить");
        }
    }

    public function renderScene()
    {
        $this->collectContent();
        parent::renderScene();
    }

    private function collectContent()
    {
        $this->content->view = $this->view;
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Программа тренировок",
            'url' => site_url('training_program')
        );

        $fieldsForm = (object)array(
            "where"       => $this->config->item("where"),
            "gender"      => $this->config->item("gender"),
            "target"      => $this->config->item("target"),
            "years"       => $this->config->item("years"),
            "experience"  => $this->config->item("experience"),
            "weight"      => $this->config->item("weight"),
            "periodicity" => $this->config->item("periodicity"),
            "height"      => $this->config->item("height")
        );
        foreach ($fieldsForm as $key=>$val) {
            $this->content->data->$key = $val;
        }



        $this->content->data->coach = $this->coach->byId();
        $this->content->data->coach->avatar = site_url(array("image",
                                              "coach",
                                              $this->content->data->coach->avatar));

        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->content->data->content_title->title = "Программа тренировок";
    }

}

?>