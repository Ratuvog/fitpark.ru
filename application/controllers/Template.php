<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Template extends CI_Controller {
           
    private $template = 'templates/base';
    private $output;
    
    function __construct()
    {
        parent::__construct();
    }

    private function renderScene()
    {
        $this->initialize();
        $this->load-view($this->template, $this->output);
    }

    private function initialize()
    {
        $this->output->head = $this->head();
        $this->output->body = $this->body();
    }
    
    abstract function head();
    abstract function body();

    

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
