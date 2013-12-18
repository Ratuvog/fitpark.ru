<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fitnesclub_services_buffer extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `buf_club_services`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `buf_club_services` (
              `id` int(11) NOT NULL,
              `clubId` int(11) NOT NULL,
              `serviceId` int(11) NOT NULL,
              `priority` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `buf_club_services`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `buf_club_services`");
    }
}