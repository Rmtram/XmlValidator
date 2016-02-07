<?php
/**
 * Created by PhpStorm.
 * User: noguhiro
 * Date: 16/02/07
 * Time: 23:47
 */

namespace Rmtram\XmlValidator\Evaluations\Mixin;


use Rmtram\XmlValidator\Message\Getter;

trait Messenger
{
    /**
     * @param string $key
     * @param string $val
     */
    public function addErrorWithTranslateMessage($key, $val)
    {
        if ($this->message instanceof Getter) {
            $message = $this->message->get($key, $val);
            $this->errorManager->add($message);
        }
    }
}