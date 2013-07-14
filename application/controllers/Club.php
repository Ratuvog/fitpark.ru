<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');
class Club extends Base {

    public $view = 'club/club';
    public $breadcrumbs = array();
    
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Переопределяем метод renderScene для того,
     * чтобы собирать данные в структуры
     * только перед непосредсвенным рендерингом view
     */
    function renderScene()
    {
        $this->collectContent();
        parent::renderScene();
    }
    
    function collectContent()
    {
/*        $this->title = sprintf("ФитПарк. %s %s. Стоимость, отзывы, фотографии, рейтинг, акции.",
                               '','');

        $this->description = sprintf("%s. Отзывы, рейтинг, фотографии, цены, описание.",
                                    lang("common_desc"));
        
        $this->keywords = sprintf("%s. Бассейн, тренажерный зал, аэробика,
                                   танцы, йога, пилатес, тренажеры.",
                                   lang("common_keys"));
 
 */
               
        $this->content->contents = array($this->content());
    }
    
    function content()
    {
        $content = new stdClass();
        $content->view = $this->view;

        $content->data->breadcrumbs->stack = $this->breadcrumbs;
        $content->data->header->menu->currentCity = $this->localCity;
        $content->data->header->menu->currentCity = $this->localCity;
        $content->data->header->menu->chooseCity->cities = $this->city->get();
        $content->data->content_title->title = "Фитнес-клуб";
        
       
        
        return $content;
    }
    
    function Club($club)
    {
        $this->club = $this->club_model->byId($club);
        
        $this->breadcrumbs []= (object)array(
            'name' => "Главная",
            'url' => base_url()
        );
        
        $this->breadcrumbs []= (object)array(
            'name' => "Клубы",
            'url' => site_url('clubs')
        );
        
        $this->breadcrumbs []= (object)array(
            'name' => $this->club->name,
            'url' => site_url(array("club",$this->club->id))
        );
        
        $this->renderScene();
    }
}
?>