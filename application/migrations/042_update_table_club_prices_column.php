<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_table_club_prices_column extends CI_Migration
{
    public function up()
    {
        $fields = array(
            'singlePrice' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'sub1' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'sub3' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'sub6' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
            'sub12' => array(
                'type' => 'INT',
                'constraint' => '11'
            ),
        );
        $this->dbforge->modify_column('fitnesclub', $fields);
    }

    public function down()
    {
        $fields = array(
            'singlePrice' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'sub1' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'sub3' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'sub6' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
            'sub12' => array(
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ),
        );
        $this->dbforge->modify_column('fitnesclub', $fields);
    }
}