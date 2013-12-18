<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_fcheck extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_checkout`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_checkout` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `type` int(11) NOT NULL,
              `name` varchar(255) CHARACTER SET utf8 NOT NULL,
              `tel` varchar(255) CHARACTER SET utf8 NOT NULL,
              `e-mail` int(11) NOT NULL,
              `clubid` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `fitnesclub_checkout`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `fitnesclub_checkout`");
    }
}