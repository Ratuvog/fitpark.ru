<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Template extends CI_Controller {
           
    public $template = 'templates/base';
    public $output;
    
    function __construct()
    {
        parent::__construct();

         // Запуск миграции БД. Текущая версия устанавливается в config/migration.php.
        if (!$this->migration->current()){
            show_error($this->migration->error_string());
        }

    }

    function renderScene()
    {
        $this->initialize();
        $this->load->view($this->template, $this->output);
    }

    function initialize()
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
