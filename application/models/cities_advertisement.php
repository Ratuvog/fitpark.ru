<?php
class Cities_advertisement extends CI_Model {
    
    public $table = 'cities_advertisement';

    function byCity($cityid)
    {
        $this->db->from($this->table);
        $this->db->join('city', 'city.id ='.$this->table.'.city_id');
        $this->db->join('fitnesclub', 'fitnesclub.id ='.$this->table.'.club_id');
        return $this->db->get()->result();
    }
}
?>