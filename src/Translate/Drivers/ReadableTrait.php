<?php

namespace Rmtram\XmlValidator\Translate\Drivers;

trait ReadableTrait
{
    /**
     * @param string $path
     * @throws \RuntimeException
     */
    private function exists($path)
    {
        if (!is_readable($path)) {
            throw new \RuntimeException('not found file: ' . $path);
        }
    }

    /**
     * @param string $path
     * @throws \RuntimeException
     * @return string
     */
    private function read($path)
    {
        $this->exists($path);
        $content = file_get_contents($path);
        if (empty($content)) {
            throw new \RuntimeException('empty content');
        }
        return $content;
    }

}