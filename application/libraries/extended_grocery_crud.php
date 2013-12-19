<?php

class extended_grocery_CRUD extends grocery_CRUD
{
    protected function set_default_Model()
    {
        $ci = &get_instance();
        $ci->load->model('extended_crud_Model');

        $this->basic_model = $ci->extended_crud_Model;
    }

    public function set_relation_n_n($field_name, $relation_table, $selection_table,
                                     $primary_key_alias_to_this_table, $primary_key_alias_to_selection_table,
                                     $title_field_selection_table,
                                     $priority_field_relation_table = null, $where_clause = null, $equal_pk_field = null)
    {
        $this->relation_n_n[$field_name] =
            (object)array(
                'field_name' => $field_name,
                'relation_table' => $relation_table,
                'selection_table' => $selection_table,
                'primary_key_alias_to_this_table' => $primary_key_alias_to_this_table,
                'primary_key_alias_to_selection_table' => $primary_key_alias_to_selection_table ,
                'title_field_selection_table' => $title_field_selection_table ,
                'priority_field_relation_table' => $priority_field_relation_table,
                'where_clause' => $where_clause,
                'equal_pk_field' => $equal_pk_field
            );

        return $this;
    }

    protected function get_relation_n_n_input($field_info_type, $selected_values)
    {
        $has_priority_field = !empty($field_info_type->extras->priority_field_relation_table) ? true : false;
        $is_ie_7 = isset($_SERVER['HTTP_USER_AGENT']) && (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 7') !== false) ? true : false;

        if($has_priority_field || $is_ie_7)
        {
            $this->set_css($this->default_css_path.'/ui/simple/'.grocery_CRUD::JQUERY_UI_CSS);
            $this->set_css($this->default_css_path.'/jquery_plugins/ui.multiselect.css');
            $this->set_js($this->default_javascript_path.'/jquery_plugins/ui/'.grocery_CRUD::JQUERY_UI_JS);
            $this->set_js($this->default_javascript_path.'/jquery_plugins/ui.multiselect.min.js');
            $this->set_js($this->default_javascript_path.'/jquery_plugins/config/jquery.multiselect.js');

            if($this->language !== 'english')
            {
                include($this->default_config_path.'/language_alias.php');
                if(array_key_exists($this->language, $language_alias))
                {
                    $i18n_date_js_file = $this->default_javascript_path.'/jquery_plugins/ui/i18n/multiselect/ui-multiselect-'.$language_alias[$this->language].'.js';
                    if(file_exists($i18n_date_js_file))
                    {
                        $this->set_js($i18n_date_js_file);
                    }
                }
            }
        }
        else
        {
            $this->set_css($this->default_css_path.'/jquery_plugins/chosen/chosen.css');
            $this->set_js($this->default_javascript_path.'/jquery_plugins/jquery.chosen.min.js');
            $this->set_js($this->default_javascript_path.'/jquery_plugins/ajax-chosen.js');
            $this->set_js($this->default_javascript_path.'/jquery_plugins/config/jquery.chosen.config.js');
        }

        $this->_inline_js("var ajax_relation_url = '".$this->getAjaxRelationUrl()."';\n");

        $field_info 		= $this->relation_n_n[$field_info_type->name]; //As we use this function the relation_n_n exists, so don't need to check
        $unselected_values 	= $this->get_relation_n_n_unselected_array($field_info, $selected_values, $this->getStateInfo()->primary_key);

        if(empty($unselected_values) && empty($selected_values))
        {
            $input = "Please add {$field_info_type->display_as} first";
        }
        else
        {
            $css_class = $has_priority_field || $is_ie_7 ? 'multiselect': 'chosen-multiple-select';
            $width_style = $has_priority_field || $is_ie_7 ? '' : 'width:510px;';

            $select_title = str_replace('{field_display_as}',$field_info_type->display_as,$this->l('set_relation_title'));
            $input = "<select id='field-{$field_info_type->name}' name='{$field_info_type->name}[]' multiple='multiple' size='8' class='$css_class' data-placeholder='$select_title' style='$width_style' >";

            if(!empty($unselected_values))
                foreach($unselected_values as $id => $name)
                {
                    $input .= "<option value='$id'>$name</option>";
                }

            if(!empty($selected_values))
                foreach($selected_values as $id => $name)
                {
                    $input .= "<option value='$id' selected='selected'>$name</option>";
                }

            $input .= "</select>";
        }

        return $input;
    }

    protected function get_relation_n_n_unselected_array($field_info, $selected_values, $primary_key_value)
    {
        return $this->basic_model->get_relation_n_n_unselected_array($field_info, $selected_values, $primary_key_value);
    }
}