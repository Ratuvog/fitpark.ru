<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Template.php');

class Base extends Template {
           
    protected $title;
    protected $description;
    protected $keywords;
    protected $favicon;
    
    protected $header;
    protected $content_title;
    protected $content;
    protected $footer;
    
    protected $localCity;
            
    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->config->load('global_const');
        $this->favicon = site_url($this->config->item('favicon'));
        
        // Definition the city on IP-address of the user
        $this->localCity = $this->city->byName($this->cityByIP());

        // install localization file according to local city name
        $this->lang->load(mb_convert_case($this->localCity->english_name, MB_CASE_LOWER),
                          mb_convert_case($this->localCity->english_name, MB_CASE_LOWER));
        
        $this->footer->currentCity = $this->localCity;
    }
   
    function head()
    {
        $head->title = $this->title;  
        $head->description = $this->description;
        $head->keywords = $this->keywords; 
        $head->favicon = $this->favicon; 
        return $head;
    }
    
    
    function body()
    {
        $body->header = $this->header;
        $body->content_title = $this->content_title;
        $body->content = $this->content;
        $body->footer = $this->footer;
        $body->currentCity = $this->localCity;
        return $body;
    }
       
    protected function cityByIP()
    {
        $host = $this->idna_convert->decode($_SERVER["HTTP_HOST"]);
        $hostArray = explode('.', $host);
        
        if(count($hostArray) != 3)
            return getCityFromIp($this->input->ip_address());
        else
            return $hostArray[0];
        
    }
    
    
    /*
$output = {
    head = {
        title,
        description,
        keywords,
        favicon
    },
    body = {
        currentCity,
        content = { 
            var contents = array({
                view,
                data = {
                      header = {
                        menu-block = { currentCity },
                        search-block
                       },
                       content_title = { title },
               },
               ...
            )
        },
        footer
    }
};
 */
}
?>
