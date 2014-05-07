# Fuel Amazon Package

A super simple Amazon package for the AWS PHP SDK for Fuel.

## About
* Version: 1.0.0
* License: MIT License
* Author: Derek Myers

## Installation

Simply add the following to your composer.json require block:

	'aws/aws-sdk-php'

### Git Submodule

If you are installing this as a submodule (recommended) in your git repo root, run this command:

	$ git submodule add git://github.com/dmyers/fuel-amazon.git fuel/packages/amazon

Then you you need to initialize and update the submodule:

	$ git submodule update --init --recursive fuel/packages/amazon/

### Download

Alternatively you can download it and extract it into `fuel/packages/amazon/`.

## Usage

```php
$amazon = Amazon::instance();
$s3 = $amazon->get('s3');
var_dump($s3->listBuckets());
```

For more examples, check out the [AWS PHP SDK](https://github.com/aws/aws-sdk-php).

## Configuration

Configuration is easy. First thing you will need to do is to [signup for Amazon Web Services](https://aws-portal.amazon.com/gp/aws/developer/registration/index.html) (if you haven't already).

Next, copy the `config/amazon.php` from the package up into your `app/config/` directory. Open it up and enter your API keys.

## Updates

In order to keep the package up to date simply run:

	$ git submodule update --recursive fuel/packages/amazon/
