<?php
class Club_model extends CI_Model {
    
    public $table = 'fitnesclub';
    public $rating = 'fitnesclub_rating';
    public $city = 'city';

    function __construct()
    {
        parent::__construct();
        $this->load->config("paidShows");
    }
    function prepare()
    {
        $this->db->select("$this->table.*, AVG($this->rating.value) as rating, $this->city.geo as city_geo")
                 ->from($this->table)
                 ->join("paidShows",  "$this->table.id = paidShows.clubId", "left")
                 ->join("$this->rating", "$this->table.id = $this->rating.clubId", "left")
                 ->join("$this->city", "$this->table.cityId = $this->city.id")
                 ->group_by("$this->table.id");
    }
    
    function after_get($set) 
    {
        foreach ($set as &$club)
            $club->head_picture = ImageHelper::replace_path($club->head_picture, $this->config->item('empty_photo'));
    }

    function after_get_row(&$row)
    {
        $row->head_picture = ImageHelper::replace_path($row->head_picture, $this->config->item('empty_photo'));
        $description = $this->db->get_where('fitnesclub_description', array('clubid'=>$row->id))->row();
        if($description)
        {
            $row->description = $description->text;
        }
    }
            
    function updateFromBuffer($bufData)
    {
        $cur = $this->db->get_where($this->table, array('id' => $bufData->id))->row();
        foreach($cur as $key => $value)
            $cur->$key = $bufData->$key;
        $this->db->update($this->table, $cur, array('id' => $cur->id));
    }
    
    function get_rand($limit, $city)
    {
        $this->prepare();
        $set = $this->db
                    ->where(array("$this->table.cityId"=>"$city->id" ))
                    ->where("(`paidShows`.`id` IS NULL OR `paidShows`.`paidBlockId` = '".$this->config->item("blockTitle")."')")
                    ->order_by('`paidShows`.`id` DESC, RAND()')
                    ->limit($limit)
                    ->get()->result();
        $this->after_get($set);
        return $set;
    }
    
    function byId($club)
    {
        $this->prepare();
        $row = $this->db->where(array("$this->table.id" => $club))->get()->row();
        $this->after_get_row($row);
        return $row;
    }
    
    function analogs($clubId) {
        $club = $this->db->get_where($this->table, array('id'=>$clubId))->row();
        $query = "SELECT f1.*
                FROM fitnesclub f2 , fitnesclub f1 LEFT JOIN paidShows ON
                paidShows.clubId = f1.id AND `paidShows`.`paidBlockId` = '".$this->config->item("blockAnalog")."'
                WHERE
                    f1.id != f2.id
                    AND (  ( (f1.sub3 > f2.sub3)  AND (f1.sub3 - f2.sub3) <=500)
                        OR ( (f1.sub3 <= f2.sub3) AND (f2.sub3 - f1.sub3) <=500)
                        )
                    AND
                      f1.cityid = $club->cityid
                    AND f2.id = ? ORDER BY paidShows.id DESC, RAND() LIMIT 0,4";
        
        $clubs = $this->db->query($query, array($clubId))->result();
        $indexes = array();
        foreach ($clubs as $item)
            $indexes []= $item->id;

        $analogs = array();
        if(count($indexes))
        {
            $this->prepare();
            $analogs = $this->db->where_in("$this->table.id", $indexes)->get()->result();
            $this->after_get($analogs);
        }
        return $analogs;
    }
    
    function addVote($clubId, $sender, $val)
    {
        $ok = array('status'=>'OK', 'msg'=>'Спасибо!');
        $err = array('status'=>'ERR', 'msg'=>'Вы уже оценивали этот клуб.');
        $servErr = array('status'=>'ERR', 'msg'=>'Извините, произошла ошибка на сервере.');
        
        $query = $this->db->select("*")
                 ->from($this->rating)
                 ->where(array('sender'=>$sender, 'clubId'=>$clubId))
                 ->get()->result_array();

        if(count($query) != 0)
            return json_encode($err);

        $data = array(
               'clubId' => $clubId,
               'sender' => $sender,
               'value'  => $val
            );
        $this->db->insert($this->rating, $data);
        return json_encode($ok);
    }
    
    function userVote($clubId, $sender)
    {
        $result = $this->db->from($this->rating)
                           ->where(array("clubId"=>$clubId, "sender"=>$sender))
                           ->get()->row();
        if(!$result)
            return 0;
        return $result->value;
    }
    
    function owner($club)
    {
        $info = $this->db->get_where($this->table, array('id' => $club))->row();
        if($info)
            return $info->managerId;
        return 0;
    }

    function byListDistrict($districtsList, $currentCity = 1)
    {
        $clubs = array();
        $this->db->select("id, name, address");
        $this->db->from($this->table);
        if(count($districtsList))
            $clubs = $this->db->where_in("districtId", $districtsList)->get()->result();
        else
            $clubs = $this->db->where(array("cityId" => $currentCity))->get()->result();

        return $clubs;
    }

}
?>
