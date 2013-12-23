<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_table_manager_add_column_comment extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'comment' => array(
                'type' => 'TEXT'
            )
        );
        $this->dbforge->add_column('manager', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('manager', 'comment');
    }
}