<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_question extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `question`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `question` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `question` text NOT NULL,
              `clubid` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;
        ");

        //Данные таблицы `question`
        $this->db->query("
            INSERT INTO `question` (`id`, `name`, `email`, `question`, `clubid`) VALUES
            (1, 'Светлана', 'zcg2002@mail.ru', 'Добрый день? Пожалуйста скажите,что вы можете посоветовать для занятий моей дочери 13 лет? и сколько будет стоить?Заранее спасибо!', 98),
            (4, 'Маурчев Андрей Евгеньевич', '89033139854@mail.ru', 'какие скидки действуют в данный период на Мусина? ', 261),
            (5, 'Ангелина', 'shushina.angelina@yandex.ru', 'Мне 14 и мне надо похудеть,особенно в ногах.Если я приду к вам допустим на месяц результаты будут??', 461),
            (6, 'Оксана', 'job.hands@yandex.ru', 'Добрый день! Уточните, пожалуйста, акция на абонемент за 5900 р.: на какой срок  выдается абонемент? есть ли рассрочки на абонементы?когда будет открытие в авроре?', 127),
            (7, 'Светлана', 'lanochka779810@mail.ru', 'сколько будет стоить две клубных карты на пол года... и можно ли посещать клуб с ребёнком три года?', 87),
            (8, 'Екатерина', 'murkissj@yandex.ru', 'здравствуйте! подскажите сколько стоит месяц занятий', 173),
            (9, 'Алина М.', 'allmazda@mail.ru', 'стоимость базовой карты на 6 , 9 и 12 месяцев.\nСпасибо)', 437);
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('question');
    }
}