<?php
class Review extends CI_Model {
    
    public $table = 'fitnesclub_review';
    public $rating = 'fitnesclub_rating';
            
    function byClub($club)
    {
        $this->db->select("$this->table.*,
                           $this->rating.*,
                           $this->table.id id,
                           $this->table.sender sender,
                           DATE_FORMAT(date, '%d.%m.%Y %k:%i') outdate,
                           $this->rating.value as rating", FALSE)
                ->from("$this->table")
                ->join("$this->rating", "$this->table.senderIP = $this->rating.sender", 'left')
                ->where(array("$this->table.fitnesclubid" => $club))
                ->group_by("$this->table.id")
                ->order_by("$this->table.id", "desc");
        return $this->db->get()->result();
    }
    
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
}
?>