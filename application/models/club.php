<?php
class Club extends CI_Model {
    
    public $table = 'fitnesclub';
    public $rating = 'fitnesclub_rating';
    
    function prepare()
    {
        $this->db->select("$this->table.*, AVG($this->rating.value) as rating")
                 ->from($this->table)
                 ->join("$this->rating", "$this->table.id = $this->rating.clubId", "left")
                 ->group_by("$this->table.id");
    }
    
    function updateFromBuffer($bufData)
    {
        $cur = $this->db->get_where($this->table, array('id' => $bufData->id))->row();
        foreach($cur as $key => $value)
            $cur->$key = $bufData->$key;
        $this->db->update($this->table, $cur, array('id' => $cur->id));
    }
    
    function get_rand($limit)
    {
        $this->prepare();
        $set = $this->db->order_by('RAND()')
                        ->limit($limit)
                        ->get()->result();
        foreach($set as $club)
            $club->head_picture = ImageHelper::replace_path($club->head_picture, $this->config->item('empty_photo'));
        return $set;
    }
}
?>
