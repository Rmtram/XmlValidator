<?php

namespace Rmtram\XmlValidator\Evaluations\Mixin;


trait Trimmer
{
    /**
     * @param array $data
     * @param string|null $key
     * @return mixed
     */
    public function trimAttributes($data, $key = null)
    {
        if (!is_null($key)) {
            if (isset($data[$key]['@attributes'])) {
                unset($data[$key]['@attributes']);
            }
        } else {
            if (isset($data['@attributes'])) {
                unset($data['@attributes']);
            }
        }
        return $data;
    }
}