<?php
class City extends CI_Model {
    
    public $table = 'city';
    
    function map()
    {
        $cities = $this->db->get($this->table)->result();
        $map = array();
        foreach ($cities as $city)
            $map[$city->id] = $city->name;
        return $map;
    }
}
?>
