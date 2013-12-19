<?php
class extended_crud_Model  extends grocery_CRUD_Model  {

    function get_relation_n_n_unselected_array($field_info, $selected_values, $primary_key_value)
    {
        $use_where_clause = !empty($field_info->where_clause);

        $select = "";
        $related_field_title = $field_info->title_field_selection_table;
        $use_template = strpos($related_field_title,'{') !== false;
        $field_name_hash = $this->_unique_field_name($related_field_title);

        if($use_template)
        {
            $related_field_title = str_replace(" ", "&nbsp;", $related_field_title);
            $select .= "CONCAT('".str_replace(array('{','}'),array("',COALESCE(",", ''),'"),str_replace("'","\\'",$related_field_title))."') as $field_name_hash";
        }
        else
        {
            $select .= "$related_field_title as $field_name_hash";
        }
        $this->db->select('*, '.$select,false);

        if($use_where_clause){
            $this->db->where($field_info->where_clause);
        }

        if($field_info->equal_pk_field)
            $this->db->where(array($field_info->equal_pk_field => $primary_key_value));

        $selection_primary_key = $this->get_primary_key($field_info->selection_table);
        if(!$use_template)
            $this->db->order_by("{$field_info->selection_table}.{$field_info->title_field_selection_table}");
        $results = $this->db->get($field_info->selection_table)->result();

        $results_array = array();
        foreach($results as $row)
        {
            if(!isset($selected_values[$row->$selection_primary_key]))
                $results_array[$row->$selection_primary_key] = $row->{$field_name_hash};
        }

        return $results_array;
    }

}