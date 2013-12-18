<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_rating extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_rating`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_rating` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `clubId` int(11) NOT NULL,
              `datetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
              `sender` varchar(255) DEFAULT NULL,
              `comment` text,
              `value` int(11) NOT NULL,
              `reviewId` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=286 ;
        ");

        $this->load->helper('file');
        // Добавление данных в таблицу 'fitnesclub_rating'
        if (file_exists("application/migrations/fitnesclub_rating_data_migration_018.query"))
            $this->db->query(read_file("application/migrations/fitnesclub_rating_data_migration_018.query"));
    }

    public function down()
    {
        $this->dbforge->drop_table('fitnesclub_rating');
    }
}