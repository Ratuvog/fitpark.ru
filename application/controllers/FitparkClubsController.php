<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');

class FitparkClubsController extends FitparkBaseController {

    private $tableDB = 'fitnesclub';
    private $showRecOnPage = 10;
    private $pageNumber = 0;
    private $tableFilterList = array('fitnesclub_services',
                                     'fitnesclub_subscribe',
                                     'fitnesclub_district');
    
    function __construct()
    {
        parent::__construct();
    }
    
    public function init()
    {
        /* init all data variables */
        $this->allowedPages = array('index','clubs', 'filter');
        $this->privateAllowedPages = array();
        $this->titlePage = 'Фитнес-клубы';
        
        $this->initRecordsOnPage();
                
        $this->view = 'clubs/clubs';
        $this->viewData = $this->initViewData();
        
    }
    
    private function initRecordsOnPage()
    {
        if($this->session->userdata('showRecOnPages'))
            $this->showRecOnPages = $this->session->userdata('showRecOnPages');

        if($this->session->userdata('pageNumber'))
            $this->pageNumber = $this->session->userdata('pageNumber');
    }
    
    private function initViewData()
    {
        $data = array(
            'content' => $this->getClubList(),
            'filters' => $this->getFilters(),
            'services' => $this->getClubsServices(),
            'ratings' => $this->getClubsTotalRating()
        );
        return $data;
    }
    
    private function getClubList()
    {   
        return $this->fitpark_model->getClubList($this->showRecOnPage,
                $this->showRecOnPage*$this->pageNumber);
    }

    private function getClubsTotalRating()
    {
        $results = $this->fitpark_model->getClubsTotalRating();
        $ratings = array();
        foreach ($results as $row)
            $ratings[$row->clubId] = $row->totalrating;
        return $ratings;
    }
    
    private function getClubsServices()
    {
        $results = $this->fitpark_model->getClubsServices();
        $options = array();
        foreach ($results as $row)
        {
            $options[$row->clubId] = array('id' => $row->serviceId,
                                           'name' => $row->serviceName,
                                           'class' => $row->class);
        }
        return $options;

    }
    
    private function getFilters()
    {
        $filters = array();
        foreach ($this->tableFilterList as $table)
            $filters[$table] = $this->fitpark_model->getFitnesClubFilter($table);
        return $filters;
    }
}
?>