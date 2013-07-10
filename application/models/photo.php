<?php
class Photo extends CI_Model {
    
    public $table = 'fitnesclub_photo';
    public $foreign_key = 'fitnesclubid';
  
    function updateFromBuffer($club)
    {
        $where = array($this->foreign_key => $club, 'state' => 1);
        $this->db->update($this->table, array('state' => 0), $where);
    }
    
    function byClub($club, $state = 0)
    {
        $where = array($this->foreign_key => $club, 'state' => $state);
        return $this->db->get_where($this->table, $where)->result();
    }
    
    function setData($id, $field, $value)
    {
        $this->db->update($this->table, array($field => $value), array('id' => $id));
    }
}
?>