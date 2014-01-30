<?
namespace MetaInfo\DescriptionReader;
require_once 'IDescriptionReader.php';
require_once __DIR__.'/../../../../../vendor/autoload.php';
require_once __DIR__.'/Annotations/MetaInfo.php';
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Annotation\MetaInfo;
class AnnotationDescriptionReader implements IDescriptionReader
{
    function __construct()
    {
        AnnotationRegistry::registerAutoloadNamespace('MetaInfo\DescriptionReader\Annotation',__DIR__."/Annotations/MetaInfo.php");
    }
    public function get($class, $methodName)
    {
        $annotationReader = new AnnotationReader();
        $reflectionMethod = new \ReflectionMethod($class, $methodName);
        $methodAnnotation = $annotationReader->getMethodAnnotations($reflectionMethod);
        foreach ($methodAnnotation as $annotation)
        {
            if ($annotation instanceof Annotation\MetaInfo)
                return $annotation->value;
        }

        return FALSE;
    }
}
