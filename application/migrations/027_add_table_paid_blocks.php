<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_paid_blocks extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `paidBlocks`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `paidBlocks` (
              `Id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) CHARACTER SET utf8 NOT NULL,
              PRIMARY KEY (`Id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
        ");

        //Данные таблицы `paidBlocks`
        $this->db->query("
            INSERT INTO `paidBlocks` (`Id`, `name`) VALUES
            (1, 'Главная страница'),
            (2, 'Похожие клубы');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('paidBlocks');
    }
}