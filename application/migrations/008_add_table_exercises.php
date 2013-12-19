<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_exercises extends CI_Migration
{
    public function up()
    {
        //Структура таблицы `exercises`
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `exercises` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(1024) CHARACTER SET utf8 NOT NULL,
              `image` varchar(255) NOT NULL,
              `typeId` int(11) NOT NULL,
              `description` text CHARACTER SET utf8 NOT NULL,
              `video` varchar(255) CHARACTER SET utf8 NOT NULL,
              `technique` text CHARACTER SET utf8 NOT NULL,
              `nuances` text CHARACTER SET utf8 NOT NULL,
              `image1` varchar(512) NOT NULL,
              `image2` varchar(512) NOT NULL,
              `image3` varchar(512) NOT NULL,
              `image4` varchar(512) NOT NULL,
              `image5` varchar(512) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;
        ");

        $this->load->helper('file');
        // Добавление данных в таблицу 'exercises'
        if (file_exists("application/migrations/exercise_data_migration_008.query"))
            $this->db->query(read_file("application/migrations/exercise_data_migration_008.query"));
    }

    public function down()
    {
        $this->dbforge->drop_table('exercises');
    }
}