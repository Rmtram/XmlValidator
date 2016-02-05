<?php

namespace Rmtram\XmlValidator\Evaluations;

/**
 * Class RequiredEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
class RequiredEvaluation extends AbstractEvaluation
{

    /**
     * @var array
     */
    private $columns;

    /**
     * @var string
     */
    private $delimiter = '.';

    /**
     * constructor
     * @param array $columns e.g. ['id', 'name']
     * @param string|null $delimiter
     */
    public function __construct(array $columns, $delimiter = null)
    {
        $this->columns = $columns;
        if (!empty($delimiter)) {
            $this->delimiter = $delimiter;
        }
        parent::__construct();
    }

    /**
     * @param \SimpleXMLElement $xml
     * @return bool
     */
    public function evaluate($xml)
    {
        if (empty($this->columns)) {
            return true;
        }

        $array = json_decode(json_encode($xml), true);

        foreach ($this->columns as $column) {
            $ex = explode($this->delimiter, $column);
            $tmp = $array;
            $cache = null;
            foreach ($ex as $v) {
                $cache = !$cache ? $v : $cache . '.' . $v;
                if (isset($tmp[$v]['@attributes'])) {
                    unset($tmp[$v]['@attributes']);
                }
                if (empty($tmp[$v])) {
                    $this->errorManager->add(
                        $this->message->get('required', $cache));
                    continue;
                }
                $tmp = $tmp[$v];
            }
        }

        return $this->errorManager->succeed();
    }

}