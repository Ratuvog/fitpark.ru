<?php
class Photo extends CI_Model {
    
    public $table = 'fitnesclub_photo';
    public $foreign_key = 'fitnesclubid';
  
    function updateFromBuffer($club)
    {
        $where = array($this->foreign_key => $club, 'state' => 1);
        $this->db->update($this->table, array('state' => 0), $where);
    }

    function all()
    {
        return $this->db->get($this->table)->result_array();
    }

    function update($data, $id)
    {
        return $this->db->update($this->table,$data,array('id'=>$id));
    }
    
    function byClub($club, $state = 0)
    {
        $where = array($this->foreign_key => $club, 'state' => $state);
        $result = $this->db->get_where($this->table, $where)->result();
        $this->after_get($result);
        return $result;
    }
    
    function setData($id, $field, $value)
    {
        $this->db->update($this->table, array($field => $value), array('id' => $id));
    }
    
    protected function after_get(&$result)
    {
        $ADDITIONAL = "_min";
        $i=0;
        foreach ($result as &$image)
        {
            $image->photo = "image/club/$image->photo";
            if(!$image->min_photo)
            {
                $config['image_library'] = 'gd2';
                $config['source_image'] = $image->photo;
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 300;
                $config['height'] = 150;
                $config['thumb_marker'] = $ADDITIONAL;
                if($this->image_lib->initialize($config) && $this->image_lib->resize())
                {
                    $fileParts = explode('.', $image->photo);
                    $extension = $fileParts[count($fileParts)-1];
                    array_pop($fileParts);
                    $fileName = implode('.', $fileParts);

                    $resultFileName = $fileName.$ADDITIONAL.'.'.$extension;
                    $this->photo->setData($image->id, 'min_photo', $resultFileName);
                    $image->min_photo = $resultFileName;
                    $this->image_lib->clear();
                }
                $i++;
            }
            $image->photo = site_url($image->photo);
            $image->min_photo = site_url($image->min_photo);
        }
    }
    
}
?>