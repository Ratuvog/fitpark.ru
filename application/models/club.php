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
    
    function get_rand($limit)
    {
        $set = $this->db->from($this->table)
                        ->order_by('RAND()')
                        ->limit($limit)
                        ->get()->result();
        foreach($set as $club)
            $club->head_picture = ImageHelper::replace_path($club->head_picture, $this->config->item('empty_photo'));
        return $set;
    }
}
?>
