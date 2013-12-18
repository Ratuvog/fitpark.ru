<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_experts extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `exerciseType`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `experts` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `avatar` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
        ");

        // Добавление данных в таблицу 'experts'
        $this->db->query("
            INSERT INTO `experts` (`id`, `name`, `avatar`) VALUES
                (1, 'ФитПарк', 'logo.png');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('experts');
    }
}