<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/5/14
 * Time: 11:44 PM
 */

namespace MetaInfoTools\tests;
use MetaInfo\ConfigReaders\FileConfigReader;

require_once "../lib/ConfigReader/FileConfigReader.php";

class FileConfigReaderTest extends \PHPUnit_Framework_TestCase {
    private $obj;
    const PathToSandbox = "/sandbox";

    private static function clearSandbox()
    {
        $fullPath = __DIR__.self::PathToSandbox;
        if($handle = opendir($fullPath)) {
            while (false !== ($file = readdir($handle))) {
                if($file!="." && $file!="..")
                {
                    $filename = $fullPath."/".$file;
                    if(is_dir($filename))
                        rmdir($filename);
                    else
                        unlink($filename);
                }
            }
        }
    }
    protected function setUp()
    {
        $this->obj = new FileConfigReader('test', __DIR__.self::PathToSandbox);
        self::clearSandbox();
    }

    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testReadNotExixtstFile()
    {
        $this->assertEquals($this->obj->getData(), FALSE);
    }

    public function testReadExistsFile()
    {
        $content = "Hello, world!";
        file_put_contents(__DIR__.self::PathToSandbox."/test.data", $content);
        $this->assertEquals($this->obj->getData(), $content);
    }

    public function testReadDir()
    {
        mkdir(__DIR__.self::PathToSandbox."/test.data");
        $this->assertEquals($this->obj->getData(), FALSE);
    }

    public static function tearDownAfterClass()
    {
        self::clearSandbox();
    }
}
 