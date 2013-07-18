<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/18/13
 * Time: 12:17 AM
 * To change this template use File | Settings | File Templates.
 */
class Programs extends CI_Model {
    private $table = "programs";
    function create($data)
    {
        $inserData = array(
            'where_to_train' => $data['where'],
            'gender'         => $data['gender'],
            'target'         => $data['target'],
            'years'          => $data['years'],
            'experience'     => $data['experience'],
            'weight'         => $data['weight'],
            'periodicity'    => $data['periodicity'],
            'height'         => $data['height'],
            'comments'       => $data['comments'],
            'email'          => $data['email']
        );
        $this->db->insert("programs",$inserData);
        /* Возвращаем последнюю вставленную запись */
        $lastInsertId = $this->db->query("SELECT LAST_INSERT_ID() id")->row();
        return $lastInsertId->id;
    }
}
?>