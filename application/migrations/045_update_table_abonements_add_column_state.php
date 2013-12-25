<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12/25/13
 * Time: 8:01 PM
 */

class Migration_update_table_abonements_add_column_state extends CI_Migration
{
    private $table = 'Abonements';
    private $column = 'state';
    public function up()
    {
        $column = array(
            $this->column => array(
                'type' => 'TINYINT',
                'default' => 1
            )
        );
        $this->dbforge->add_column($this->table, $column);
    }

    public function down()
    {
        $this->dbforge->remove_column($this->table, $this->column);
    }
}