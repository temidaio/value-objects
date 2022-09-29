<?php

declare(strict_types=1);

use Temidaio\ValueObjects\Formatters\StreetFormatter;

test('all street data provided returning street address', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
        'street' => 'ulica',
        'number' => '21',
        'local'  => '37',
      ]);

    expect($data)->toEqual('ul. ulica 21/37');
});

test('missing prefix returning partial street address', function () {
    $data = format(StreetFormatter::class, [
        'street' => 'ulica',
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data)->toEqual('ulica 21/37');
});

test('missing street returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data)->toEqual('21/37');
});

test('missing number returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
        'street' => 'ulica',
        'local'  => '37',
    ]);

    expect($data)->toEqual('ul. ulica 37');
});

test('missing local returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
        'street' => 'ulica',
        'number' => '21',
    ]);
    expect($data)->toEqual('ul. ulica 21');
});

test('missing prefix, street returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data)->toEqual('21/37');
});

test('missing street, number returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
        'local'  => '37',
    ]);

    expect($data)->toEqual('37');
});

test('missing number, local returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
        'street' => 'ulica',
    ]);

    expect($data)->toEqual('ul. ulica');
});

test('missing prefix, street, number returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'local' => '37',
    ]);

    expect($data)->toEqual('37');
});

test('missing street, number, local returning empty string', function () {
    $data = format(StreetFormatter::class, [
        'prefix' => 'ul.',
    ]);

    expect($data)->toEqual('');
});

test('missing all returning empty string', function () {
    $data = format(StreetFormatter::class, []);

    expect($data)->toEqual('');
});
