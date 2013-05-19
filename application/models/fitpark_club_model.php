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
        $query = "SELECT DATE_FORMAT(date,'%d.%m.%Y') outdate, text, sender, positive, negative FROM fitnesclub_review WHERE fitnesclubid = ?";
        $q = $this->db->query($query,array($clubId));
        return $q->result_array();
    }

    function getImages($clubId) {
        return $this->getInfon("fitnesclub_photo", "fitnesclubid", $clubId);
    }

    function getAnalogs($clubId) {
        $query = "SELECT f1 . *
                FROM fitnesclub f1, fitnesclub f2
                WHERE
                    f1.id != f2.id
                    AND (  ( (f1.sub3 > f2.sub3)  AND (f1.sub3 - f2.sub3) <=500)
                        OR ( (f1.sub3 <= f2.sub3) AND (f2.sub3 - f1.sub3) <=500))
                    AND f2.id = ? LIMIT 0,3";
        $q = $this->db->query($query,array($clubId));
        return $q->result_array();
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

    function addReview($clubid, $text, $sender, $positive, $negatie)
    {
        $insertData = array(
            "fitnesclubid"=>$clubid,
            "text"        =>$text,
            "sender"      =>$sender,
            "positive"    =>$positive,
            "negative"    =>$negatie
        );
        $this->db->insert("fitnesclub_review",$insertData);
    }


//////////////////////////////private////////////////////////////////////////


     /* Get info */
    private function getInfon($tableName, $row, $value) {
        return $this->db->get_where($tableName,array($row=>$value))->result_array();
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
