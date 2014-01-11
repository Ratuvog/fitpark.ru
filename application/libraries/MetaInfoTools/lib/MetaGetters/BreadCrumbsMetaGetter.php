<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/11/14
 * Time: 6:30 PM
 */
namespace MetaInfo\MetaGetter;
require_once "AbstractMetaGetter.php";

class BreadCrumbsMetaGetter extends AbstractMetaGetter{
    private $className;
    function __construct($className)
    {
        parent::__construct($className);
    }

    public function get($input)
    {
        $controller = $this->searchController($input);
        if (!is_array($controller))
            return FALSE;

        if(!isset($controller["breadcrumbs"][0]["item"]))
            return FALSE;

        $breadcrumbs = array();
        foreach ($controller["breadcrumbs"][0]["item"] as $item)
        {
            if (!isset($item["name"][0]) ||
                !isset($item["url"][0]) ||
                !is_string($item["name"][0]) ||
                !is_string($item["url"][0])
            )
                return FALSE;

            $breadcrumbs[] = array(
                "name" => $item["name"][0],
                "url"  => $item["url"] [0]
            );
        }

        return $breadcrumbs;
    }
} 