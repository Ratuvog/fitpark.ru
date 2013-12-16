<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/18/13
 * Time: 12:18 AM
 * To change this template use File | Settings | File Templates.
 */
class Program_images extends CI_Model {
    private $table = "program_images";
    function add($programId, $images)
    {
        $insertData = array();
        foreach ($images as $val) {
            $insertData[] = array(
                'programId' => $programId,
                'image'     => $val
            );
        }
        $this->db->insert_batch('program_images',$insertData);
    }
}

?>