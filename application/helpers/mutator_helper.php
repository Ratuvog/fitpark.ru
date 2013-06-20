<?php
/*
 * Замена пустых значений в поле $field
 * на заданое значение $mutator_value
 */
function mutator_clubs_null_field(&$clubs, $field, $mutator_value)
{
    foreach ($clubs as &$club)
    {
        foreach ($club as $key=>$value)
        {
            if($key == $field)
            {
                if(!$club[$key])
                    $club[$key] = site_url(array("image",  $mutator_value));
                else
                    $club[$key] = site_url(array("image", "club", $club[$key]));
            }
        }
    }
    return $clubs; 
}
?>
