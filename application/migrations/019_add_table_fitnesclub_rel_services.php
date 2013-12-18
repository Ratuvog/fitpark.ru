<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_rel_services extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_rel_services`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_rel_services` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `clubId` int(11) NOT NULL,
              `serviceId` int(11) NOT NULL,
              `priority` int(11) NOT NULL DEFAULT '999999999',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1303;
        ");

        $this->load->helper('file');
        // Добавление данных в таблицу 'fitnesclub_rel_services'
        if (file_exists("application/migrations/fitnesclub_rel_services_data_migration_019.query"))
            $this->db->query(read_file("application/migrations/fitnesclub_rel_services_data_migration_019.query"));
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_rel_services`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_rel_services`");
    }
}