<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_description extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_description`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_description` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `clubid` int(11) NOT NULL,
              `text` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=267 ;
        ");

        $this->load->helper('file');
        // Добавление данных в таблицу 'fitnesclub_description'
        if (file_exists("application/migrations/fitnesclub_description_data_migration_015.query"))
            $this->db->query(read_file("application/migrations/fitnesclub_description_data_migration_015.query"));
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_description`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_description`");
    }
}