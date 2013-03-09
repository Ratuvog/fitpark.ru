<?php
class Fitpark_model extends CI_Model {
    /* Get info */
    private function getInfon($tableName, $row, $value) {
        return $this->db->get_where($tableName,array($row=>$value))->result();
    }

    /* Get base info club */
    function getBaseInfoClub($clubId) {
        return $this->getInfon("fitnesclub", "id", $clubId);
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
        $result = array(
            array(
                "period"=>"1 месяц",
                "price"=>$q["sub1"]
                ),
            array(
                "period"=>"3 месяца",
                "price" =>$q["sub3"]
                ),
            array(
                "period"=>"6 месяцев",
                "price" =>$q["sub6"]
                ),
            array(
                "period"=>"12 месяцев",
                "price" =>$q["sub12"]
                )
        );
        return $result;
    }

    /* Get reviews about club */
    function getReviewsClub($clubId) {
        return $this->getInfon("item_review", "fitnesclubid", $clubId);
    }

    function getImages($clubId) {
        return $this->getInfon("item_foto", "fitnesclubid", $clubId);
    }

    function getAnalogs($clubId) {
        $this->db->select("*")
                          ->from("fitnesclub")
                          ->join("fitnesclub_analogs","fitnesclub_analogs.analogid=fitnesclub.id")
                          ->where("fitnesclub_analogs.fitnesclubid",$clubId);
        $query = $this->db->get();
        return $query->result();
    }
}

?>
