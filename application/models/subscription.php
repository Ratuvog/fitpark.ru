<?php
class Subscription extends CI_Model {
    
    public $table = 'Abonements';
            
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    function get($where)
    {
        return count($this->db->get_where($this->table, $where)->result());
    }
}
?>