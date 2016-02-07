<?php

namespace Rmtram\XmlValidatorTestCase\Validator;

use Rmtram\XmlValidator\Evaluations\MatchValueEvaluation;
use Rmtram\XmlValidatorTestCase\ValidatorTestCase;
use Rmtram\XmlValidator\Validator;

/**
 * Class PropertyExistsTest
 * @package Rmtram\XmlValidatorTestCase\Validator
 */
class MatchValueTest extends ValidatorTestCase
{

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers MatchValueEvaluation::evaluate
     */
    public function testSuccess()
    {
        $xml = $this->loadXml('match-value');
        $validator = new Validator();
        $columns = [
            'value'      => 'ok',
            'nest.value' => 'ok',
        ];
        $validator->addEvaluation(new MatchValueEvaluation($columns));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers MatchValueEvaluation::evaluate
     */
    public function testSuccessInValues()
    {
        $xml = $this->loadXml('match-value');
        $validator = new Validator();
        $columns = [
            'value'      => ['ok1', 'ok2', 'ok'],
            'nest.value' => ['ok', 'ok2', 'ok3'],
        ];
        $validator->addEvaluation(new MatchValueEvaluation($columns));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

}