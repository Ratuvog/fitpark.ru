<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_filters extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_filter`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_filter` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) DEFAULT NULL,
              `description` text,
              `icon` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;
        ");

        //Данные таблицы `fitnesclub_filter`
        $this->db->query("
            INSERT INTO `fitnesclub_filter` (`id`, `name`, `description`, `icon`) VALUES
                (1, 'Есть в клубе', '<p>\r\n	Фильтр по переченю предоставляемых клубом видов услуг.</p>\r\n', NULL),
                (2, 'Район', '<p>\r\n	Фильтр по районому расположению клуба</p>\r\n', NULL),
                (3, 'Тип абонемента', '<p>\r\n	Фильтр по типу предлагаемых клубом абонементов</p>\r\n', NULL);
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_filter`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_filter`");
    }
}