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
    
    function byName($cityName)
    {
        $this->db->select("*")
                 ->from($this->table)
                 ->where('name', mb_convert_case($cityName, MB_CASE_TITLE))
                 ->or_where("english_name", mb_convert_case($cityName, MB_CASE_TITLE));
        $result = $this->db->get()->row();
        
        if(!$result)
            return $this->db->get_where($this->table, array('name'=>'Самара'))->row();
        
        return $result;
    }
    
    function get()
    {
        $result = $this->db->get($this->table)->result();
        foreach($result as &$city) {
            $city->url = prep_url($city->url);
            $city->symbol_path = site_url(
                array(
                    "image",
                    "blazons",
                    $city->english_name.".jpg"
                )
            );
        }
        return $result;
    }
}
?>
