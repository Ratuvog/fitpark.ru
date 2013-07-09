<?php
class Counters extends CI_Model {
    
    function get($tables)
    {
        $result = new stdClass();
        foreach ($tables as $table)
        {
            if($this->db->table_exists($table))
                $result->$table = $this->db->count_all($table);
        }
        return $result;
    }
}
?>