<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_sale extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `sale`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `sale` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) CHARACTER SET utf8 NOT NULL,
              `clubId` int(11) NOT NULL,
              `content` text CHARACTER SET utf8 NOT NULL,
              `cityId` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('sale');
    }
}