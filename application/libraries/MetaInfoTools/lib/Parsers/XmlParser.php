<?php
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 1/6/14
 * Time: 2:54 PM
 */
namespace MetaInfo\Parsers;
use ___PHPSTORM_HELPERS\object;

require_once "IParser.php";

class XmlParser implements IParser
{
    public function parse($serializedString)
    {
        $doc = new \DOMDocument();
        $doc->preserveWhiteSpace = FALSE;
        try
        {
            if(!$doc->loadXML($serializedString))
                return FALSE;

            $root = $doc->documentElement;
            $result = array($root->nodeName => $this->objectToArray($root));
            return $result;
        }
        catch(\Exception $e)
        {
            return FALSE;
        }
    }

    private function objectToArray($parent)
    {
        if($parent->nodeType == XML_TEXT_NODE)
        {
            return trim($parent->nodeValue);
        }

        $nodeList = $parent->childNodes;
        $result = array();
        for($i = 0;$i < $nodeList->length;$i++)
        {
            $currentNode  = $nodeList->item($i);
            $key          = $currentNode->nodeName;
            if($currentNode->nodeType == XML_TEXT_NODE)
                $result = trim($currentNode->nodeValue);
            else
                $result[$key][] = $this->objectToArray($currentNode);
        }

        return $result;
    }
}

?>
