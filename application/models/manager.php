<?php
class Manager extends CI_Model {
    
    public $table = 'manager';
    
    function map()
    {
        $managers = $this->db->get($this->table)->result();
        $map = array();
        foreach ($managers as $manager)
            $map[$manager->id] = $manager->name;
        return $map;
    }
}
?>