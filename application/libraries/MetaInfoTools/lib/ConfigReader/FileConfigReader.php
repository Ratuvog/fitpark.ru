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
    private $controllerName   = null;
    private $pathToController = null;
    function __construct($controllerName, $pathToController)
    {
        $this->controllerName  = $controllerName;
        $this->pathToController = $pathToController;
    }

    public function getData()
    {
        return file_get_contents($this->pathToController."/".$this->controllerName.".data");
    }
}
?>