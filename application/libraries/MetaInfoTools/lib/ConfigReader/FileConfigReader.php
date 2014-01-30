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
        $pathToFile = $pathToController."/".$className.".data";
        if (!file_exists($pathToFile))
            return FALSE;

        return file_get_contents($pathToFile);
    }
}
?>
