<?php
class Manager_model extends CI_Model {
    
    public $table = 'manager';
    
    function map()
    {
        $managers = $this->all();
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

    function all()
    {
        return $this->db->get($this->table)->result();
    }

    function get($where)
    {
        return $this->db->get_where($this->table, $where)->result();
    }

    function reject($id)
    {
        $this->db->update($this->table, array('activity'=>2), array('id'=>$id));
    }

    function accept($id)
    {
        $this->db->update($this->table, array('activity'=>1), array('id'=>$id));
    }
}
?>