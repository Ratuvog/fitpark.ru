<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_table_manager_add_column_activity extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'activity' => array(
                'type' => 'TINYINT',
                'default' => '0'
            )
        );
        $this->dbforge->add_column('manager', $fields);
    }

    public function down()
    {
        $this->dbforge->drop_column('manager', 'activity');
    }
}