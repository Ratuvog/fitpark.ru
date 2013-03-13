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
    
    private $activeFilters = array();
    private $filterEnabled = false;
            
    function __construct()
    {
        parent::__construct();
        $this->allowedPages = array('index','clubs','filter','sort','filter');
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
            'filters'  => $this->getFilters(),
            'content'  => $this->getClubList(),
            'activeFilters' => $this->activeFilters,
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
        $filter = array();
        if($this->filterEnabled)
            $filter = $this->generateFilter();
        
        if($this->order == 'cheap')
            return $this->fitpark_model->getClubListByPrice("asc", $limit, $offset, $filter);
        else if($this->order == 'expansive')
            return $this->fitpark_model->getClubListByPrice("desc", $limit, $offset, $filter);
        
        return $this->fitpark_model->getClubListByPopularity($limit, $offset, $filter);
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
        foreach ($this->tableFilterList as $table) {
            $filters[$table] = $this->fitpark_model->getFitnesClubFilter($table);
            foreach ($filters[$table] as $item)
            {
                $this->activeFilters["option".$item->filterid."-".$item->id] = false;
            }
        }
        return $filters;
    }
    
    public function sort($how)
    {
        $this->setSortOrder($how);
        $this->setFilter();
        $this->index();
    }
    
    private function setSortOrder($how)
    {
        if(array_search($how, $this->sortOrderList))
            $this->order = $how;
    }
    
    public function filter()
    {
        $this->setFilter();
        $this->index();
    }
    
    private function  setFilter()
    {
        $this->filterEnabled = true;
    }
    
    private function  generateFilter()
    {
        $filters = array();
        foreach (array_keys($this->activeFilters) as $option)
        {
            if($this->input->post($option))
            {
                $filters = $this->setFilterValue($filters, $option);
                $this->activeFilters[$option] = true;
            }
        }
        return $filters;
    }
    
    private function setFilterValue($filterArray, $option)
    {
        $findFilterId = true;
        $filterId = '';
        $optionId = '';
        $str = str_split($option);
        for($i = 0; $i<strlen($option); $i++)
        {
            if($findFilterId)
            {
                if($str[$i] >= '0' && $str[$i] <= '9')
                {
                    $filterId.=$str[$i];
                }
                if($str[$i] == '-')
                    $findFilterId = false;
            }
            else
            {
                $optionId.=$str[$i];
            }
        }
        if($filterId != '' && $optionId != '')
        {
            if(!key_exists($filterId, $filterArray))
                $filterArray[$filterId] = array();
            array_push($filterArray[$filterId], $optionId);
        }
        return $filterArray;
    }
}
?>