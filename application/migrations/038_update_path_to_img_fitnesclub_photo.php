<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_update_path_to_img_fitnesclub_photo extends CI_Migration
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("photo");
    }

    public function up()
    {
        $photos = $this->photo->all();
        define("START_PATH", preg_quote("club/",'/'));
        $this->db->trans_start();
        foreach ($photos as $value)
        {
            if(preg_match('/^'.START_PATH.'/', $value['photo']))
            {
                $value['photo'] = substr($value['photo'],strlen(START_PATH));
            }

            $newValue = array();
            foreach ($value as $k=>$v)
            {
                if ($k == 'id')
                    continue;

                $newValue[$k] = $v;
            }

            $this->photo->update($newValue, $value['id']);
        }
        $this->db->trans_complete();
    }

    public function down()
    {
        $photos = $this->photo->all();
        define("START_PATH", preg_quote("club/",'/'));
        $this->db->trans_start();
        foreach ($photos as $value)
        {
            if(!preg_match('/^'.START_PATH.'/', $value['photo']))
            {
                $value['photo'] = START_PATH.$value['photo'];
            }

            $newValue = array();
            foreach ($value as $k=>$v)
            {
                if ($k == 'id')
                    continue;

                $newValue[$k] = $v;
            }

            $this->photo->update($newValue, $value['id']);
        }
        $this->db->trans_complete();
    }
}