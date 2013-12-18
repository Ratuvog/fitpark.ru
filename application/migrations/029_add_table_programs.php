<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_programs extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `programs`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `programs` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `where_to_train` int(11) NOT NULL,
              `target` int(11) NOT NULL,
              `experience` int(11) NOT NULL,
              `periodicity` int(11) NOT NULL,
              `gender` int(11) NOT NULL,
              `years` int(11) NOT NULL,
              `weight` int(11) NOT NULL,
              `height` int(11) NOT NULL,
              `comments` varchar(255) NOT NULL,
              `email` varchar(255) NOT NULL,
              `paymented` int(11) NOT NULL DEFAULT '0',
              `executed` int(11) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;
        ");

        //Данные таблицы `programs`
        $this->db->query("
            INSERT INTO `programs` (`id`, `where_to_train`, `target`, `experience`, `periodicity`, `gender`, `years`, `weight`, `height`, `comments`, `email`, `paymented`, `executed`) VALUES
            (43, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (44, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (45, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (46, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (47, 0, 0, 0, 0, 0, 0, 0, 0, '', 'gggg@ggg.com', 0, 0),
            (48, 0, 0, 0, 0, 0, 0, 0, 0, '', 'gggg@ggg.com', 0, 0),
            (49, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (50, 0, 1, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (51, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (52, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0),
            (53, 0, 0, 1, 1, 1, 0, 3, 1, '', '', 0, 0),
            (54, 0, 0, 1, 2, 0, 0, 1, 0, '', '', 0, 0),
            (55, 0, 0, 0, 0, 1, 0, 1, 1, '', '', 0, 0),
            (56, 1, 2, 1, 5, 1, 0, 0, 1, '', 'enetia@mail.ru', 0, 0),
            (57, 1, 2, 1, 5, 1, 0, 0, 1, '', '', 0, 0),
            (58, 0, 1, 1, 2, 0, 1, 4, 1, '', '', 0, 0),
            (59, 0, 4, 1, 1, 0, 2, 6, 3, '', '', 0, 0);
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `programs`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `programs`");
    }
}