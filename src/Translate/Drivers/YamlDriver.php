<?php

namespace Rmtram\XmlValidator\Translate\Drivers;

class YamlDriver implements InterfaceDriver
{
    use ReadableTrait;

    /**
     * @param string $path
     * @return array
     */
    public function parse($path)
    {
        $content = $this->read($path);
        $yaml = new \Symfony\Component\Yaml\Yaml();
        return $yaml->parse($content);
    }
}