<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_table_cities_advertisement extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'city_id' => array(
                'type' => 'INT',
                'constraint' => '11',
            ),
            'club_id' => array(
                'type' =>'INT',
                'constraint' => '11',
            ),
            'priority' => array(
                'type' => 'INT',
                'constraint' => '11',
                'default' => '999999'
            ),
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->create_table('cities_advertisement');
    }

    public function down()
    {
        $this->dbforge->drop_table('cities_advertisement');
    }
}