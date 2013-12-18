<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_order_list extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `order_list`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `order_list` (
              `orderId` int(11) NOT NULL,
              `clubId` int(11) NOT NULL,
              `priority` int(11) NOT NULL DEFAULT '999999999'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        ");

        $this->load->helper('file');
        //Данные таблицы `order_list`
        if (file_exists("application/migrations/order_list_data_migration_026.query"))
            $this->db->query(read_file("application/migrations/order_list_data_migration_026.query"));
    }

    public function down()
    {
        $this->dbforge->drop_table('order_list');
    }
}