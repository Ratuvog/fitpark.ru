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
        if($state === 'all')
            return $this->db->get($this->table)->result();
        return $this->db->get_where($this->table, array('state'=>$this->states[$state]))->result();
    }
    
    
    function byId($club)
    {
        $result = $this->db->get_where('buf_club', array('id'=>$club))->row();
        if($result)
            $result->head_picture = ImageHelper::replace_path($result->head_picture, $this->config->item('empty_photo'));
        return $result;
    }
    
}
?>