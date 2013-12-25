<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_modify_column_date_to_duration_in_abonements extends CI_Migration
{
    private $newColumnName =  'duration';
    private $oldColumnName = 'date';
    private $table = 'Abonements';
    public function up()
    {
        // NOTE: В общем dbforge не справился с переменованием столбца. Вылетал с ошибкой
        $this->db->query("ALTER TABLE $this->table CHANGE $this->oldColumnName $this->newColumnName VARCHAR(255);");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE $this->table CHANGE $this->newColumnName $this->oldColumnName VARCHAR(255);");
    }
}