<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_photo extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_description`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_photo` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `photo` varchar(255) DEFAULT NULL,
              `fitnesclubid` int(11) NOT NULL,
              `min_photo` varchar(255) NOT NULL,
              `title` text NOT NULL,
              `state` int(11) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2345 ;
        ");

        $this->load->helper('file');
        // Добавление данных в таблицу 'fitnesclub_photo'
        if (file_exists("application/migrations/fitnesclub_photo_data_migration_017.query"))
            $this->db->query(read_file("application/migrations/fitnesclub_photo_data_migration_017.query"));
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_photo`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_photo`");
    }
}