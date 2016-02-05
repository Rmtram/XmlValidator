<?php

namespace Rmtram\XmlValidator\Translate;

class Cache
{
    /**
     * @var array
     */
    private $messages;

    /**
     * @var string
     */
    private $delimiter = '.';

    /**
     * @return mixed
     */
    public function get()
    {
        $args = func_get_args();
        $language = array_shift($args);
        $key = array_shift($args);

        if (!isset($this->messages[$language])) {
            return null;
        }

        $keys = explode($this->delimiter, $key);
        $target = $this->messages[$language];

        foreach ($keys as $k) {
            if (!isset($target[$k])) {
                return null;
            }
            $target = $target[$k];
        }

        if (is_string($target) && !empty($args)) {
            return vsprintf($target, $args);
        }

        return $target;
    }

    /**
     * @param string $language
     * @return bool
     */
    public function has($language)
    {
        return isset($this->messages[$language]);
    }

    /**
     * @param array $data
     * @param string $language
     */
    public function set($data, $language)
    {
        $this->messages[$language] = $data;
    }

    /**
     * clear
     */
    public function clear()
    {
        $this->messages = [];
    }
}