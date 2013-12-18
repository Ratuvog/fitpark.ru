<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_services extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `fitnesclub_services`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `fitnesclub_services` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `filterid` int(11) NOT NULL,
              `class` varchar(255) NOT NULL,
              `name` varchar(255) DEFAULT NULL,
              `value` varchar(255) DEFAULT NULL,
              `type` int(11) DEFAULT NULL,
              `description` text,
              `icon` varchar(255) NOT NULL,
              `other_form` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;
        ");

        //Данные таблицы `fitnesclub_services`
        $this->db->query("
            INSERT INTO `fitnesclub_services` (`id`, `filterid`, `class`, `name`, `value`, `type`, `description`, `icon`, `other_form`) VALUES
                (1, 1, 'services-pool', 'Бассейн', NULL, NULL, NULL, 'бассейн.png', 'Бассейн'),
                (2, 1, 'services-bicycle', 'Функциональный тренинг', NULL, NULL, NULL, 'функциональный тренинг.png', 'Функциональный тренинг'),
                (3, 1, 'services-yoga', 'Йога', NULL, NULL, NULL, 'йога.png', 'Йога'),
                (8, 1, '', 'Танцы', NULL, NULL, NULL, 'танцы.png', 'Танцы'),
                (10, 1, '', 'Женские программы', NULL, NULL, NULL, 'женские программы.png', 'Женские программы'),
                (11, 1, '', 'Кардио-зал', NULL, NULL, NULL, 'кардио зал.png', 'Кардио-зал'),
                (12, 1, '', 'Сауна', NULL, NULL, NULL, 'сауна.png', 'Сауна'),
                (13, 1, '', 'Солярий', NULL, NULL, NULL, 'солярий.png', 'Солярий'),
                (14, 1, '', 'Массаж', NULL, NULL, NULL, 'массаж.png', 'Массаж'),
                (15, 1, '', 'Спа', NULL, NULL, NULL, 'спа.png', 'Спа-процедуры'),
                (16, 1, '', 'Детский фитнес', NULL, NULL, NULL, 'детский.png', 'Детский фитнес'),
                (17, 1, '', 'Мужские программы', NULL, NULL, NULL, 'мужские программы.png', 'Мужские программы'),
                (19, 1, '', 'Фитнес - бар', NULL, NULL, NULL, 'фитнес-бар.png', 'Фитнес-бар'),
                (20, 1, '', 'Спортивный врач', NULL, NULL, NULL, 'врач.png', 'Спортивный врач'),
                (21, 1, '', 'Персональные тренировки', NULL, NULL, NULL, 'тренер.png', 'Персональный тренер');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('fitnesclub_services');
    }
}