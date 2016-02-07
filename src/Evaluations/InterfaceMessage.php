<?php

namespace Rmtram\XmlValidator\Evaluations;

use Rmtram\XmlValidator\Message\Getter;

/**
 * Interface InterfaceLocalEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
interface InterfaceMessage
{
    /**
     * SetLocaleGetter
     * @param Getter $getter
     * @return void
     */
    public function setMessage(Getter $getter);
}