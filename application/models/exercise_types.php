<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/22/13
 * Time: 8:52 PM
 * To change this template use File | Settings | File Templates.
 */

class Exercise_types extends CI_Model
{
    private $table = "exerciseType";

    function getList()
    {
        return $this->db->get($this->table)->result();
    }
}


?>