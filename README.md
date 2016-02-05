# XmlValidator

[![Build Status](https://travis-ci.org/Rmtram/XmlValidator.svg)](https://travis-ci.org/Rmtram/XmlValidator)

## Introduction
Simple Xml Validator.

## Example

use basic.

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

**Evaluation list.**

`xml data`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<ok>ok</ok>
<ng></ng>
<nest>
    <ok>ok</ok>
    <ng></ng>
</nest>

```

`required succeed`

```php

$validator = new Validator();

// xml data
$xml = '...'; 

// required columns.
$columns = ['ok'];

// add required evaluation.
$validator->addEvaluation(new RequiredEvaluation($columns));

// true
$validator->validate($xml)

```

`required(nest data) succeed`

```php

$validator = new Validator();

// xml data
$xml = '...'; 

// required columns.
$columns = ['nest.ok'];

// add required evaluation.
$validator->addEvaluation(new RequiredEvaluation($columns));

// true
$validator->validate($xml)

```

`required fail`

```php

$validator = new Validator();

// xml data
$xml = '...'; 

// required columns.
$columns = ['ng'];

// add required evaluation.
$validator->addEvaluation(new RequiredEvaluation($columns));

// false
$validator->validate($xml)

```

`required(nest data) fail`

```php

$validator = new Validator();

// xml data
$xml = '...'; 

// required columns.
$columns = ['ng'];

// add required evaluation.
$validator->addEvaluation(new RequiredEvaluation($columns));

// false
$validator->validate($xml)

```