<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');

class FitparkClubsController extends FitparkBaseController {

    private $tableDB = 'fitnesclub';
    private $showRecOnPage = 10;
    private $pageNumber = 0;
    private $tableList = array('fitnesclub_services');
    
    function __construct()
    {
        parent::__construct();
        $this->init();
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
            'content' => $this->getContent(),
            'filters' => $this->getFilters(),
            'services' => $this->getClubsOptions(),
            'ratings' => $this->getClubsRatings()
        );
        return $data;
    }
    
    private function getContent()
    {   
        $query = "SELECT fitnesclub.*
             FROM fitnesclub
             LIMIT ".$this->pageNumber*$this->showRecOnPage.",".$this->showRecOnPage."";
        return $this->addModel->freeQuery($query)->result();
    }

    private function getClubsRatings()
    {
        $query = "SELECT SUM(rating.value)/COUNT(rating.id) as totalrating
             FROM fitnesclub JOIN fitnesclub_rating as `rating` ON fitnesclub.id = rating.clubId
             GROUP BY fitnesclub.id ORDER BY priority LIMIT ".$this->pageNumber*$this->showRecOnPage.",".$this->showRecOnPage."";
        $results = $this->addModel->freeQuery($query)->result();
        $ratings = array();
        foreach ($results as $row)
        {
            if(empty($ratings[$row->clubId]))
                $options[$row->clubId] = array();
            array_push($options[$row->clubId], $row->totalrating);
        }
        return $ratings;
    }
    
    private function getClubsOptions()
    {
        $optionQuery = "SELECT fc.id as clubId,
                               fc.name as clubName,
                               serv.id as serviceId,
                               serv.name as serviceName,
                               serv.class as class
            FROM fitnesclub_rel_services AS `rel_option` 
                JOIN fitnesclub_services AS `serv`
                    ON serv.id = rel_option.serviceId
                JOIN fitnesclub AS `fc`
                    ON fc.id = rel_option.clubId
            ORDER BY rel_option.priority";
        
        $results = $this->addModel->freeQuery($optionQuery)->result();
        $options = array();
        foreach ($results as $row)
        {
            if(empty($options[$row->clubId]))
                $options[$row->clubId] = array();
            array_push($options[$row->clubId], array('id' => $row->serviceId,
                                                     'name' => $row->serviceName,
                                                     'class' => $row->class));
        }
        return $options;
    }
    
    private function getFilters()
    {
        $filters = array();
        foreach ($this->tableList as $table)
        {
            $query = "SELECT f.*, filter.name as filterName
            FROM ".$table." as `f` JOIN fitnesclub_filter as `filter`
            ON f.filterId = filter.id";
            $filters[$table] = $this->addModel->freeQuery($query)->result();
        }
        $filters['tableList'] = $this->tableList;
        return $filters;
    }
}
?>

