<?php
class Fitpark_club_model extends CI_Model {

    /* Get base info club */
    function getBaseInfoClub($clubId) {
        return $this->db->get_where("fitnesclub",array("id"=>$clubId))->result_array();
    }

    /* Get rate club */
    function getRatesClub($clubId) {
        $nameMonth = array(
            "1 месяц",
            "3 месяца",
            "6 месяцев",
            "12 месяцев"
        );
        $query = "SELECT
                    sub1, sub3, sub6, sub12
                  FROM
                    fitnesclub
                  WHERE
                    id=?";
        $q = $this->db->query($query,array($clubId));
        $q = $q->result_array();
        $result = array(
            array(
                "period"=>"1 месяц",
                "price"=>$q[0]["sub1"]
                ),
            array(
                "period"=>"3 месяца",
                "price" =>$q[0]["sub3"]
                ),
            array(
                "period"=>"6 месяцев",
                "price" =>$q[0]["sub6"]
                ),
            array(
                "period"=>"12 месяцев",
                "price" =>$q[0]["sub12"]
                )
        );
        return $result;
    }

    /* Get reviews about club */
    function getReviewsClub($clubId) {
        return $this->getInfon("fitnesclub_review", "fitnesclubid", $clubId);
    }

    function getImages($clubId) {
        return $this->getInfon("fitnesclub_photo", "fitnesclubid", $clubId);
    }

    function getAnalogs($clubId) {
        $this->db->select("*")
                          ->from("fitnesclub")
                          ->join("fitnesclub_analogs","fitnesclub_analogs.analogid=fitnesclub.id")
                          ->where("fitnesclub_analogs.fitnesclubid",$clubId);
        $query = $this->db->get();
        return $query->result();
    }

    function getClubList($limit, $offset)
    {
        $this->db->select("*")
                ->from("fitnesclub")
                ->limit($limit, $offset);
        return $this->db->get()->result();
    }

    function getGuest($clubId, $name, $email, $tel)
    {
        $this->insertCheckout($clubId, $name, $email, $tel, 2);
    }

    function getDiscount($clubId, $name, $email, $tel)
    {
        $this->insertCheckout($clubId, $name, $email, $tel, 1);
    }

    function addClubView($clubId)
    {
        $this->db->select("viewCount")
                ->from("fitnesclub")
                ->where("id", $clubId);
        $count = $this->db->get()->result_array();
        
        $data = array(
               'viewCount' => $count[0]['viewCount'] + 1
            );
        $this->db->where('id', $clubId);
        $this->db->update('fitnesclub', $data); 
    }
    
//////////////////////////////private////////////////////////////////////////


     /* Get info */
    private function getInfon($tableName, $row, $value) {
        return $this->db->get_where($tableName,array($row=>$value))->result();
    }

    private function insertCheckout($clubid,$name, $email, $tel, $type)
    {
        $insertData = array(
            "clubid" => $clubid,
            "type"   => $type,
            "name"   => $name,
            "e-mail" => $email,
            "tel"    => $tel
        );
        $this->db->insert('fitnesclub_checkout',$insertData);
    }

}

?>
