<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_feedback extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `feedback`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `feedback` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `tel` varchar(255) NOT NULL,
              `clubid` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;
        ");

        // Добавление данных в таблицу 'feedback'
        $this->db->query("
            INSERT INTO `feedback` (`id`, `name`, `tel`, `clubid`) VALUES
                (4, 'Гульшат', '89174039004', 471),
                (5, 'Вячеслав', '89371777494', 173),
                (6, 'Гузель', '89899568072', 472),
                (7, 'елена', '89023352547', 129);
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `feedback`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `feedback`");
    }
}