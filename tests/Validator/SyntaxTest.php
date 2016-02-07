<?php

namespace Rmtram\XmlValidatorTestCase\Validator;

use Rmtram\XmlValidator\Evaluations\SyntaxEvaluation;
use Rmtram\XmlValidator\Validator;
use Rmtram\XmlValidatorTestCase\ValidatorTestCase;

/**
 * Class SyntaxTest
 * @package Rmtram\XmlValidator\Tests\Validator
 */
class SyntaxTest extends ValidatorTestCase
{

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers BasicEvaluation::evaluate
     */
    public function testNormal()
    {
        $xml = $this->loadXml('normal');
        $validator = new Validator();
        $validator->addEvaluation(new SyntaxEvaluation());
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers BasicEvaluation::evaluate
     */
    public function testError()
    {
        $xml = $this->loadXml('syntax-error');
        $validator = new Validator();
        $validator->addEvaluation(new SyntaxEvaluation());
        $this->assertFalse($validator->validate($xml));
        $this->assertArrayHasKey(0, $validator->errors());
    }

}