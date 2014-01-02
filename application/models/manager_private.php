<?php
require_once APPPATH."/libraries/extended_image_crud.php";
class Manager_private extends CI_Model {
    
    function cities()
    {
        return $this->db->get("city")->result();
    }
    
    function districts($city)
    {
        return $this->db->get_where("district", array('cityId'=>$city))->result();
    }
    
    
    /**
     * Получение информации о клубе из таблицы-буффера
     * Состояния записи в буффере:
     * 
     * 0 - нейтральное состояние(по-умолчанию). Просто создана копия клуба,
     *     без запроса об изменении основной записи в fitnesclub.
     * 
     * 1 - запрос "сохранить". Т.е. запрос на изменение текущей
     *     записи о клубе, той, что лежит в буффере.
     * 
     * 2 - изменения одобрены, в fitnesclub соотв. запись была обновлена.
     * 
     * 3 - изменения отклонены.
     * 
     */
    function club($club)
    {
        $buf = $this->db->get_where("buf_club", array('id'=>$club))->first_row();
        if(!$buf)
        {
            $fClub = $this->db->get_where("fitnesclub", array('id'=>$club))->result_array();
            if(count($fClub))
                $this->db->insert("buf_club", $fClub[0]);
            $buf = $this->db->get_where("buf_club", array('id'=>$club))->first_row();
        }

        $buf->head_picture = site_url(array('image', 'club', $buf->head_picture));
        return $buf;
    }
    
    function clubs($manager)
    {
        $emptyRecord = $this->db->select("fitnesclub.id as id")
                                ->from('fitnesclub')
                                ->join('buf_club', 'fitnesclub.id = buf_club.id', 'left')
                                ->where(array('fitnesclub.managerId' => 1,'buf_club.id' => NULL))
                                ->get()->result();
        foreach($emptyRecord as $row)
        {
            $fClub = $this->db->get_where("fitnesclub", array('id'=>$row->id))->row_array();
            if($fClub)
                $this->db->insert("buf_club", $fClub); 
        }
        
        return $this->db->get_where("buf_club", array('managerId' => $manager))->result();
    }
    
    function owner($club)
    {
        $info = $this->db->get_where('fitnesclub', array('id' => $club))->result_array();
        if(count($info))
            return $info[0]['managerId'];
        return 0;
    }
     
    function updateCommon($data, $club)
    {
        $data['state'] = 1;
        if($this->db->update('buf_club', $data, array('id' => $club)))
            return 'OK';
        return 'ERR';
    }

    function manager($login)
    {
        return $this->db->get_where("manager", array("login"=>$login))->row();
    }

    function updateServices($data, $club)
    {
        if(!$this->db->delete('buf_club_services', array('clubId'=>$club)))
            return "ERR";
        
        foreach(array_keys($data) as $key)
        {
            if($data[$key] === "true")
            {
                $insertSet = array('clubId' => $club, 'serviceId' => $key);
                if(!$this->db->insert('buf_club_services', $insertSet))
                    return "ERR";
            }
        }

        $this->updateCommon(array(),$club);
        return "OK";
    }
    
    function lastTimeUpdate($club)
    {
        $rec = $this->db->get_where('buf_club', array('id' => $club))->row();
        if($rec)
            return array('status' => 'OK', 'msg' => $rec->last_update);
        return array('status' => 'ERR');
    }
    
    function services($clubId)
    {
        $buf = $this->db->get_where('buf_club_services', array('clubId'=>$clubId))->result();
        $table = 'buf_club_services';
        if(!count($buf))
            $table = 'fitnesclub_rel_services';

        return $this->db->select('fs.*, bcs.serviceId as active')
                        ->from('fitnesclub_services fs')
                        ->join("$table bcs", "fs.id = bcs.serviceId and bcs.clubId=$clubId",'left')
                        ->get()->result();
    }

    function updateHeadImage($clubId, $picture) {
        $data = array(
            "state" => 1,
            "head_picture" => $picture
        );
        $this->db->update("buf_club", $data, array("id"=>$clubId));
    }

    /**
     * Возвращает объект фотографий конкретного клуба
     * @return image_CRUD объект.
     * @param $url устанавливает относительный
     * url, по-которому контроллер обрабатывает запросы
     */
    function getPhotosObject($url) {
        $image_crud = new extended_image_CRUD();

        $image_crud->set_table("fitnesclub_photo");
        $image_crud->set_primary_key_field('id');
        $image_crud->set_url_field('photo');
        $image_crud->set_thumbnail_prefix("");
        $image_crud->set_image_path('image/club');
        $image_crud->set_relation_field('fitnesclubid');
        $image_crud->set_delete_url($url.'/delete_file');
        $image_crud->set_upload_url($url.'/upload_file');
        return $image_crud;
    }

    function deleteImage($id) {
        $this->db->delete("fitnesclub_photo", "id = $id");
    }

    function insertImage($nameImage, $clubId) {
        $this->db->insert("fitnesclub_photo", array(
            "photo"       => $nameImage,
            "fitnesclubid"=> $clubId,
            "state"       => 1
        ));
    }
}
?>