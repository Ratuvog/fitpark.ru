<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');

class FitparkClubsController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->init();
    }
    
    private function init()
    {
        /* init all data variables */
        $this->allowedPages = array('club', 'filter');
        $this->privateAllowedPages = array();
        $this->titlePage = 'Фитнес-клубы';
        
    }
    
    

    
}
?>

