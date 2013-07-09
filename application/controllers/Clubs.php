<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH.'controllers/Base.php');

class Clubs extends Base {

    private $showRecOnPage = 10;
    private $pageNumber = 0;
    private $rowCount = 0;
    private $tableFilterList = array('fitnesclub_services',
                                     'fitnesclub_subscribe',
                                     'district');
    private $sortOrderList = array('popularity', 'ratingasc', 'ratingdesc', 'pricedesc','priceasc');
    private $rowOnPageList = array(10,25,50);
    private $order = 'rating';
    private $activeFilters = array();
    private $filterEnabled = false;
    private $searchQuery;

    private $functionGetList = 'getClubsList';
    private $functionRowCount = 'getRowCount';

    function __construct()
    {
        parent::__construct();
        $this->allowedPages = array('index', 'clubs', 'filter',
                                    'sort', 'search', 'row',
                                    'page', 'clear', 'vote');
        $this->privateAllowedPages = array();
        $this->titlePage = 'Фитнес клубы';
        $this->view = 'clubs/clubs';
        
        $this->breadCrumbsData[] = array(
            'href'  =>  site_url(array('clubs')),
            'title' => 'Список клубов'
        );
    }

    public function init()
    {
        $this->searchMode();
        
        if($this->session->userdata('rowOnPage'))
            $this->showRecOnPage = $this->session->userdata('rowOnPage');
        
        $this->viewData   = $this->initViewData();
        $headerData = $this->initHeaderData();
        
        foreach ($headerData as $key=>$value)
            $this->headerData[$key] =  $value;

    }

    public function clubs()
    {
        $this->session->unset_userdata('search');
        $this->session->unset_userdata('filter');
        $this->session->unset_userdata('activeFilter');
        $this->filterEnabled = false;
        $this->index();
    }

    private function initHeaderData()
    {
        $this->append_js(array("js/clubs.js"));
        
        $data = array('titleText'=>"ФитПарк. %s, тренажерные залы,
            фитнес центры, отзывы, стоимость, рейтинги, акции, скидки.");
        $data["titleText"] = sprintf($data["titleText"], lang("title"));
               
        return  $data;
    }

    private function initViewData()
    {
        $data = array(
            'list_header'   => $this->titlePage,
            'filters'       => $this->getFilters(),
            'services'      => $this->getClubsServices(),
            'order'         => $this->prepareOrder(),
            'baseUrlClub'   => $this->config->item("base_url")."club/",
            'content'       => $this->prapareClubList(),
            'paging'        => $this->preparePaging(),
            'activeFilters' => $this->activeFilters
        );

        return $data;
    }

    private function prapareClubList()
    {
        $list = call_user_func(array($this, $this->functionGetList));
        $this->rowCount = call_user_func(array($this, $this->functionRowCount));
        return $list;
    }

    private function getClubsList()
    {
        $limit = $this->showRecOnPage;
        $offset = $this->pageNumber;

        $filter = $this->generateFilter();
        return $this->fitpark_model->getClubList($this->order, $limit, $offset, $filter);
    }

    private function  getRowCount()
    {
        $filter = $this->generateFilter();
        return count($this->fitpark_model->getClubList($this->order, 10000000, 0, $filter));
    }

    function search()
    {
        $this->searchQuery = $this->input->post("search");
        $this->session->set_userdata('search', $this->searchQuery);

        $this->index();
    }

    private function getClubsByString()
    {
        $limit = $this->showRecOnPage;
        $offset = $this->pageNumber;

        $filter = $this->generateFilter();
        return $this->fitpark_model->getClubsByName($this->searchQuery, $this->order, $limit, $offset, $filter);
    }

    private function  getRowCountByString()
    {
        $filter = $this->generateFilter();
        return count($this->fitpark_model->getClubsByName($this->searchQuery, $this->order, 1000000, 0, $filter));
    }

    private function getClubsServices()
    {
        $results = $this->fitpark_model->getClubsServices();
        $options = array();
        foreach ($results as $row)
        {
            if(!key_exists($row->clubId, $options))
                $options[$row->clubId] = array();
            if(empty($row->icon))
                continue;
            array_push($options[$row->clubId], array('id'   => $row->serviceId,
                                                     'name' => $row->serviceName,
                                                     'class'=> $row->class,
                                                     'icon' => site_url(array('image',$row->icon))));
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
        $this->index();
    }

    private function setSortOrder($how)
    {
        if(in_array($how, $this->sortOrderList))
        {
            $this->session->set_userdata('order', $how);
            $this->order = $how;
        }
    }

    private function prepareOrder()
    {
        if($this->session->userdata('order'))
            $this->order = $this->session->userdata('order');
        return $this->order;
    }

    public function filter()
    {
        $this->setFilter();
        $this->index();
    }

    public function getByService($service)
    {
        $arr = $this->uri->segment_array();
        $service = (int)$arr[3];
        $_POST["rangeF"] = 0;
        $_POST["rangeT"] = 10000;
        $_POST["option1-".$service] = "on";
        $this->activeFilters["option1-".$service] = 1;
        $this->filter();
    }

    public function clear()
    {
        $this->session->unset_userdata('filter');
        $this->session->unset_userdata('activeFilter');
        $pars = $this->uri->segment_array();
        unset($pars[count($pars)]);
        redirect(site_url($pars));
    }

    private function setFilter()
    {
        $this->filterEnabled = true;
    }

    private function  generateFilter()
    {

        if($this->filterEnabled)
        {
            // User push on button "Filter"
            $filters = array();
            foreach (array_keys($this->activeFilters) as $option)
            {
                $value = $this->input->post($option);
                if($option === 'rangeF' || $option === 'rangeT')
                {
                    $filters = $this->setPriceRangeFilter($filters, $option);
                    $this->activeFilters[$option] = $value;
                }
                 if($this->input->post($option))
                 {

                    if($option !== 'rangeF' && $option !== 'rangeT')
                    {
                        $filters = $this->setFilterValue($filters, $option);
                        $this->activeFilters[$option] = true;
                    }
                }
            }
            $this->session->set_userdata('filter', json_encode($filters));
            $this->session->set_userdata('activeFilter', json_encode($this->activeFilters));
            return $filters;
        }
        else
        {
            // Get filter from session
            if($this->session->userdata('filter') && $this->session->userdata('activeFilter'))
            {
                $filters = json_decode($this->session->userdata('filter'), true);
                $this->activeFilters = json_decode($this->session->userdata('activeFilter'), true);
                return $filters;
            }
            return array();
        }

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

    public function row($onPage)
    {
        if(in_array($onPage, $this->rowOnPageList))
            $this->session->set_userdata('rowOnPage', $onPage);

        redirect(site_url(array('clubs','page')));
    }

    public function page($offset)
    {
        $this->pageNumber = (int)$offset;
        $this->index();
    }

    private function preparePaging()
    {
        $this->load->library('pagination');
        $pars = $this->uri->segment_array();

        $config['full_tag_open'] = '<ul class="type-sort" style="float:right;"> <li class="title-type-sort">Страница: </li>';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="item-type-sort">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="item-type-sort">';
        $config['cur_tag_close'] = '</li>';
        $config['next_link'] = 'Далее';
        $config['next_tag_open'] = '<li class="item-type-sort">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = 'Назад';
        $config['prev_tag_open'] = '<li class="item-type-sort">';
        $config['prev_tag_close'] = '</li>';
        $config['last_link'] = 'В конец';
        $config['last_tag_open'] = '<li class="item-type-sort">';
        $config['last_tag_close'] = '</li>';
        $config['first_link'] = 'В начало';
        $config['first_tag_open'] = '<li class="item-type-sort">';
        $config['first_tag_close'] = '</li>';

        $config['base_url'] = site_url(array('clubs','page'));
        $config['uri_segment'] = count($pars);
        $config['total_rows'] = $this->rowCount;
        $config['per_page'] = $this->showRecOnPage;
        $config['cur_page'] = $this->pageNumber;

        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }

    private function searchMode()
    {
        $this->searchQuery = $this->session->userdata('search');
        if(!empty($this->searchQuery))
        {
            $this->titlePage = "Поиск фитнес клубов: ".$this->searchQuery;
            $this->functionGetList = 'getClubsByString';
            $this->functionRowCount = 'getRowCountByString';
            
            $this->breadCrumbsData[] = array(
                'href'  => current_url(),
                'title' => 'Поиск клубов'
        );
        }
    }

}
?>