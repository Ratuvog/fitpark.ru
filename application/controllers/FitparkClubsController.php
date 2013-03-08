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
    
    private function init()
    {
        /* init all data variables */
        $this->allowedPages = array('club', 'filter');
        $this->privateAllowedPages = array();
        
        $this->titlePage = 'Фитнес-клубы';
        
        $this->initRecordsOnPage();
                
        $this->view = 'clubs/clubs';
        $this->viewData = $this->initViewData();
        
    }
    
    private function initRecordsOnPage()
    {
        if(isset($this->session->userdata('showRecOnPages')))
            $this->showRecOnPages = $this->session->userdata('showRecOnPages');

        if(isset($this->session->userdata('pageNumber')))
            $this->pageNumber = $this->session->userdata('pageNumber');   
    }
    
    private function initViewData()
    {
        $data = array(
            'content' => $this->getContent(),
            'filters' => $this->getFilters()
        );
        return $data;
    }
    
    private function getContent()
    {
        /*
         * club struct:
         * clubs->array from table fitnesclub;
         * clubs->options[$id] - club's id
         */
        $this->baseModel->set_basic_table($this->tableDB);
        $this->baseModel->addField('SUM(fitnesclub_rating.value)/COUNT(fitnesclub_rating.id) as totalrating');
        $this->baseModel->join_relation('clubId','fitnesclub_rating','rating');
        $this->baseModel->group('id');
        $this->baseModel->order_by('priority','asc');
        $this->baseModel->limit($this->showRecOnPage, $this->pageNumber*$this->showRecOnPage);
        $clubs = $this->baseModel->get_list();

        $clubs->options = $this->getClubsOptions();
        
        return $clubs;
    }

    private function getClubsOptions()
    {
        $optionQuery = "SELECT fc.id as clubId,
                               fc.name as clubName,
                               option.id as optionId,
                               option.name as optionName
            FROM fitnesclub_rel_option AS `rel_option` 
                JOIN fitnesclub_option AS `option`
                    ON option.id = rel_option.optionId
                JOIN fitnesclub AS `fc`
                    ON fc.id = rel_option.clubId
            ORDER BY rel_option.priority";
        
        $results = $this->addModel->freeQuery($optionQuery)->result();
        $options = array();
        foreach ($results as $row)
        {
            if(empty($options[$row->clubId]))
                $options[$row->clubId] = array();
            array_push($options[$row->clubId], $row->clubId);
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
        return $filters;
    }
}
?>

