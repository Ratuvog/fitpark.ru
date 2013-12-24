<?php
class Manager_model extends CI_Model {
    
    public $table = 'manager';
    
    function map()
    {
        $managers = $this->db->get($this->table)->result();
        $map = array();
        foreach ($managers as $manager)
            $map[$manager->id] = $manager->name;
        return $map;
    }
    
    function byName($login)
    {
        return $this->db->get_where($this->table, array('login' => $login))->row();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
}
?>