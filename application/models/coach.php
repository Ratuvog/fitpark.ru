<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/16/13
 * Time: 10:51 PM
 * To change this template use File | Settings | File Templates.
 */
class Coach extends CI_Model {
    private $table = "coach";
    function byId($id = 1)
    {
        return $this->db->get_where($this->table,array("id"=>$id))->row();
    }
}
?>