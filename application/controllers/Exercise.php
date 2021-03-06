<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/23/13
 * Time: 9:09 PM
 * To change this template use File | Settings | File Templates.
 */

class Exercise extends Base {
    private $view = 'exercises/exercise';

    function __construct()
    {
        parent::__construct();
        $this->load->model("exercises_model");
    }

    function index($id)
    {
        $exercise = $this->exercises_model->byId($id);
        $exercise->simular_exercises = $this->exercises_model->byTypeIdWidget($exercise->typeId);
        foreach ($exercise->simular_exercises as &$currentExercise) {
            $currentExercise->image = site_url(array($this->config->item("exercises_image_path"),
                $currentExercise->image));
            $currentExercise->url   = site_url(array('exercise',$currentExercise->id));
        }

        $exercise->photos = array();
        for($i=1;$i<=5;$i++) {
            if($exercise->{"image".$i}) {
                $newPhotos = new stdClass();
                $newPhotos->url = site_url(array('image/exercises', $exercise->{"image".$i}));
                $exercise->photos[] = $newPhotos;
            }
        }

        $this->title = sprintf("%s, описание, техника, видео. ФитПарк",
            $exercise->name);

        $this->description = sprintf("%s. Подробное описание, порядок выполнения, нюансы упражнения, видео.",
            $exercise->name);

        $this->keywords = $exercise->name;

        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Упражнения",
            'url'  => site_url('exercises')
        );

        $this->breadcrumbs []= (object)array(
            'name' => $exercise->name,
            'url'  => site_url(array('exercises',$exercise->id))
        );



        $this->content->view = $this->view;
        $this->content->data->content_title->title = $exercise->name;
        $this->content->data->exercise = $exercise;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }
}

?>