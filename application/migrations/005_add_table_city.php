<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_city extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `city`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `city` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              `english_name` varchar(255) NOT NULL,
              `url` varchar(255) NOT NULL,
              `geo` varchar(255) NOT NULL,
              `full_name` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7;
        ");
        
        // Добавление данных в таблицу 'city'
        $this->db->query("
        INSERT INTO `city` (`id`, `name`, `english_name`, `url`, `geo`, `full_name`) VALUES
          (1,'Самара','Samara','самара.фитпарк.рф',' ','Самара'),
          (2, 'Тольятти', 'Togliatti', 'тольятти.фитпарк.рф',' ','Тольятти'),
          (3, 'Казань', 'Kazan', 'казань.фитпарк.рф',' ', 'Казань'),
          (4, 'Челны', 'Chelny', 'челны.фитпарк.рф', ' ', 'Набережные Челны'),
          (5, 'Нижний', 'nizhnijnovgorod', 'нижний.фитпарк.рф',' ', 'Нижний Новгород'),
          (6, 'Уфа', 'ufa', 'уфа.фитпарк.рф',' ','Уфа');
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('city');
    }
}