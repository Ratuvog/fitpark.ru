<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/6/14
 * Time: 2:58 PM
 */

namespace MetaInfoTools\tests;
use MetaInfo\Parsers\XmlParser;
require_once "../lib/Parsers/XmlParser.php";

class XmlParserTest extends \PHPUnit_Framework_TestCase {
    /**
     * @dataProvider dataProvider
     */
    public function testParser($input, $output)
    {
        $obj = new XmlParser();
        $this->assertEquals($obj->parse($input), $output);
    }

    public function dataProvider()
    {
        return array(
            array(
                "<controllers><controllerName>
                    <description>
                        1
                    </description>
                    <keywords>
                        2
                    </keywords>
                    <breadcrumbs>
                        <item>
                            <name>
                                3
                            </name>
                            <url>
                                4
                            </url>
                        </item>
                        <item>
                            <name>
                                5
                            </name>
                            <url>
                                6
                            </url>
                        </item>
                    </breadcrumbs>
                </controllerName></controllers>",
                array
                (
                    "controllers" => array
                    (
                        "controllerName" => array
                        (
                            0 => array
                            (
                                    "description" => array
                                    (
                                        0 => 1
                                    ),
                                    "keywords" => array
                                    (
                                        0 => 2
                                    ),

                                    "breadcrumbs" => array
                                    (
                                        0 => array
                                        (
                                            "item" => array
                                            (
                                                0 => array
                                                (
                                                    "name" => array
                                                    (
                                                        0 => 3
                                                    ),
                                                    "url" => array
                                                    (
                                                        0 => 4
                                                    )
                                                ),
                                                1 => array
                                                (
                                                    "name" => array
                                                     (
                                                        0 => 5
                                                     ),
                                                     "url" => array
                                                     (
                                                        0 => 6
                                                     )
                                                )

                                            )

                                        )

                                    )

                            )

                        )

                    )
                )
            ),
            array(
                'test', FALSE
            ),
            array(
                "<controller></controller><controller></controller>", FALSE
            )
        );
    }
}
 