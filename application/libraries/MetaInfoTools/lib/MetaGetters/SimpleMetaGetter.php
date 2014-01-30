<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/6/14
 * Time: 5:27 PM
 */

namespace MetaInfo\MetaGetter;
require_once "AbstractMetaGetter.php";

class SimpleMetaGetter extends AbstractMetaGetter{
    private $field;
    function __construct($method, $field)
    {
        parent::__construct($method);
        $this->field = $field;
    }

    function get($struct)
    {
        $controller = $this->searchController($struct);
        if ($controller == FALSE)
            return FALSE;

        if (isset($controller[$this->field][0]))
            return $controller[$this->field][0];

        return FALSE;
    }
}
