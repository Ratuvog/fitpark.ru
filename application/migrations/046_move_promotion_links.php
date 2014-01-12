<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/12/14
 * Time: 12:15 PM
 */

class Migration_Move_promotion_links extends CI_Migration{
    public function up()
    {
        $this->db->trans_start();
        $this->restruct_cities_advertisement();
        $query = $this->db->get('city');
        $result = array();
        foreach ($query->result() as $row) {
            $promotion = $row->promotion;
            $struct = json_decode($promotion);
            foreach ($struct as $col) {
                foreach ($col as $item) {
                    $result[] = array(
                        'cityId' => $row->id,
                        'link'   => $item->url,
                        'name'   => $item->name
                    );
                }

            }
        }

        $this->db->insert_batch('cities_advertisement', $result);
        $this->db->remove_column('city', 'promotion');
        $this->db->trans_complete();
    }

    private function restruct_cities_advertisement()
    {
        $this->dbforge->drop_table("cities_advertisement");
        $this->db->query("
          CREATE TABLE IF NOT EXISTS `cities_advertisement` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `cityId` int(11) NOT NULL,
              `link` varchar(255) NOT NULL,
              `name` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9;
        ");
    }

    public function down()
    {

    }
} 