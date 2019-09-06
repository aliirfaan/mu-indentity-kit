# IdentityCardKit for Mauritius
PHP library for validating national indentity card (NIC) number.

## Features
- Validate NIC number using regex and checksum
- Get date of birth from NIC number in desired format

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
$dob = $identityCardKit->getDobFromValidNicNumber('N051190465003B'); // 05-11-1990
```