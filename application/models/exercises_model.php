<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/22/13
 * Time: 8:40 PM
 * To change this template use File | Settings | File Templates.
 */

class Exercises_model extends CI_Model
{
    private $table = "exercises";

    function byTypeId($typeId = 1)
    {
        $this->db->select('*')->from($this->table);
        if($typeId != 1)
        {
            $this->db->where("typeId",$typeId);
        }

        return $this->db->get()->result();
    }

    function byTypeIdWidget($typeId = 1, $limit = 4) {
        $this->db->select('*')->from($this->table);
        if($typeId != 1)
        {
            $this->db->where("typeId",$typeId);
        }

        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    function byId($id)
    {
        return $this->db->get_where($this->table,array('id'=>$id))->row();
    }
}

?>