<?php

namespace Temidaio\ValueObjects\Tests\Feature\ValueObjects;

use Temidaio\ValueObjects\Formatters\NameFormatter;

test('can format first name', function () {
    $name = format(NameFormatter::class, 'michael');

    assertSame('Michael', $name);
});

test('can format last name', function () {
    $name = format(NameFormatter::class, 'rubél');

    assertSame('Rubél', $name);
});

test('can format first and last name', function () {
    $name = format(NameFormatter::class, 'michaeL rubéL');

    assertSame('Michael Rubél', $name);
});

test('can format adds space between words', function () {
    $name = format(NameFormatter::class, 'MichaelRubél');

    assertSame('Michael Rubél', $name);
});

test('formatter cuts space before and after', function () {
    $name = format(NameFormatter::class, ' MichaelRubél ');

    assertSame('Michael Rubél', $name);
});
