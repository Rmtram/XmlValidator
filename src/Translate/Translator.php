<?php

namespace Rmtram\XmlValidator\Translate;

use Rmtram\XmlValidator\Translate\Drivers\InterfaceDriver;

class Translator
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array
     */
    private $drivers = [
        'yml'  => 'Rmtram\XmlValidator\Translate\Drivers\YamlDriver',
        'json' => 'Rmtram\XmlValidator\Translate\Drivers\JsonDriver',
        'php'  => 'Rmtram\XmlValidator\Translate\Drivers\ArrayDriver'
    ];

    /**
     * constructor
     * @param string $extension
     */
    public function __construct($extension = 'yml')
    {
        $config = new Config();
        $config->setCache(new Cache())->setExtension($extension);
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        $this->load();
        $args = func_get_args();
        if (empty($args)) {
            throw new \RuntimeException('empty arguments');
        }
        $language = [$this->config->getLanguage()];
        $args = array_merge($language, $args);
        $cache = $this->config->getCache();
        return call_user_func_array([$cache, 'get'], $args);
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @throws \InvalidArgumentException
     */
    private function load()
    {
        $language = $this->config->getLanguage();
        $cache = $this->config->getCache();

        if ($cache->has($language)) {
            return;
        }

        $extension = $this->config->getExtension();

        if (!isset($this->drivers[$extension])) {
            throw new \InvalidArgumentException('undefined extension: ' . $extension);
        }

        $path = $this->config->getPath();
        /** @var InterfaceDriver $driver */
        $driver = new $this->drivers[$extension];
        $path = sprintf('%s/%s.%s', $path, $language, $extension);
        $data = $driver->parse($path);
        $cache->set($data, $language);
    }


}