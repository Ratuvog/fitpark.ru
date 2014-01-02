<?php
require_once __DIR__."/../libraries/image_crud.php";
class extended_image_CRUD extends image_CRUD
{
    protected $delete_url = null;
    protected $upload_url = null;

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

    public function set_upload_url($upload_url)
    {
        $this->upload_url = $upload_url;
    }

    protected function getState()
    {
        $rsegments_array = $this->ci->uri->rsegment_array();

        if(isset($rsegments_array[3]) && is_numeric($rsegments_array[3]))
        {
            $upload_url = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/upload_file/'.$rsegments_array[3]);
            $ajax_list_url  = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/'.$rsegments_array[3].'/ajax_list');
            $ordering_url  = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/ordering');
            $insert_title_url  = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/insert_title');

            $state = array( 'name' => 'list', 'upload_url' => $upload_url, 'relation_value' => $rsegments_array[3]);
            $state['ajax'] = isset($rsegments_array[4]) && $rsegments_array[4] == 'ajax_list'  ? true : false;
            $state['ajax_list_url'] = $ajax_list_url;
            $state['ordering_url'] = $ordering_url;
            $state['insert_title_url'] = $insert_title_url;

            if($this->upload_url)
                $state['upload_url'] = $this->upload_url;
            return (object)$state;
        }
        elseif( (empty($rsegments_array[3]) && empty($this->relation_field)) || (!empty($rsegments_array[3]) &&  $rsegments_array[3] == 'ajax_list'))
        {
            $upload_url = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/upload_file');
            $ajax_list_url  = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/ajax_list');
            $ordering_url  = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/ordering');
            $insert_title_url  = site_url($rsegments_array[1].'/'.$rsegments_array[2].'/insert_title');

            $state = array( 'name' => 'list', 'upload_url' => $upload_url);
            $state['ajax'] = isset($rsegments_array[3]) && $rsegments_array[3] == 'ajax_list'  ? true : false;
            $state['ajax_list_url'] = $ajax_list_url;
            $state['ordering_url'] = $ordering_url;
            $state['insert_title_url'] = $insert_title_url;

            if($this->upload_url)
                $state['upload_url'] = $this->upload_url;

            return (object)$state;
        }
        elseif(isset($rsegments_array[3]) && $rsegments_array[3] == 'upload_file')
        {
            #region Just rename my file
            $new_file_name = '';
            //$old_file_name = $this->_to_greeklish($_GET['qqfile']);
            $old_file_name = $this->_convert_foreign_characters($_GET['qqfile']);
            $max = strlen($old_file_name);
            for($i=0; $i< $max;$i++)
            {
                $numMatches = preg_match('/^[A-Za-z0-9.-_]+$/', $old_file_name[$i], $matches);
                if($numMatches >0)
                {
                    $new_file_name .= strtolower($old_file_name[$i]);
                }
                else
                {
                    $new_file_name .= '-';
                }
            }
            $file_name = substr( substr( uniqid(), 9,13).'-'.$new_file_name , 0, 100) ;
            #endregion

            $results = array( 'name' => 'upload_file', 'file_name' => $file_name);
            if(isset($rsegments_array[4]) && is_numeric($rsegments_array[4]))
            {
                $results['relation_value'] = $rsegments_array[4];
            }
            return (object)$results;
        }
        elseif(isset($rsegments_array[3]) && isset($rsegments_array[4]) && $rsegments_array[3] == 'delete_file' && is_numeric($rsegments_array[4]))
        {
            $state = array( 'name' => 'delete_file', 'id' => $rsegments_array[4]);
            return (object)$state;
        }
        elseif(isset($rsegments_array[3]) && $rsegments_array[3] == 'ordering')
        {
            $state = array( 'name' => 'ordering');
            return (object)$state;
        }
        elseif(isset($rsegments_array[3]) && $rsegments_array[3] == 'insert_title')
        {
            $state = array( 'name' => 'insert_title');
            return (object)$state;
        }
    }
}