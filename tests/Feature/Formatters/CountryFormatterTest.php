<?php

declare(strict_types=1);

use Temidaio\ValueObjects\Formatters\CountryFormatter;

test('providing all data correctly returning country name', function () {
    $data = format(CountryFormatter::class, [
        'iso_code' => 'PL',
        'country'  => 'pol',
    ]);

    expect($data)->toEqual('Pol');
});

test('providing only code returning code', function () {
    $data = format(CountryFormatter::class, [
        'iso_code' => 'PL',
    ]);

    expect($data)->toEqual('PL');
});

test('providing only name returning name', function () {
    $data = format(CountryFormatter::class, [
        'country' => 'poland',
    ]);

    expect($data)->toEqual('Poland');
});

test('returns empty string if wrong parameters passed', function () {
    $data = format(CountryFormatter::class, [
        'test' => true,
    ]);

    expect($data)->toEqual('');
});
