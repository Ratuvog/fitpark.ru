<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_qa extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `QA`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `QA` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user` varchar(255) NOT NULL,
              `question` text NOT NULL,
              `answer` text NOT NULL,
              `expertid` int(11) NOT NULL DEFAULT '-1',
              `qathemeid` int(11) NOT NULL DEFAULT '-1',
              `email` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

        ");

        //Данные таблицы `QA`
        $this->db->query("
            INSERT INTO `QA` (`id`, `user`, `question`, `answer`, `expertid`, `qathemeid`, `email`) VALUES
            (1, 'Андрей', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Сколько лучше всего подходов делать для роста мышц?</span></span></p>\n', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Для наращивание мышечной массы рекомендуем делать 3-4 подхода.</span></span></p>\n', 1, 5, ''),
            (2, 'Саша', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Я много занимаюсь, но мои мышцы особо не растут. В чем может быть проблема?</span></span></p>\n', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Варианта два, либо неверное составлена программа тренировок (упражнения, кол-во подходов и повторений), либо неверное питание. Рост мышц происходит не только благодаря правильным тренировкам, но и за счет верного режима питания. Необходимо ежедневно потреблять минимум 2 грамма белка на килограмм Вашего веса.</span></span></p>\n', 1, 5, ''),
            (3, 'Ольга', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Очень хочу добиться красивого пресса. Каждый день его качаю, но результатов почти нет. Что мне делать?</span></span></p>\n', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Упражнения на пресс способствуют его усилению и улучшению рельефа мышц. Но это не приводит к снижению жировой прослойки именно в районе живота. Для того, чтобы у Вас был красиво смотрелся пресс, необходимо придерживаться диеты с минимальным количеством жиров и включить в тренировку кардиоупражнения. Например степпер или велотренажер.</span></span></p>\n', 1, 2, ''),
            (4, 'Сергей', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Чем питаться, если я хочу нарастить мышцы?</span></span></p>\n', '<p style=\"font-family:trebuc;font-size:12px;\">\n	<span style=\"font-size:14px;\"><span style=\"color: rgb(51, 51, 51); font-family: Helvetica, arial, freesans, clean, sans-serif; line-height: 22px; background-color: rgb(251, 251, 251);\">Для эффективного роста мышечной массы необходимо есть продукты с высоким содержанием белка - филе куриной грудки (именно грудки, бедра курицы очень жирные), белки яиц (в желтке много жиров), тунец (также подойдет другая рыба с высоким содержанием белка). Питаться необходимо вареными продуктами, жареные вредны. Также стоит использовать спортивное питание.</span></span></p>\n', 1, 3, ''),
            (5, 'Антон', 'Как избежать травм во время тренировок?', '', -1, -1, '0'),
            (6, 'Роза', 'Сколько времени нужно уделять тренировкам, если заниматься два раза в неделю?', '', -1, -1, '0');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('QA');
    }
}