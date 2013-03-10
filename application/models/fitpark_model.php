<?php
class Fitpark_model extends CI_Model {
    /* Get info */
    private function getInfon($tableName, $row, $value) {
        return $this->db->get_where($tableName,array($row=>$value))->result();
    }

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


    function getClubsServices()
    {
        $this->db->select("fitnesclub_services.id as serviceId,
                           fitnesclub_services.name as serviceName,
                           fitnesclub_services.class as class,
                           fitnesclub_rel_services.clubId as clubId")
                ->from("fitnesclub_rel_services")
                ->join("fitnesclub_services", "fitnesclub_services.id = fitnesclub_rel_services.serviceId")
                ->join("fitnesclub", "fitnesclub.id = fitnesclub_rel_services.clubId")
                ->order_by("fitnesclub_rel_services.clubId","asc")
                ->order_by("fitnesclub_rel_services.priority","asc");

        return $this->db->get()->result();

    }
//dssdc
    function getFitnesClubFilter($table)
    {
            $this->db->select("varTable.*, filter.name as filterName")
                    ->from($table." as varTable")
                    ->join("fitnesclub_filter as filter", "varTable.filterId = filter.id");

        return $this->db->get()->result();
    }

    function getClubsTotalRating()
    {
        $this->db->select("rating.*, SUM(rating.value)/COUNT(rating.id) as totalrating")
                ->from("fitnesclub")
                ->join("fitnesclub_rating as rating", "fitnesclub.id = rating.clubId")
                ->group_by("fitnesclub.id");
        return $this->db->get()->result();

    }



}

?>
