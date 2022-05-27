### UUID VO
```php
use Olsza\ValueObjects\Complex\Uuid;

$uuidVO = new Uuid('11ecf4b1-7728-4cc0-adea-154d11a5b43e', 'StringName');
$uuidVO->add('22ecf4b1-7728-4cc0-adea-154d11a5b43e', 'StringName2');
$uuidVO->add('33ecf4b1-7728-4cc0-adea-154d11a5b43e', 'StringName3');

$allUuids = $uuidVO->uuids;
// array:3 [
//    "StringName" => "11ecf4b1-7728-4cc0-adea-154d11a5b43e"
//    "StringName2" => "22ecf4b1-7728-4cc0-adea-154d11a5b43e"
//    "StringName3" => "33ecf4b1-7728-4cc0-adea-154d11a5b43e"
// ]


$uuidByName = $uuidVO->getUuidFor('StringName3');
// 33ecf4b1-7728-4cc0-adea-154d11a5b43e

$firstUuid = (string) $uuidVO;
// 11ecf4b1-7728-4cc0-adea-154d11a5b43e
```

### Tax Number VO

```php
use Olsza\ValueObjects\Complex\TaxNumber;

$taxNumber = new TaxNumber('pl0123456789');
// PL0123456789

// Or call the object statically:
$taxNumber = TaxNumber::make('pl0123456789');
// PL0123456789

$taxNumber = new TaxNumber('PL0123456789', 'pL');
// PL0123456789

$taxNumber = new TaxNumber('0123456789', 'pL');
// PL0123456789

$taxNumber = new TaxNumber('Ab0123456789', 'pL');
// PLAB0123456789

$taxNumber = new TaxNumber('PL 012-345 67.89');
// PL0123456789

$taxNumber = new TaxNumber('Ab 012-345 67.89', 'uK');
// UKAB0123456789

$taxNumber->getFullTaxNumber(); // UKAB0123456789
$taxNumber->getCountry(); // UK 
$taxNumber->getTaxNumber();  // AB0123456789 
```