<?php

namespace Rmtram\XmlValidator\Evaluations;
use Rmtram\XmlValidator\Evaluations\Mixin\Messenger;
use Rmtram\XmlValidator\Evaluations\Mixin\Trimmer;

/**
 * Class RequiredEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
class MatchValueEvaluation extends AbstractEvaluation
{

    use Trimmer;

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
        $array = json_decode(json_encode($xml), true);
        foreach ($this->columns as $column => $val) {
            $keys = explode($this->delimiter, $column);
            $tmp = $array;
            $errorFlag = false;
            $message = null;
            foreach ($keys as $k) {
                $message = !$message ? $k : $message . '.' . $k;
                $tmp = $this->trimAttributes($tmp, $k);
                if (empty($tmp[$k])) {
                    $errorFlag = true;
                    $this->addErrorWithTranslateMessage(
                        'match-value', $message);
                    continue;
                }
                $tmp = $tmp[$k];
            }
            if (false === $errorFlag) {
                if (!$this->isMatch($tmp, $val)) {
                    $this->addErrorWithTranslateMessage(
                        'match-value', $message);
                }
            }
        }
        return $this->errorManager->succeed();
    }

    /**
     * @param string $expand
     * @param string|array $actual
     * @return bool
     */
    private function isMatch($expand, $actual)
    {
        if (is_array($actual)) {
            return in_array($expand, $actual);
        }
        return $expand === $actual;
    }

}