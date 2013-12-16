<?php
class Buf_club_service extends CI_Model {
    
    public $table = 'buf_club_services';
    
    function byClub($club)
    {
        return $this->db->get_where($this->table, array('clubId'=>$club))->result();
    }
    
}
?>