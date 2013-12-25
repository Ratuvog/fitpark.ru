<?php
class Subscription extends CI_Model {
    
    private $table = 'Abonements';
    private $acceptState = '1';
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    function get($where)
    {
        return count($this->db->get_where($this->table, $where)->result());
    }

    function active($clubId)
    {
        return $this->db->get_where($this->table, array('clubid' => $clubId, 'state'=>$this->acceptState))->result_array();
    }

    function updateState($id, $state)
    {
        return $this->db->update($this->table, array('state' => $state), array('id'=>$id));
    }
}
?>