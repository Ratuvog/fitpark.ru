<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_paid_shows extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `paidShows`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `paidShows` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `clubId` int(11) NOT NULL,
              `paidBlockId` int(11) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `clubid_paidBlockId_unique` (`clubId`,`paidBlockId`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;
        ");

        //Данные таблицы `paidShows`
        $this->db->query("
            INSERT INTO `paidShows` (`id`, `clubId`, `paidBlockId`) VALUES
            (8, 487, 1),
            (10, 487, 2);
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('paidShows');
    }
}