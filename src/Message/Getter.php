<?php

namespace Rmtram\XmlValidator\Message;

use Rmtram\XmlValidator\Translate\Translator;

/**
 * Class Getter
 * @package Rmtram\XmlValidator\Locale
 */
class Getter
{

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return string
     */
    public function get()
    {
        $args = func_get_args();
        if (empty($args)) {
            throw new \InvalidArgumentException('empty argument');
        }
        if (count($args) === 1) {
            return $this->translator->get($args[0]);
        }
        return call_user_func_array([$this->translator, 'get'], $args);
    }

}