<?php
/**
 * Created by PhpStorm.
 * User: noguhiro
 * Date: 16/02/04
 * Time: 13:20
 */

namespace Rmtram\XmlValidator\Evaluations;

use Rmtram\XmlValidator\Message\Getter;

class ErrorManager {

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @return array
     */
    public function all()
    {
        return $this->errors;
    }

    /**
     * @param int $index
     * @return string
     */
    public function get($index)
    {
        return $this->errors[$index];
    }

    /**
     * @param string $error
     * @return $this
     */
    public function add($error)
    {
        $this->errors[] = $error;
        return $this;
    }

    /**
     * @return string
     */
    public function strings()
    {
        if ($this->succeed()) {
            return null;
        }
        return implode($this->errors);
    }

    /**
     * @return bool
     */
    public function succeed()
    {
        return empty($this->errors);
    }

    /**
     * @return bool
     */
    public function fail()
    {
        return !empty($this->errors);
    }

}