<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_photo_buffer extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `buf_club_photo`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `buf_club_photo` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `photo` varchar(255) DEFAULT NULL,
              `fitnesclubid` int(11) NOT NULL,
              `min_photo` varchar(255) NOT NULL,
              `title` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
        ");

        // Триггеры `buf_club_photo`
        $this->db->query("DROP TRIGGER IF EXISTS `update_buf_club_photo`;");
        $this->db->query("
            CREATE TRIGGER `update_buf_club_photo` AFTER UPDATE ON `buf_club_photo`
             FOR EACH ROW BEGIN
             update `buf_club` set state = 1 where id = NEW.fitnesclubid;
            END;
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('buf_club_photo');
    }
}