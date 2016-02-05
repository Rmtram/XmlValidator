<?php

namespace Rmtram\XmlValidator\Evaluations;

/**
 * Class BasicEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
class BasicEvaluation extends AbstractEvaluation
{
    /**
     * Check xml data
     * @param \SimpleXMLElement $xml
     * @return bool
     */
    public function evaluate($xml)
    {
        if (!$xml) {
            foreach(libxml_get_errors() as $error) {
                $this->errorManager->add($error->message);
            }
            libxml_clear_errors();
        }
        return $this->errorManager->succeed();
    }
}