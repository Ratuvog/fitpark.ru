<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/6/14
 * Time: 5:32 PM
 */

namespace MetaInfoTools\tests;
require_once "../lib/MetaGetters/SimpleMetaGetter.php";

use MetaInfo\MetaGetter\SimpleMetaGetter;
use Symfony\Component\Yaml\Yaml;

class SimpleMetaGetterTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider provider
     */
    public function testGetDescription($input, $description, $keywords)
    {
        $obj = new SimpleMetaGetter("controllerName", "description");
        $this->assertEquals($obj->get($input), $description);

        $obj = new SimpleMetaGetter("controllerName", "keywords");
        $this->assertEquals($obj->get($input), $keywords);
    }

    public function provider()
    {
        return Yaml::parse(file_get_contents("SimpleMetaGetterTest.yml"));
    }
}
 