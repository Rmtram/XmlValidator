<?php

namespace Rmtram\XmlValidator\Evaluations;

/**
 * Interface InterfaceEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
interface InterfaceEvaluation
{
    /**
     * Check xml data
     * @param \SimpleXMLElement $xml
     * @return bool
     */
    public function evaluate($xml);

    /**
     * get errors.
     * @return array
     */
    public function errors();

}