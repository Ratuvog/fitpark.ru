<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_qatheme extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `qatheme`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `qatheme` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
        ");

        //Данные таблицы `qatheme`
        $this->db->query("
            INSERT INTO `qatheme` (`id`, `name`) VALUES
            (1, 'Все'),
            (2, 'Техника упражнений'),
            (3, 'Питание'),
            (4, 'Травмы'),
            (5, 'Тренировки'),
            (6, 'Другое');
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `qatheme`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `qatheme`");
    }
}