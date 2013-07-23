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
        $this->title = sprintf("Упражнения. ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));
    }

    function index($id)
    {
        $exercise = $this->exercises_model->byId($id);

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