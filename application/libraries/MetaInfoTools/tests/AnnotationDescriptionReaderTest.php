<?
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/6/14
 * Time: 5:32 PM
 */

namespace MetaInfoTools\tests;
require_once "../lib/DescriptionReader/AnnotationDescriptionReader.php";
require_once "../lib/DescriptionReader/Annotations/MetaInfo.php";
use MetaInfo\DescriptionReader\AnnotationDescriptionReader;
use Doctrine\Common\Annotations\AnnotationReader;

class AnnotationDescriptionReaderTest extends \PHPUnit_Framework_TestCase {

    public function testReadNonEmptyAnnotation()
    {
        require_once 'AnnotationDescriptionReaderTestData/TestClass1.php';
        $annotater = new \TestClass1();
        $reader = new AnnotationDescriptionReader();
        $this->assertEquals($reader->get($annotater, 'test1'), 'TestMethod1');
        $this->assertEquals($reader->get($annotater, 'test2'), 'TestMethod2');
        $this->assertEquals($reader->get($annotater, 'nonAnnotationsMethod'), FALSE);
    }
}

?>
