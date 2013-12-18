<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_guest extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `guest`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `guest` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `tel` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `date` date NOT NULL,
              `clubid` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
        ");

        //Данные таблицы `guest`
        $this->db->query("
            INSERT INTO `guest` (`id`, `tel`, `email`, `date`, `clubid`, `name`) VALUES
            (1, '79999999999', 'sdfgsd@test.ru', '2005-05-20', 111, 'тест'),
            (2, '8 960 396 29 88', 'gizza94@mail.ru', '0000-00-00', 457, 'Алсу'),
            (3, '89373639090', 'axrinat@mail.ru', '2030-09-20', 433, 'Ринат'),
            (4, '89373639091', 'albisha-sever84@mail.ru', '2001-10-20', 433, 'Альбина'),
            (5, '89373639090', 'axrinat@mail.ru', '2003-10-20', 435, 'Ринат'),
            (6, '89373639091', 'albisha-sever84@mail.ru', '2008-10-20', 437, 'Альбина');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('guest');
    }
}