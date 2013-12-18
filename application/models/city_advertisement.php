<?php
class City_advertisement extends CI_Model {
    
    public $table = 'city_advertisement';

    function byCity($cityid)
    {
        $this->db->from($this->table);
        $this->db->join('city', 'city.id ='.$this->table.'.cityid');
        $this->db->join('fitnesclub', 'fitnesclub.id ='.$this->table.'.clubid');
        return $this->db->get()->result();
    }
}
?>