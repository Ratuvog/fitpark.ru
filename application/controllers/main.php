<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');

class Main extends Base {
           
    function __construct()
    {
        parent::__construct();
        $this->title = sprintf("Все фитнес клубы %s. Отзывы, стоимость, описания, фотографии.",
                                lang('city_2'));

        $this->description = sprintf("Тренажерные залы, фитнес центры, цены, акции, адреса и услуги %s",
                                    lang('city_2'));

        $this->keywords = sprintf("Бассейн, тренажер, %s, упражнения, похудеть, нарастить мышцы",
                                   $this->localCity->full_name);

        $this->content();

    }
    
    function content()
    {
        $this->content->view = 'main';
        $this->content->data->clubs = $this->club_model->get_rand(5, $this->localCity); // Выборка 5 случайных клубов
        foreach ($this->content->data->clubs as &$value)
            $value->url = prep_url(site_url(array('club', $value->id)));

        $this->content->data->content_title->title = "Популярные клубы";
    }
    
    function index() 
    { 
        $this->renderScene();
    }
}
?>
