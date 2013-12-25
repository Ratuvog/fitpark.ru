<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 12/25/13
 * Time: 2:58 PM
 */
class Migration_update_table_abonements_add_column_date extends CI_Migration {
    private $column = 'date';
    private $table = 'Abonements';
    public function up(){
        $column = array(
            $this->column => array(
                'type' => 'timestamp'
            )
        );
        $this->dbforge->add_column($this->table, $column);
    }
    public function down(){
        $this->dbforge->drop_column($this->table, $this->column);
    }
}
?>