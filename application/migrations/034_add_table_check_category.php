<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_check_category extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `type_checkout`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `type_checkout` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
        ");

        $this->db->query("
            INSERT INTO `type_checkout` (`id`, `name`) VALUES
                (1, 'Получение скидки 5%'),
                (2, 'Гостевое посещение');
        ");
    }

    public function down()
    {
        // Для быстрого удаления
        // Сначала очищаем таблицу
        $this->db->query("TRUNCATE TABLE `type_checkout`");
        // Потом удаляем
        $this->db->query("DROP TABLE IF EXISTS `type_checkout`");
    }
}