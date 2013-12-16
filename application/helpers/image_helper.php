<?php
class ImageHelper {

    static function replace_path($picture_path, $empty_value)
    {
        if(empty($picture_path))
            $picture_path = site_url(array("image",  $empty_value));
        else
            $picture_path = site_url(array("image", "club", $picture_path));
        return $picture_path;
    }
}
?>
