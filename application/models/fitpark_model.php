<?php
class Fitpark_model extends CI_Model {

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
