<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');

class FitparkClubsController extends FitparkBaseController {

    private $tableDB = 'fitnesclub';
    private $showRecOnPage = 100;
    private $pageNumber = 0;
    private $tableFilterList = array('fitnesclub_services',
                                     'fitnesclub_subscribe',
                                     'fitnesclub_district');
    private $order = 'popularity'; 
    private $sortOrderList = array('popularity', 'expansive','cheap');
    
    function __construct()
    {
        parent::__construct();
        $this->allowedPages = array('index','clubs','filter','sort');
        $this->privateAllowedPages = array();
    }
    
    public function init()
    {
        $this->titlePage = 'Фитнес-клубы';
        $this->view = 'clubs/clubs';
        $this->viewData = $this->initViewData();
    }
        
    private function initViewData()
    {
        $data = array(
            'content'  => $this->getClubList(),
            'filters'  => $this->getFilters(),
            'services' => $this->getClubsServices(),
            'ratings'  => $this->getClubsTotalRating(),
            'order'    => $this->order
        );
        return $data;
    }
    
    private function getClubList()
    {   
        $limit = $this->showRecOnPage;
        $offset = $this->showRecOnPage*$this->pageNumber;
        
        if($this->order == 'cheap')
            return $this->fitpark_model->getClubListByPrice("asc", $limit, $offset);
        else if($this->order == 'expansive')
            return $this->fitpark_model->getClubListByPrice("desc", $limit, $offset);
        
        return $this->fitpark_model->getClubListByPopularity($limit, $offset);
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
    
    public function sort($how)
    {
        $this->setSortOrder($how);
        $this->index();
    }
    
    private function setSortOrder($how)
    {
        if(array_search($how, $this->sortOrderList))
            $this->order = $how;
    }
    
}
?>