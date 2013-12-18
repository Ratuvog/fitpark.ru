<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_abonements extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `Abonements`
        $this->db->query("
          CREATE TABLE IF NOT EXISTS `Abonements` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `surname` varchar(255) NOT NULL,
              `tel` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `date` varchar(255) NOT NULL,
              `clubid` int(11) NOT NULL,
              PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;
        ");

        // Дамп данных таблицы `roles`
        $this->db->query("
          INSERT INTO `Abonements` (`id`, `name`, `surname`, `tel`, `email`, `date`, `clubid`) VALUES
                (1, 'Лариса', 'Першина', 'Першина', 'pershina1502@mail.ru', '12 месяцев', 124),
                (2, 'Александра', 'Краснова', '89879750205', 'apostol-XIII@yandex.ru', '12 месяцев', 239),
                (3, 'Александра', 'Краснова', '89879750205', 'apostol-XIII@yandex.ru', '12 месяцев', 239),
                (6, 'Юлия', 'Пихтовникова', '79649662226', 'mail@mail.ru', '1 месяц', 184),
                (8, 'юлия', 'белькова', '9371817070', 'yuliya-belkova@mail.ru', '1 месяц', 173);
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('Abonements');
    }
}