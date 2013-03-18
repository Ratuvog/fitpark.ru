<?php
class Fitpark_model extends CI_Model {

    private $filterIdToType = array(
        1 => 'service',
        2 => 'district',
        3 => 'subscribe'
    );

    private $subscribeIdToType = array(
        1 => 'sub1',
        2 => 'sub3',
        3 => 'sub6',
        4 => 'sub12'
    );

    /**
     * Доступные стратегии сортировки
     * @var array
     */
    private $m_avialableSortStrategy = array(
        "Popularity",
        "PriceDesc",
        "PriceAsc"
    );

    private $m_avialableSearchStrategy = array(
        "Name"
    );

    /**
     * Стратегии начальной инициализации запросов
     */

    /**
     * Метод возвращает список фитнес-клубов
     */
    private function initListClubs($limit,$offset)
    {
         $this->db->select("*, (sub3)/3 as avg3, (sub6)/6 as avg6, (sub12)/12 as avg12")
            ->from("fitnesclub")
            ->limit($limit,$offset);
    }


    /**
     * Стратегии сортировки данных
     */

    /**
     * Сортировка по популярности
     */
    private function sortByPopularity()
    {
        $this->db->order_by("viewCount","desc");
    }
    /**
     * Сортировка по цене
     * @param string $ord порядок соритровки
     */
    private function sortByPriceAsc()
    {
        $this->order_by("sub1", 'asc')
             ->order_by("avg3", 'asc')
             ->order_by("avg6", 'asc')
             ->order_by("avg12",'asc');
    }
    private function sortByPriceDesc()
    {
        $this->order_by("sub1", 'desc')
             ->order_by("avg3", 'desc')
             ->order_by("avg6", 'desc')
             ->order_by("avg12",'desc');
    }

    /**
     * Вызов соответствующей стратегии сортировки по имени
     * @param string $name название стратегии
     */
    private function getSortStrategyByName($name)
    {
        if(in_array($name, $this->m_avialableSortStrategy)) {
            call_user_func(array($this,'sortBy'.$name));
        } else {
            call_user_method(array('sortByPopularity', $this));
        }
    }


    /**
     * Стратегии поиска
     */

    /**
     * Поиск по названию
     */
    private function searchByName($name)
    {
        $this->db->like("name",$name, 'both');
    }

    /**
     * Вызов соотвтетствующей стратегии поиска по имени
     * @param string $nameStrategy имя стратегии
     * @param string $searchString поисковый запрос
     */
    private function getSearchStrategyByName($nameStrategy, $searchString)
    {
        if(in_array($nameStrategy, $this->m_avialableSearchStrategy)) {
            call_user_func(array($this, 'searchBy'.$nameStrategy), $searchString);
        }
    }

    /**
     * Выводит список клубов.
     * @param string $ord порядок сортировки
     * @param int $limit  количество клубов на странице
     * @param int $offset смещение
     * @param mixed $filter фильтер клубов
     * @return array список клубов
     */
    function getClubList($ord, $limit, $offset, $filter)
    {
        $this->initListClubs($limit, $offset);
        $this->getSortStrategyByName($ord);
        $this->installFilter($filter);
        return $this->db->get()->result();
    }

    /**
     * Поиск клубов по имени
     * @param type $name имя клуба
     * @param type $ord порядок сортировки
     * @param type $limit количество клубов на странице
     * @param type $offset смещение
     * @return array список клубов
     */
    function getClubsByName($name, $ord, $limit, $offset)
    {
        $this->initListClubs($limit, $offset);
        $this->getSortStrategyByName($ord);
        $this->getSearchStrategyByName('Name',$name);
        return $this->db->get()->result();
    }

    private function installFilter($filter)
    {
        if(count($filter) == 0)
            return;
        $this->db->group_by("fitnesclub.id");
        foreach (array_keys($filter) as $filterId)
        {
            if($filterId === 'rangeF')
                $this->filterForLowRange($filter[$filterId]);
            if($filterId === 'rangeT')
                $this->filterForHighRange($filter[$filterId]);
            
            if(key_exists($filterId, $this->filterIdToType))
            {
                $type = $this->filterIdToType[$filterId];
                if($type === 'service')
                {
                    $this->db->join("fitnesclub_rel_services service","fitnesclub.id = service.clubId");
                    $this->db->where_in('service.serviceId', $filter[$filterId]);
                }
                if($type === 'district')
                    $this->db->where_in('fitnesclub.districtId', $filter[$filterId]);
                if($type === 'subscribe')
                    $this->filterForSubscribe($filter[$filterId]);
            }
        }
    }

    private function filterForSubscribe($set)
    {
        foreach ($set as $item)
            $this->db->where($this->subscribeIdToType[$item].' >', "0");
    }
     
    private function filterForLowRange($val)
    {
        $cond = 'sub1 >=';
        $this->db->where($cond, $val[0]);
    }
    
        private function filterForHighRange($val)
    {
        $cond = 'sub1 <=';
        $this->db->where($cond, $val[0]);
    }

    function getClubsServices()
    {
        $this->db->select("fitnesclub_services.id as serviceId,
                           fitnesclub_services.name as serviceName,
                           fitnesclub_services.class as class,
                           fitnesclub_rel_services.clubId as clubId")
                ->from("fitnesclub_rel_services")
                ->join("fitnesclub_services", "fitnesclub_services.id = fitnesclub_rel_services.serviceId")
                ->join("fitnesclub", "fitnesclub.id = fitnesclub_rel_services.clubId")
                ->order_by("fitnesclub_rel_services.clubId","asc")
                ->order_by("fitnesclub_rel_services.priority","asc");

        return $this->db->get()->result();

    }

    function getFitnesClubFilter($table)
    {
            $this->db->select("varTable.*, filter.name as filterName")
                    ->from($table." as varTable")
                    ->join("fitnesclub_filter as filter", "varTable.filterId = filter.id");

        return $this->db->get()->result();
    }

    function getClubsTotalRating()
    {
        $this->db->select("rating.*, SUM(rating.value)/COUNT(rating.id) as totalrating")
                ->from("fitnesclub")
                ->join("fitnesclub_rating as rating", "fitnesclub.id = rating.clubId")
                ->group_by("fitnesclub.id");
        return $this->db->get()->result();

    }

}

?>
