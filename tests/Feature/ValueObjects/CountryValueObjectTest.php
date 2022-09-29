<?php

declare(strict_types=1);

use Temidaio\ValueObjects\Country;

test('only country code provided returning empty string', function () {
    $data = new Country([
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('');
});

test('providing country name with whitespaces returning trimmed country name', function () {
    $data = new Country([
        'country'      => '   poland    ',
    ]);

    expect($data)->toEqual('Poland');
});

test('using static make method with all data returning country name', function () {
    $data = Country::make([
        'country_code' => 'pl',
        'country'      => 'poland',
    ]);

    expect($data)->toEqual('Poland');
});

test('country code property retrieved and returned as string', function () {
    $data = new Country([
        'country_code' => 'HA',
    ]);

    expect($data->iso_code)->toEqual('HA');
});

test('country object is immutable', function () {
    $data = new Country([
        'country_code' => 'pl',
        'country'      => 'poland',
    ]);

    $data->iso_code = 'en';
})->expectException(\InvalidArgumentException::class);
