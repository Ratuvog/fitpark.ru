<?php
require_once __DIR__."/../libraries/image_crud.php";
class extended_image_CRUD extends image_CRUD
{
    protected $delete_url = null;

    protected function _get_delete_url($image_id)
    {
        if (!$this->delete_url)
            return parent::_get_delete_url($image_id);


        return $this->delete_url.'/'.$image_id;
    }

    public function set_delete_url($delete_url)
    {
        $this->delete_url = $delete_url;
    }
}