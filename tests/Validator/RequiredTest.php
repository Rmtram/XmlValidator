<?php

namespace Rmtram\XmlValidatorTestCase\Validator;

use Rmtram\XmlValidatorTestCase\ValidatorTestCase;
use Rmtram\XmlValidator\Evaluations\RequiredEvaluation;
use Rmtram\XmlValidator\Validator;

/**
 * Class RequiredTest
 * @package Rmtram\XmlValidator\Tests\Validator
 */
class RequiredTest extends ValidatorTestCase
{

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNormalData()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['required'];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNotExistsColumn()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['not'];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testEmptyDataHasAttribute()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['required-attr'];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testEmptyData()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['required1', 'required2', 'required3', 'required4', 'required5'];

        $validator->addEvaluation(new RequiredEvaluation($columns));

        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNestingNormalData()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['nest.required'];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNestingNormalDataWithChangeDelimiter()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['nest/required'];
        $validator->addEvaluation(new RequiredEvaluation($columns, '/'));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNestingNotExistsColumn()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['nest.not'];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNestingEmptyDataHasAttribute()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = ['nest.required-attr'];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers RequiredEvaluation::evaluate
     */
    public function testNestingEmptyData()
    {
        $xml = $this->loadXml('required');
        $validator = new Validator();
        $columns = [
            'nest.required1',
            'nest.required2',
            'nest.required3',
            'nest.required4',
            'nest.required5'
        ];
        $validator->addEvaluation(new RequiredEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

}