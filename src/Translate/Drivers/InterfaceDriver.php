<?php

namespace Rmtram\XmlValidator\Translate\Drivers;

interface InterfaceDriver
{
    /**
     * @param string $path
     * @return array
     */
    public function parse($path);
}