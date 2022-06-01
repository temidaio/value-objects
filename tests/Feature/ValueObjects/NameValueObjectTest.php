<?php

namespace Olsza\ValueObjects\Tests\Feature\ValueObjects;

use Olsza\ValueObjects\Complex\Name;

test('can get first name', function () {
    $name = new Name('Michael');

    assertSame('Michael', $name->getFirstName());
});

test('can get last name', function () {
    $name = new Name(last_name: 'Rubél');

    assertSame('Rubél', $name->getLastName());
});

test('can get full name', function () {
    $name = new Name('Michael', 'Rubél');

    assertSame('Michael Rubél', $name->getFullName());
});

test('can get cast to string', function () {
    $name = new Name('Michael', 'Rubél');

    assertSame('Michael Rubél', (string) $name);
});

test('can pass only last name and get through full name', function () {
    $name = new Name(last_name: 'Rubél');

    assertSame('Rubél', $name->getFullName());
});

test('can pass only first name and get through full name', function () {
    $name = new Name(first_name: 'Michael');

    assertSame('Michael', $name->getFullName());
});

test('can pass nulls and returns empty string', function () {
    $name = new Name();
    assertSame('', $name->getFullName());

    $name = new Name(null);
    assertSame('', $name->getFullName());

    $name = new Name(null, null);
    assertSame('', $name->getFullName());
});
