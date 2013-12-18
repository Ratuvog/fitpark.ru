<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `description` text NOT NULL,
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
              `cityid` int(11) DEFAULT NULL,
              `managerId` int(11) DEFAULT NULL,
              `icon` varchar(255) NOT NULL,
              `geo` varchar(255) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `districtId` (`districtId`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=488 ;
        ");

        $this->load->helper('file');
        // Добавление данных в таблицу 'fitnesclub'
        if (file_exists("application/migrations/fitnesclub_data_migration_012.query"))
            $this->db->query(read_file("application/migrations/fitnesclub_data_migration_012.query"));
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub`");
    }
}