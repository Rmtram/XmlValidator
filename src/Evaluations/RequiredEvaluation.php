<?php

namespace Rmtram\XmlValidator\Evaluations;
use Rmtram\XmlValidator\Evaluations\Mixin\Messenger;
use Rmtram\XmlValidator\Evaluations\Mixin\Trimmer;

/**
 * Class RequiredEvaluation
 * @package Rmtram\XmlValidator\Evaluations
 */
class RequiredEvaluation extends AbstractEvaluation
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

        foreach ($this->columns as $column) {
            $keys = explode($this->delimiter, $column);
            $tmp = $array;
            $message = null;
            foreach ($keys as $k) {
                $message = !$message ? $k : $message . '.' . $k;
                $tmp = $this->trimAttributes($tmp, $k);
                if (empty($tmp[$k])) {
                    $this->addErrorWithTranslateMessage('required', $message);
                    continue;
                }
                $tmp = $tmp[$k];
            }
        }

        return $this->errorManager->succeed();
    }

}