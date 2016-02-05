<?php

namespace Rmtram\XmlValidator\Parsers;

interface InterfaceParser
{
    /**
     * @param string $text
     * @return \SimpleXMLElement
     */
    public function parse($text);
}