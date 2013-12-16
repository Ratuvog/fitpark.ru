<?php
class Feedback extends CI_Model {
    
    public $table = 'feedback';
            
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