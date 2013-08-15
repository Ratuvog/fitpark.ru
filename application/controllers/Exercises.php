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

        $exerciseType = $this->exercise_types->byId($typeId);
        $this->title = $exerciseType->title;
        $this->description = $exerciseType->description;
        $this->keywords = $exerciseType->keywords;

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