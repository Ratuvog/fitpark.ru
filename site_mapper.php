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
        "самара"     => "Samara.xml",
        "тольятти"  => "Togliatti.xml",
        "челны"     => "Chelny.xml",
        "казань"      => "Kazan.xml",
        "уфа"        => "Ufa.xml",
        "нижний" => "Nizhnijnovgorod.xml",
        "base"       => "Samara.xml"
    );
    $convert = new Idna_convert();
    $host = $convert->decode($_SERVER["HTTP_HOST"]);
    $hostArray = explode('.', $host);
    $currentSiteMap = "";
    if(count($hostArray) == 3 && isset($siteMaps[$hostArray[0]])) {
        $currentSiteMap = $siteMaps[$hostArray[0]];
    } else {
        $currentSiteMap = $siteMaps["base"];
    }
//    echo "$currentSiteMap";
    // header("Content-Disposition: attachment; filename=\"sitemap.xml\"\r\n");
    echo file_get_contents("./site_maps/$currentSiteMap");
?>