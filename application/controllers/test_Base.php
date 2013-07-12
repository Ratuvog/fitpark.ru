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
    
    function __construct()
    {
        parent::__construct();
        $this->favicon = site_url($this->config->item('favicon'));
    }
   
    private function head()
    {
        $head = new stdClass();
        $head->title = $this->title;  
        $head->description = $this->description;
        $head->keywords = $this->keywords; 
        $head->favicon = $this->favicon; 
        return $head;
    }
    
    
    private function body()
    {
        $body = new stdClass();
        $body->header = $this->header;
        $body->content_title = $this->content_title;
        $body->content = $this->content;
        $body->footer = $this->footer;
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
        header = {
            menu-block = { currentCity },
            search-block
        },
        content_title = { title },
        content = { 
            var contents = array(
                {view1, data1},
                {view2, data2},
                {view3, data3}
            )
        },
        footer
    }
};
 */
}
?>
