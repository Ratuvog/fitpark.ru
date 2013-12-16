<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 8/4/13
 * Time: 12:13 AM
 * To change this template use File | Settings | File Templates.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');

class Manager_in extends Base
{
    private $view = "manager_in.php";

    function __construct()
    {
        parent::__construct();
        $this->title = sprintf("Вход менеджерам клубов. ФитПарк. %s Тренажерные залы, фитнес центры,
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
            'name' => "Вход менеджерам клубов",
            'url'  => site_url('sales')
        );
        $this->content->view = $this->view;
        $this->content->data->content_title->title = 'Менеджерам клубов';
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }
}
?>