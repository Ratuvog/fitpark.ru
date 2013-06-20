<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 6/19/13
 * Time: 11:17 PM
 * To change this template use File | Settings | File Templates.
 */

class Fitpark_qa_model extends CI_Model {
    function getAnsweredQuestions($theme = 0) {
        $this->db->select("qa.*, e.name ename, e.avatar avatar")
                 ->from("QA qa")
                 ->join("experts e", "e.id = qa.expertid")
                 ->join("qatheme t", "t.id = qa.qathemeid")
                 ->where(array("qa.expertid !="=>-1,"qa.qathemeid !="=>-1));
        if($theme != 0) {
            $this->db->where("qa.qathemeid",$theme);
        }
        return $this->db->get()->result();
    }

    function getAvailableThemes() {
        $q = $this->db->get("qatheme");
        return $q->result_array();
    }

    function addQuestion($data) {
        $prepData = array(
            'user'     => $data["user"],
            'email'    => $data['email'],
            'question' => $data['question']
        );
        $this->db->insert("QA",$prepData);
    }
}

?>