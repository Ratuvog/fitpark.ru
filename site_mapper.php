<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 7/7/13
 * Time: 9:56 PM
 * To change this template use File | Settings | File Templates.
 */
    include_once "./application/libraries/idna_convert.php";

    $siteMaps = array (
        "samara"     => "samara.txt",
        "togliatti"  => "togliatti.txt",
        "base"       => "base.txt"
    );
    $convert = new Idna_convert();
    $host = $convert->decode($_SERVER["HTTP_HOST"]);
    $hostArray = explode('.', $host);
    header("Content-Description: File Transfer\r\n");
    header("Pragma: public\r\n");
    header("Expires: 0\r\n");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0\r\n");
    header("Cache-Control: public\r\n");
    header("Content-Type: text/plain; charset=UTF-8\r\n");
    $currentSiteMap = "";
    if(count($hostArray) == 3) {
        $currentSiteMap = $siteMaps[$hostArray[0]];
    } else {
        $currentSiteMap = $siteMaps["base"];
    }
//    echo "$currentSiteMap";
    header("Content-Disposition: attachment; filename=\"robot.txt\"\r\n");
    echo file_get_contents("./site_maps/$currentSiteMap");
?>