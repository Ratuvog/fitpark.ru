<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Template.php');

class Base extends Template {
           
    protected $title;
    protected $description;
    protected $keywords;
    protected $favicon;

    protected $content;
    protected $footer;
    protected $menu_block;
    
    protected $localCity;
            
    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->config->load('global_const');
        $this->favicon = site_url($this->config->item('favicon'));
        
        // Definition the city on IP-address of the user
        $city = $this->cityByIP();
        if($city)
        {
            $this->localCity = $this->city->byName($city);
        }
        else
        {
            $city = $this->city->byName($this->input->ip_address());
            $this->customRedirect($this->replaceHttpsHost($city->url));
        }
        $this->session->set_userdata("city", $this->localCity->id);
        // install localization file according to local city name
        $this->lang->load(mb_convert_case($this->localCity->english_name, MB_CASE_LOWER),
                          mb_convert_case($this->localCity->english_name, MB_CASE_LOWER));
        
        $this->footer->currentCity = $this->localCity;
        $this->content->data->header->menu->currentCity = $this->localCity;
        $this->content->data->header->menu->chooseCity->cities = $this->city->get();

        $block = json_decode($this->localCity->promotion);
        if($block)
        {
            $this->footer->blocks = $block;
        }
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
            return false;
        else
            return $hostArray[0];
        
    }
    protected function customRedirect($url)
    {
        redirect($this->idna_convert->encode($url));
    }

    private function replaceHttpsHost($newHost)
    {
        $url = $newHost.$_SERVER['REQUEST_URI'];
        if($_SERVER['QUERY_STRING']) {
            $url.="?".$_SERVER["QUERY_STRING"];
        }

        return prep_url($url);
    }

    protected function object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
}
?>
