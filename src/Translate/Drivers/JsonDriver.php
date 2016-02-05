<?php

namespace Rmtram\XmlValidator\Translate\Drivers;

class JsonDriver implements InterfaceDriver
{
    use ReadableTrait;

    /**
     * @param string $path
     * @return array
     */
    public function parse($path)
    {
        $content = $this->read($path);
        return json_decode($content, true);
    }
}