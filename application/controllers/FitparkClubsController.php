<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/FitparkBaseController.php');

class FitparkClubsController extends FitparkBaseController {

    private $tableDB = 'fitnesclub';
    private $showRecOnPage = 100;
    private $pageNumber = 0;
    private $tableFilterList = array('fitnesclub_services',
                                     'fitnesclub_subscribe',
                                     'district');
    private $sortOrderList = array('Popularity', 'PriceDesc','PriceAsc');
    private $order = 'Popularity';
    private $activeFilters = array();
    private $filterEnabled = false;
    private $nonFilterField = array("order");

    function __construct()
    {
        parent::__construct();
        $this->allowedPages = array('index','clubs','filter','sort','filter','search');
        $this->privateAllowedPages = array();
    }

    public function init()
    {
        $this->titlePage = 'Фитнес-клубы';
        $this->view = 'clubs/clubs';
        $this->viewData   = $this->initViewData();
        $this->headerData = $this->initHeaderData();
    }

    private function initHeaderData()
    {
        $data = array();
        if($this->input->get("order"))
            $data["order"] = $this->input->get("order");
        else
            $data["order"] = 'Popularity';
        return $data;
    }

    private function initViewData()
    {
        if($this->input->get("order"))
            $this->order = $this->input->get("order");
        $data = array(
            'filters'  => $this->getFilters(),
            'content'  => $this->getClubList(),
            'activeFilters' => $this->activeFilters,
            'services' => $this->getClubsServices(),
            'ratings'  => $this->getClubsTotalRating(),
            'order'    => $this->order,
            'baseUrlClub'   => $this->config->item("base_url")."/club/"
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
        return $this->fitpark_model->getClubList($this->order, $limit,$offset, $filter);
    }

    function search()
    {
        $this->titlePage = "Поиск фитнес-клубов";
        $this->view      = "clubs/clubs";
        if($this->input->get("order"))
            $this->order = $this->input->get("order");
        // Initialize content data
        $this->viewData  = array(
            'filters'       => $this->getFilters(),
            'content'       => $this->getClubsByString($this->input->get("search")),
            'activeFilters' => $this->activeFilters,
            'services'      => $this->getClubsServices(),
            'ratings'       => $this->getClubsTotalRating(),
            'order'         => $this->order,
            'baseUrlClub'   => $this->config->item("base_url")."/club/"
        );
        $this->breadCrumbsData[] = array(
            'href'  => current_url(),
            'title' => 'Поиск клубов'
        );
        // initialize view data
        $this->headerData = $this->initHeaderData();
        $this->renderScene();
    }

    private function getClubsByString($queryString)
    {
        $limit = $this->showRecOnPage;
        $offset = $this->showRecOnPage*$this->pageNumber;
        return $this->fitpark_model->getClubsByName($queryString, $this->order, $limit, $offset);
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
        {
            $filters[$table] = $this->fitpark_model->getFitnesClubFilter($table);
            foreach ($filters[$table] as $item)
                $this->activeFilters["option".$item->filterid."-".$item->id] = false;
        }
            $this->activeFilters['rangeF'] = $this->activeFilters['rangeT'] = false;
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
            if(in_array($option, $filters))
            if($this->input->get($option))
            {
                $value = $this->input->get($option);
                if($option === 'rangeF' || $option === 'rangeT')
                {
                    $filters = $this->setPriceRangeFilter($filters, $option);
                    $this->activeFilters[$option] = $value;
                }
                else
                {
                    $filters = $this->setFilterValue($filters, $option);
                    $this->activeFilters[$option] = true;
                }
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

    private function setPriceRangeFilter($filterArray, $option)
    {
        if(!key_exists($option, $filterArray))
            $filterArray[$option] = array();
        array_push($filterArray[$option], $this->input->post($option));

        return $filterArray;
    }
}
?>