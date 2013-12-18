<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_table_buf_photo extends CI_Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `fitnesclub_photo` MODIFY COLUMN `state` int(11) NOT NULL DEFAULT '1'");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `fitnesclub_photo` MODIFY COLUMN `state` int(11) NOT NULL DEFAULT '0'");
    }
}