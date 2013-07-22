<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/22/13
 * Time: 8:37 PM
 * To change this template use File | Settings | File Templates.
 */

class Exercises extends Base
{
    private $view = "exercises/exercises";
    public $breadcrumbs = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model("exercises_model");
        $this->load->model("exercise_types");
        $this->title = sprintf("Упражнения. ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));
    }

    function exercises($typeId = 1)
    {
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Упражнения",
            'url' => site_url('exercises')
        );
        $resultExercises = $this->exercises_model->byTypeId($typeId);
        foreach ($resultExercises as &$exercise) {
            $exercise->image = site_url(array($this->config->item("exercises_image_path"),
                                $exercise->image));
            $exercise->url   = site_url(array('exercise',$exercise->id));
        }

        $exerciseTypes = $this->exercise_types->getList();
        foreach ($exerciseTypes as $type) {
            $type->url = site_url(array("exercises",$type->Id));
        }


        $this->content->view = $this->view;
        $this->content->data->content_title->title = "Упражнения";
        $this->content->data->exercises = $resultExercises;
        $this->content->data->types = $exerciseTypes;
        $this->content->data->activeType = $typeId;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }
}

?>