<?php

namespace Rmtram\XmlValidator\Parsers;

class SimpleParser implements InterfaceParser
{

    /**
     * @param string $text
     * @return \SimpleXMLElement
     */
    public function parse($text)
    {
        return simplexml_load_string($text, 'SimpleXMLElement', LIBXML_NOCDATA);
    }

}