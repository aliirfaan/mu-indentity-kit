# IdentityCardKit for Mauritius
PHP library for validating national indentity card (NIC) number.

## Features
- Validate NIC number using regex and checksum

## Installation

Install the latest version with

```bash
$ composer require aliirfaan/mu-identity-kit
```

## Basic Usage

```php
<?php

require 'vendor/autoload.php';

use Aliirfaan\IdentityKit\IdentityCardKit;

// instantiate class
$identityCardKit = new IdentityCardKit();

// use
$isValid = $identityCardKit->isValidNicNumber('N051186463883C'); // false
```

## About

### Requirements
- Version 1.x works with PHP 5.2.0 or above