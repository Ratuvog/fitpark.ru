<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/25/13
 * Time: 12:30 AM
 * To change this template use File | Settings | File Templates.
 */

class Sales_model extends CI_Model
{
    private $table = "sale";

    function byId($id)
    {
        return $this->db->get_where($this->table,array("id"=>$id))->row();
    }

    function getList()
    {
        return $this->db->get($this->table)->result();
    }
}

?>