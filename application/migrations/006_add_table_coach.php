<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_coach extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `coach`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `coach` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) CHARACTER SET utf8 NOT NULL,
              `description` text CHARACTER SET utf8 NOT NULL,
              `avatar` varchar(255) CHARACTER SET utf8 NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
        ");
        
        // Добавление данных в таблицу 'coach'
        $this->db->query("
            INSERT INTO `coach` (`id`, `name`, `description`, `avatar`) VALUES
            (1, 'Елена Сергеева', '<p>\r\nМногократная чемпионка Поволжского федерального округа. <br>\r\nНеоднократная чемпионка Европы (2004 и 2005). <br>\r\nЧемпионка мира по фитнесу (2003) <br>\r\nНеоднократная чемпионка России (в т.ч. в 2013 году). <br>\r\nОпыт работы фитнес-тренером свыше 13 лет.\r\n </p>', 'trainer.jpg');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('coach');
    }
}