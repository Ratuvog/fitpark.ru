<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 6/10/13
 * Time: 12:45 AM
 * To change this template use File | Settings | File Templates.
 *
 * ВНИМАНИЕ!
 * Данный хелпер перегружает встроенные функции, поэтому возможны косяки в работе
 */



function site_url($url = '') {
    return "http://".$_SERVER["HTTP_HOST"]."/".implode("/",$url);
}

function base_url() {
    return prep_url($_SERVER["HTTP_HOST"]);
}

?>
