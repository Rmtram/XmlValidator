<?php

namespace Rmtram\XmlValidator\Translate\Drivers;

class ArrayDriver implements InterfaceDriver
{
    use ReadableTrait;

    /**
     * @param string $path
     * @return array
     */
    public function parse($path)
    {
        $this->exists($path);
        $data = require $path;
        if (!is_array($data)) {
            throw new \RuntimeException('invalid variable data.');
        }
        return $data;
    }
}