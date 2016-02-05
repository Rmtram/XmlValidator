<?php

namespace Rmtram\XmlValidator\Translate;

class Config
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $language = 'en';

    /**
     * @var string
     */
    private $extension = 'yml';

    /**
     * @var Cache
     */
    private $cache;

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $last = substr($path, -1);
        if ($last === '/') {
            $path = substr($path, 0, -1);
        }
        $this->path = $path;
        $this->cache->clear();
        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     * @return $this
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
        return $this;
    }

    /**
     * @return Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param Cache $cache
     * @return $this
     */
    public function setCache(Cache $cache)
    {
        $this->cache = $cache;
        return $this;
    }
}