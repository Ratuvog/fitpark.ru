<?php
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
    
    function manager($login)
    {
        return $this->db->get_where('manager', array('login'=>$login))->first_row();
    }
    
    function updateCommon($data, $club)
    {
        $data['state'] = 1;
        if($this->db->update('buf_club', $data, array('id' => $club)))
            return 'OK';
        return 'ERR';
    }
    
    function updateServices($data, $club)
    {
        $data['state'] = 1;
        if($this->db->insert('buf_club', $data, array('id' => $club)))
            return 'OK';
        return 'ERR';
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
        if(!count($buf))
        {
            $origin = $this->db->get_where('fitnesclub_rel_services', array('clubId'=>$clubId))->result();
            foreach ($origin as $rec)
                $this->db->insert('buf_club_services', $rec);
        }
        return $this->db->select('fs.*, bcs.serviceId as active')
                        ->from('fitnesclub_services fs')
                        ->join('buf_club_services bcs', 'fs.id = bcs.serviceId','left')
                        ->where(array('bcs.clubId' => $clubId))
                        ->or_where(array('bcs.clubId' => NULL))
                        ->get()->result();
        
    }
}
?>