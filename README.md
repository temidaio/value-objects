# Value Objects

[![Latest Version on Packagist](https://img.shields.io/packagist/v/olsza/value-objects.svg?style=flat-square)](https://packagist.org/packages/olsza/value-objects)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/olsza/value-objects/run-tests?label=tests)](https://github.com/olsza/value-objects/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/olsza/value-objects/Check%20&%20fix%20styling?label=code%20style)](https://github.com/olsza/value-objects/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/olsza/value-objects.svg?style=flat-square)](https://packagist.org/packages/olsza/value-objects)

Contains value objects:

- TaxNumber


## Installation

You can install the package via composer:

```bash
composer require olsza/value-objects
```

## Usage

```php
use Olsza\ValueObjects\TaxNumber;

$taxNumber = new TaxNumber('pl0123456789');
// or Static
$taxNumber = TaxNumber::make('pl0123456789');
echo $taxNumber; // PL0123456789

$taxNumber = new TaxNumber('PL0123456789', 'pL');
echo $taxNumber; // PL0123456789

$taxNumber = new TaxNumber('0123456789', 'pL');
echo $taxNumber; // PL0123456789

$taxNumber = new TaxNumber('Ab0123456789', 'pL');
echo $taxNumber; // PLAB0123456789

$taxNumber = new TaxNumber('PL 012-345 67.89');
echo $taxNumber; // PL0123456789

$taxNumber = new TaxNumber('Ab 012-345 67.89', 'uK');
echo $taxNumber; // UKAB0123456789
echo $taxNumber->getFullTaxNumber(); // UKAB0123456789
echo $taxNumber->getCountry(); // UK 
echo $taxNumber->getTaxNumber();  //AB0123456789 
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Olsza](https://github.com/olsza)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
