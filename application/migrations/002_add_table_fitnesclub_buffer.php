<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_buffer extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `buf_club`
        $this->db->query("
          CREATE TABLE IF NOT EXISTS `buf_club` (
              `id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `description` text NOT NULL,
              `icon` varchar(255) NOT NULL,
              `head_picture` varchar(255) NOT NULL,
              `tags` text NOT NULL,
              `segment` varchar(512) NOT NULL,
              `address` varchar(1024) NOT NULL,
              `phone` varchar(100) NOT NULL,
              `site` varchar(100) NOT NULL,
              `work_hours` varchar(255) NOT NULL,
              `singlePrice` int(11) NOT NULL DEFAULT '0',
              `sub1` int(11) NOT NULL DEFAULT '0',
              `sub3` int(11) NOT NULL DEFAULT '0',
              `sub6` int(11) NOT NULL DEFAULT '0',
              `sub12` int(11) NOT NULL DEFAULT '0',
              `viewCount` int(11) NOT NULL DEFAULT '0',
              `districtId` int(11) NOT NULL,
              `isHideAnalogs` tinyint(1) NOT NULL DEFAULT '0',
              `cityid` int(11) NOT NULL DEFAULT '1',
              `managerId` int(11) DEFAULT NULL,
              `state` int(11) NOT NULL DEFAULT '0',
              `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `comment` text NOT NULL,
              PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `buf_club`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `buf_club`");
    }
}