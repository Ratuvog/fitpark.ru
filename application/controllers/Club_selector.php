<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/22/13
 * Time: 8:37 PM
 * To change this template use File | Settings | File Templates.
 */

class Club_selector extends Base
{
    private $view = "club-selector/club-selector";
    public $breadcrumbs = array();

    function __construct()
    {
        parent::__construct();
        $this->load->model("club_model");
        $this->load->model("district");
        $this->title = sprintf("Подбор клуба по карте. ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
            lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
            lang("common_desc"));

        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
            lang("common_keys"));
    }

    function club_selector()
    {
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );

        $this->breadcrumbs []= (object)array(
            'name' => "Подбор клуба по карте",
            'url' => site_url('exercises')
        );
        $districts = $this->district->byCity($this->localCity->id);
        foreach($districts as &$district)
        {
            $district->url = site_url();
        }
        $this->content->view = $this->view;
        $this->content->data->content_title->title = "Выбор по карте";
        $this->content->data->districts = $districts;
        $this->content->data->breadcrumbs->stack = $this->breadcrumbs;
        $this->renderScene();
    }
}

?>