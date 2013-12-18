<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_manager extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `manager`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `manager` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `login` varchar(255) NOT NULL,
              `password` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `phone` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
        ");

        //Данные таблицы `manager`
        $this->db->query("
            INSERT INTO `manager` (`id`, `name`, `login`, `password`) VALUES
            (1, 'Федя', 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('manager');
    }
}