<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/5/14
 * Time: 3:27 PM
 */
namespace MetaInfo\ConfigReaders;
require_once 'IConfigReader.php';

class FileConfigReader implements IConfigReader
{
    public function getData($className, $pathToController)
    {
        return file_get_contents($pathToController."/".$className.".data");
    }
}
?>