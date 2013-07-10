<?php
class Buffer_club extends CI_Model {
    
    public $table = 'buf_club';
    
    private $states = array(
        'void' => 0,
        'active' => 1,
        'aprove' => 2,
        'reject' => 3
    );
    
    function states()
    {
        return array(
          0 => array('desc' => 'Изменений нет', 'class' => ''),
          1 => array('desc' => 'На проверке', 'class' => 'info'),
          2 => array('desc' => 'Изменения одобрены', 'class' => 'success'),
          3 => array('desc' => 'Изменения отклонены', 'class' => 'error')
        );
    }

    function get($state = 'all')
    {
        $this->db->select("*")->
                   from($this->table)->
                   order_by('last_update', 'desc');
   
        if($state === 'all')
            return $this->db->get()->result();

        return $this->db->where(array('state'=>$this->states[$state]))->get()->result();
    }
    
    
    function byId($club, $replacePhoto = true)
    {
        $result = $this->db->get_where('buf_club', array('id'=>$club))->row();
        if($result && $replacePhoto)
            $result->head_picture = ImageHelper::replace_path($result->head_picture, $this->config->item('empty_photo'));
        return $result;
    }
    
    function setData($id, $data)
    {
        $this->db->update($this->table, $data, array('id' => $id));
    }
    
}
?>