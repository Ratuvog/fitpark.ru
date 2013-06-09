<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dmitry
 * Date: 09.06.13
 * Time: 9:58
 * To change this template use File | Settings | File Templates.
 */

/**
 * Получает имя города по ip-адресу
 * @param $ipAddress ip-адрес пользователя
 */
function getCityFromIp($ipAddress) {
    $currentSettings = array();
    $currentSettings['charset'] = 'utf-8';
    $currentSettings['ip']      = $ipAddress;
    $CI = &get_instance();
    $CI->load->add_package_path(APPPATH.'library/geo/');
    $CI->load->library("geo", $currentSettings);
    @$city = $CI->geo->get_value('city');
    if(!$city)
        $city = "Самара";
    return $city;
}
?>