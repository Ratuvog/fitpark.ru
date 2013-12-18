<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_subscribe extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_subscribe`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_subscribe` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `duration` int(11) NOT NULL,
              `filterid` int(11) NOT NULL DEFAULT '3',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5;
        ");

        //Данные таблицы `fitnesclub_subscribe`
        $this->db->query("
            INSERT INTO `fitnesclub_subscribe` (`id`, `name`, `duration`, `filterid`) VALUES
            (1, 'На месяц', 1, 3),
            (2, 'Три месяца', 3, 3),
            (3, 'Шесть месяцев', 6, 3),
            (4, 'На год', 12, 3);
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_subscribe`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_subscribe`");
    }
}