<?php

namespace Rmtram\XmlValidator\Evaluations;
use Rmtram\XmlValidator\Message\Getter;


/**
 * Class AbstractEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
abstract class AbstractEvaluation implements InterfaceEvaluation, InterfaceMessage
{

    /**
     * @var ErrorManager
     */
    protected $errorEntity;

    /**
     * @var Getter
     */
    protected $message;

    public function __construct()
    {
        $this->errorManager = new ErrorManager();
    }

    /**
     * get errors.
     * @return array
     */
    public function errors()
    {
        return $this->errorManager->all();
    }

    /**
     * @param Getter $getter
     */
    public function setMessage(Getter $getter)
    {
        $this->message = $getter;
    }
}