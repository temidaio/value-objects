<?php

namespace Olsza\ValueObjects\Tests\Feature\ValueObjects;

use Olsza\ValueObjects\Complex\ClassString;
use Olsza\ValueObjects\Exceptions\InvalidClassStringException;
use Olsza\ValueObjects\ValueObject;

test('class string fails if not proper format', function () {
    new ClassString('Test');
})->expectException(InvalidClassStringException::class);

test('can get class string', function () {
    $classString = new ClassString('My\Test\Class');

    assertSame('My\Test\Class', $classString->getClassString());
});

test('class string is exists and defined', function () {
    $classString = new ClassString('My\Test\Class\NotInstantiable');

    assertFalse($classString->isClassExists());
    assertFalse($classString->isInterfaceExists());
});

test('class string is exists but interface dont', function () {
    $classString = new ClassString(ClassString::class);

    assertTrue($classString->isClassExists());
    assertFalse($classString->isInterfaceExists());
});

test('class string is interface & exists but class dont', function () {
    $classString = new ClassString(ValueObject::class);

    assertFalse($classString->isClassExists());
    assertTrue($classString->isInterfaceExists());
});

