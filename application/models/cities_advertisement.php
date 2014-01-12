<?php
class Cities_advertisement extends CI_Model {
    
    public $table = 'cities_advertisement';

    function byCity($cityid)
    {
        $this->db->from($this->table);
        $this->db->where('cityId', $cityid );
        return $this->db->get()->result();
    }
}
?>