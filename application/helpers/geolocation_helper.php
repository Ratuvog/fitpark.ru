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
    $geo = new Geo($currentSettings);
    return $geo->get_value('city');
}
?>