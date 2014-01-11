<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/6/14
 * Time: 5:25 PM
 */
namespace MetaInfo\MetaGetter;

interface IMetaGetter
{
    const RootElement = "controllers";
    public function get($struct);
}

?>