# XmlValidator

[![Build Status](https://travis-ci.org/Rmtram/XmlValidator.svg)](https://travis-ci.org/Rmtram/XmlValidator)

## Introduction
Simple Xml Validator.

## Example

```php

$validator = new Validator();

// Syntax to evaluate whether correct.
$validator->addEvaluation(new BasicEvaluation());

$xml = '<?xml version="1.0" encoding="UTF-8"?><test></test>';

if ($validator->validate($xml)) {
  // success
} else {
  // fail
  $errors = $validator->errors();
}

```
