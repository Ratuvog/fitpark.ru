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
    function __construct($method)
    {
        parent::__construct($method);
    }

    public function get($input)
    {
        $controller = $this->searchController($input);
        if (!is_array($controller))
            return FALSE;

        if (!isset($controller["breadcrumbs"][0]["item"]))
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

            $breadcrumbs[] = (object)array(
                "name" => $item["name"][0],
                "url"  => $item["url"] [0]
            );
        }

        return $breadcrumbs;
    }
}
