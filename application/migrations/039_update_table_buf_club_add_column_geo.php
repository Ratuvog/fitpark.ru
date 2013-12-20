<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_table_buf_club_add_column_geo extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'geo' => array(
                'type' => 'VARCHAR',
                'constraint' => '255'
            )
        );
        $this->dbforge->add_column('buf_club', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('buf_club', 'geo');
    }
}