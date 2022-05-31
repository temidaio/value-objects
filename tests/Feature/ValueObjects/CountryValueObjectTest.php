<?php

declare(strict_types=1);

use Olsza\ValueObjects\Custom\Country;

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

test('set different values individually to each property, returning set values', function () {
    $data = new Country([
        'country_code' => 'pl',
        'country'      => 'poland',
    ]);

    $data->iso_code = 'en';
    $data->country = 'eng';

    expect($data->iso_code)->toEqual('EN');
    expect($data->country)->toEqual('Eng');
});
