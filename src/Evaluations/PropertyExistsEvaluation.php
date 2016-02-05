<?php

namespace Rmtram\XmlValidator\Evaluations;

/**
 * Class PropertyExistsEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
class PropertyExistsEvaluation extends AbstractEvaluation
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
        foreach ($this->columns as $column) {
            $ex = explode($this->delimiter, $column);
            $tmp = $xml;
            $cache = null;
            foreach ($ex as $v) {
                $cache = !$cache ? $v : $cache . '.' . $v;
                if (!property_exists($tmp, $v)) {
                    $this->errorManager->add(
                        $this->message->get('property_exists', $cache));
                    continue;
                }
                $tmp = $tmp->$v;
            }
        }
        return $this->errorManager->succeed();
    }

}