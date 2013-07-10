<?php
class Fitpark_club_model extends CI_Model {
    private $defaultUser = "Неизвестный";
    
    /* Get base info club */
    function lastInsertedId()
    {
        return $this->db->insert_id();
    }

    function getBaseInfoClub($clubId)
    {
        $this->db->select("fitnesclub.*, AVG(r.value) as rating, COUNT(r.clubId) as votes")
            ->from("fitnesclub")
            ->join("fitnesclub_rating as r", "fitnesclub.id = r.clubId", 'left')
            ->group_by("fitnesclub.id")
            ->where(array('fitnesclub.id'=>$clubId));
        
        $clubs = $this->db->get()->result();
        mutator_clubs_null_field($clubs, "head_picture", $this->config->item('empty_photo'));
        return $clubs;
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
        $this->db->select("f.id id, DATE_FORMAT(date, '%d.%m.%Y') outdate, text, f.sender, positive, negative, r.value as rating, type", FALSE)
                 ->from("fitnesclub_review f")
                 ->join("fitnesclub_rating r", "f.senderIP = r.sender", 'left')
                 ->where(array("f.fitnesclubid"=>$clubId))
                 ->group_by("f.id")
                 ->order_by("f.id", "desc");
        return $this->db->get()->result_array();
    }

    function getImages($clubId) {
        return $this->getInfon("fitnesclub_photo", "fitnesclubid", $clubId);
    }

    function updateThumb($id, $src) {
        $data = array(
            "min_photo"=>$src
        );
        $this->db->update("fitnesclub_photo",$data,array("id"=>$id));
    }

    function getAnalogs($clubId) {
        $cityid = $this->session->userdata("city");
        $query = "SELECT f1 . *
                FROM fitnesclub f1, fitnesclub f2
                WHERE
                    f1.id != f2.id
                    AND (  ( (f1.sub3 > f2.sub3)  AND (f1.sub3 - f2.sub3) <=500)
                        OR ( (f1.sub3 <= f2.sub3) AND (f2.sub3 - f1.sub3) <=500))
                    AND
                      f1.cityid = $cityid
                    AND f2.id = ? LIMIT 0,3";
        
        $analogs = $this->db->query($query,array($clubId))->result();
        mutator_clubs_null_field($analogs, "head_picture", $this->config->item('emptyPhoto'));
        return $analogs;
    }

  /*  function getClubList($limit, $offset)
    {
        $this->db->select("*")
                ->from("fitnesclub")
                ->limit($limit, $offset);
        return $this->db->get()->result();
    }*/

    function getGuest($clubId, $name, $tel, $email, $date)
    {
        $data = array(
            "clubid" => $clubId,
            "name"   => $name,
            "tel"    => $tel,
            "email"  => $email,
            "date"   => $date
        );
        $this->db->insert("guest", $data);
    }

    function getAbonement($clubId, $name, $surname, $tel, $email, $date)
    {
        $data = array(
            "clubid" =>$clubId,
            "name"   =>$name,
            "surname"=>$surname,
            "tel"    =>$surname,
            "email"  =>$email,
            "date"   =>$date
        );
        $this->db->insert("Abonements", $data);
    }

    function getFeedback($clubId, $name, $tel)
    {
        $data = array(
            "clubId" => $clubId,
            "name"   => $name,
            "tel"    => $tel
        );
        $this->db->insert("feedback", $data);
    }

    function getQuestion($clubId, $name, $email, $question)
    {
        $data = array(
            "clubid"  => $clubId,
            "name"    => $name,
            "email"   => $email,
            "question"=> $question
        );
        $this->db->insert("question", $data);
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

//    function addReview($clubid, $senderIP, $text, $sender, $positive, $negatie)
    function addReview($insertedData)
    {
        if(!$insertedData["user"]) {
            $sender = $this->defaultUser;
        }
        $insertData = array(
            "fitnesclubid"=>$insertedData["clubId"],
            "text"        =>$insertedData["text"],
            "sender"      =>$insertedData["user"],
            "positive"    =>$insertedData["plus"],
            "negative"    =>$insertedData["minus"],
            "senderIP"    =>$insertedData["ip"],
            "type"        =>$insertedData["type"]
        );
        $this->db->insert("fitnesclub_review",$insertData);
    }

    function descriptions($clubId)
    {
        $this->db->select("*")->from('fitnesclub_description')
                 ->where(array('clubid'=>$clubId));
        return $this->db->get()->result_array();
    }

    function userVote($clubId, $sender)
    {
        $this->db->select("value as vote")
                 ->from("fitnesclub_rating")
                 ->where(array("clubId"=>$clubId, "sender"=>$sender));
        return $this->db->get()->result_array();
    }

    function addVote($clubId, $sender, $val)
    {
        $query = $this->db->select("*")
                 ->from('fitnesclub_rating')
                 ->where(array('sender'=>$sender, 'clubId'=>$clubId))
                 ->get()->result_array();

        if(count($query) != 0)
            return false;

        $data = array(
               'clubId' => $clubId,
               'sender' => $sender,
               'value'  => $val
            );
        $this->db->insert('fitnesclub_rating', $data);
        return true;
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
