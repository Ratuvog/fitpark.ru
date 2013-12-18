<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_analogs extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_analogs`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_analogs` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `fitnesclubid` int(11) NOT NULL,
              `analogid` int(11) NOT NULL,
              `priority` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_analogs`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_analogs`");
    }
}