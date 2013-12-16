<?php
class Service extends CI_Model {
    
    public $table = 'fitnesclub_services';
    public $relTable = 'fitnesclub_rel_services';
    
    function map()
    {
        $services = $this->db->get($this->table)->result();
        //$this->after_get($services);
        $map = array();
        foreach ($services as $service)
            $map[$service->id] = $service;
        return $map;
    }
    
    function updateFromBuffer($bufData, $club)
    {
        $this->db->delete($this->relTable, array('clubId'=>$club));
        foreach($bufData as $data)
            $this->db->insert($this->relTable, $data);
    }
    
    function get()
    {
        $set = $this->db->get($this->table)->result();
        $this->after_get($set);
        return $set;
    }
    
    function byClub($club)
    {
        $set = $this->db->get_where($this->relTable, array('clubId'=>$club))->result();
        return $set;
    }
    
    function after_get($set)
    {
        foreach($set as &$row)
            $row->icon = ImageHelper::replace_path($row->icon, '');
    }
}
?>