<?php

namespace Rmtram\XmlValidatorTestCase;

/**
 * Class ValidatorTestCase
 */
abstract class ValidatorTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $name
     * @return string
     */
    protected function loadXml($name)
    {
        $path = sprintf('%s/fixtures/%s.xml', __DIR__, $name);
        return file_get_contents($path);
    }
}