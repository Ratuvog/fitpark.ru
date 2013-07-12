<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');

class Main extends Base {
           
    function __construct()
    {
        parent::__construct();

        $this->content_title->title = "Случайные клубы";
        
        $this->content->contents = array($this->content());
    }
    
    function content()
    {
        $content = new stdClass();
        $content->view = 'main';
        $content->data->clubs = $this->club->get_rand(5); // Выборка 5 случайных клубов
        foreach ($content->data->clubs as &$value)
            $value->url = prep_url(site_url(array('club', $value->id)));

        $content->data->header->menu_block->currentCity = $this->localCity;
        $content->data->content_title->title = "Случайные клубы";
        
        return $content;
    }
    
    function index() 
    { 
        $this->renderScene();
    }
}
?>
