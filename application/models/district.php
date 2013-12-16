<?php
class District extends CI_Model {
    
    public $table = 'district';
    
    function map()
    {
        $districts = $this->db->get($this->table)->result();
        $map = array();
        foreach ($districts as $district)
            $map[$district->id] = $district->name;
        return $map;
    }

    function byCity($cityId)
    {
        return $this->db->get_where($this->table, array('cityId'=>$cityId))->result();
    }
}
?>
