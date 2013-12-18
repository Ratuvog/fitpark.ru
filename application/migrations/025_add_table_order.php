<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_order extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `orders`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `orders` (
              `id` int(11) NOT NULL DEFAULT '1',
              `name` varchar(255) NOT NULL,
              `active` tinyint(1) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");

        //Данные таблицы `orders`
        $this->db->query("
            INSERT INTO `orders` (`id`, `name`, `active`) VALUES
            (1, 'VNIMANIE! ETA ZAPIS DOLJNA BIT'' EDINSTVENNOI!!!!!!', 1);
        ");
    }

    public function down()
    {
        $this->dbforge->drop_table('orders');
    }
}