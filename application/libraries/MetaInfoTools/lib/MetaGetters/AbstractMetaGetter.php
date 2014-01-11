<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/11/14
 * Time: 6:34 PM
 */

namespace MetaInfo\MetaGetter;
require_once "IMetaGetter.php";

abstract class AbstractMetaGetter implements IMetaGetter{
    private $className;

    function __construct($className)
    {
        $this->className = $className;
    }

    protected function searchController($struct)
    {
        $controller = FALSE;
        if(!isset($struct[self::RootElement]))
            return FALSE;

        foreach ($struct[self::RootElement] as $key=>$value) {
            if($key == $this->className && isset($value[0]))
            {
                $controller = $value[0];
                break;
            }
        }

        return $controller;
    }
} 