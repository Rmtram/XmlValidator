<?php

namespace Rmtram\XmlValidator\Evaluations;
use Rmtram\XmlValidator\Evaluations\Mixin\Messenger;

/**
 * Class PropertyExistsEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
class PropertyExistsEvaluation extends AbstractEvaluation
{

    use Messenger;

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
            $keys = explode($this->delimiter, $column);
            $tmp = $xml;
            $message = null;
            foreach ($keys as $k) {
                $message = !$message ? $k : $message . '.' . $k;
                if (!property_exists($tmp, $k)) {
                    $this->addErrorWithTranslateMessage(
                        'property_exists', $message);
                    continue;
                }
                $tmp = $tmp->$k;
            }
        }
        return $this->errorManager->succeed();
    }

}