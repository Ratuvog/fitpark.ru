<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/11/14
 * Time: 11:33 PM
 */

namespace MetaInfoTools\tests;
require_once "../lib/MetaGetters/BreadCrumbsMetaGetter.php";
use MetaInfo\MetaGetter\BreadCrumbsMetaGetter;
use Symfony\Component\Yaml\Yaml;

class BreadCrumbsMetaGetterTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider provider
     */
    function testBreadCrumbs($input, $output)
    {
        $obj = new BreadCrumbsMetaGetter("controllerName");
        $this->assertEquals($obj->get($input), $output);
    }

    function provider()
    {
        return Yaml::parse(file_get_contents("BreadCrumbsMetaGetterTest.yml"));
    }
}
 