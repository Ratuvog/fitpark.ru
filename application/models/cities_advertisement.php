<?php
class Cities_advertisement extends CI_Model {
    
    public $table = 'cities_advertisement';

    function byCity($cityid)
    {
        $this->db->from($this->table);
        $this->db->join('fitnesclub', "fitnesclub.id =".$this->table.".club_id");
        $this->db->where('city_id', $cityid );
        return $this->db->get()->result();
    }
}
?>