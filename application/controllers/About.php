<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/25/13
 * Time: 12:28 AM
 * To change this template use File | Settings | File Templates.
 */

class About  extends Base
{
    public $view = "about";

    function __construct()
    {
        parent::__construct();
        $this->load->model("sales_model");
        $this->load->model("club_model");
        $this->title = sprintf("О нас. ФитПарк. %s Тренажерные залы, фитнес центры,
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
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "О нас",
            'url'  => site_url('about')
        );

        $this->content->view = $this->view;
        $this->content->data->content_title->title = 'О нас';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }

}

?>