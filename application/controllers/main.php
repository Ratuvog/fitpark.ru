<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');

class Main extends Base {
           
    function __construct()
    {
        parent::__construct();
        $this->title = sprintf("ФитПарк. %s Тренажерные залы, фитнес центры,
                                отзывы, стоимость, рейтинги, акции, скидки.",
                                lang('title'));

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
                                    lang("common_desc"));
        
        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
                                   lang("common_keys"));
               
        $this->content->contents = array($this->content());
    }
    
    function content()
    {
        $content = new stdClass();
        $content->view = 'main';
        $content->data->clubs = $this->club_model->get_rand(5); // Выборка 5 случайных клубов
        foreach ($content->data->clubs as &$value)
            $value->url = prep_url(site_url(array('club', $value->id)));

        $content->data->header->menu->currentCity = $this->localCity;
        $content->data->header->menu->chooseCity->cities = $this->city->get();
        $content->data->content_title->title = "Случайные клубы";
        
        return $content;
    }
    
    function index() 
    { 
        $this->renderScene();
    }
}
?>
