<?php

namespace Rmtram\XmlValidatorTestCase\Validator;

use Rmtram\XmlValidator\Evaluations\PropertyExistsEvaluation;
use Rmtram\XmlValidatorTestCase\ValidatorTestCase;
use Rmtram\XmlValidator\Evaluations\RequiredEvaluation;
use Rmtram\XmlValidator\Validator;

/**
 * Class PropertyExistsTest
 * @package Rmtram\XmlValidatorTestCase\Validator
 */
class PropertyExistsTest extends ValidatorTestCase
{

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers PropertyExistsEvaluation::evaluate
     */
    public function testExistsColumns()
    {
        $xml = $this->loadXml('property-exists');
        $validator = new Validator();
        $columns = [
            'exists1',
            'exists2',
            'exists3',
            'exists4',
            'exists5',
        ];
        $validator->addEvaluation(new PropertyExistsEvaluation($columns));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers PropertyExistsEvaluation::evaluate
     */
    public function testNotExistsColumns()
    {
        $xml = $this->loadXml('property-exists');
        $validator = new Validator();
        $columns = ['not'];
        $validator->addEvaluation(new PropertyExistsEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers PropertyExistsEvaluation::evaluate
     */
    public function testNestingExistsColumns()
    {
        $xml = $this->loadXml('property-exists');
        $validator = new Validator();
        $columns = [
            'nest.exists1',
            'nest.exists2',
            'nest.exists3',
            'nest.exists4',
            'nest.exists5',
        ];
        $validator->addEvaluation(new PropertyExistsEvaluation($columns));
        $this->assertTrue($validator->validate($xml));
        $this->assertEmpty($validator->errors());
    }

    /**
     * @covers Validator::validate
     * @covers Validator::errors
     * @covers PropertyExistsEvaluation::evaluate
     */
    public function testNestingNotExistsColumns()
    {
        $xml = $this->loadXml('property-exists');
        $validator = new Validator();
        $columns = ['nest.not'];
        $validator->addEvaluation(new PropertyExistsEvaluation($columns));
        $this->assertFalse($validator->validate($xml));
        $this->assertNotEmpty($validator->errors());
    }

}