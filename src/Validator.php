<?php

namespace Rmtram\XmlValidator;

use Rmtram\XmlValidator\Evaluations\InterfaceEvaluation;
use Rmtram\XmlValidator\Evaluations\InterfaceMessageEvaluation;
use Rmtram\XmlValidator\Message\Getter;
use Rmtram\XmlValidator\Parsers\InterfaceParser;
use Rmtram\XmlValidator\Translate\Translator;

class Validator
{
    /**
     * @var array
     */
    private $defaults = [
        'parser' => 'Rmtram\XmlValidator\Parsers\SimpleParser',
    ];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $evaluations = [];

    /**
     * @var InterfaceParser
     */
    private $parser;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * constructor.
     * @param array $defaults
     */
    public function __construct(array $defaults = [])
    {
        libxml_use_internal_errors(true);
        $this->initialize($defaults);
    }

    /**
     * @param InterfaceEvaluation $evaluation
     * @return $this
     */
    public function addEvaluation(InterfaceEvaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;
        return $this;
    }

    /**
     * @param InterfaceParser $parser
     * @return $this
     */
    public function setParser(InterfaceParser $parser)
    {
        $this->parser = $parser;
        return $this;
    }

    /**
     * @return Translate\Config
     */
    public function getTranslatorConfig()
    {
        return $this->translator->getConfig();
    }

    /**
     * @param string $xml
     * @return bool
     */
    public function validate($xml)
    {
        $this->reset();

        if (empty($this->evaluations)) {
            return true;
        }

        $xml = $this->parser->parse($xml);

        $getter = new Getter($this->translator);

        /** @var InterfaceEvaluation $evaluation */
        foreach ($this->evaluations as $evaluation) {
            if ($evaluation instanceof InterfaceMessageEvaluation) {
                /** @var InterfaceMessageEvaluation $evaluation */
                $evaluation->setMessage($getter);
            }
            if (!$evaluation->evaluate($xml)) {
                $this->errors = $evaluation->errors();
                return false;
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * reset
     */
    private function reset()
    {
        $this->errors = [];
    }

    /**
     * @param array $defaults
     */
    private function initialize(array $defaults)
    {
        if (!empty($defaults)) {
            $this->defaults = $defaults + $this->defaults;
        }
        $this->setParser(new $this->defaults['parser']);
        $translator = new Translator();
        $translator->getConfig()
            ->setPath(__DIR__ . '/languages')
            ->setLanguage('en');
        $this->translator = $translator;
    }

}