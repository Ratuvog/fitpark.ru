<?php
class Club extends CI_Model {
    
    public $table = 'fitnesclub';
    
    function updateFromBuffer($bufData)
    {
        $cur = $this->db->get_where($this->table, array('id' => $bufData->id))->row();
        foreach($cur as $key => $value)
            $cur->$key = $bufData->$key;
        $this->db->update($this->table, $cur, array('id' => $cur->id));
    }
}
?>
