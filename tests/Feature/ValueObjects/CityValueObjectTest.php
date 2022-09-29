<?php

declare(strict_types = 1);

use Temidaio\ValueObjects\City;

test('all city data provided as string returning city name', function() {
    $data = new City([
        'city'         => 'kr',
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('kr');
});

test('city data with whitespaces returning trimmed city name', function() {
    $data = new City([
        'city'         => '   kr    ',
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('kr');
});

test('providing city name only returning city name', function() {
    $data = new City([
        'city' => 'kr',
    ]);

    expect($data)->toEqual('kr');
});

test('providing country only returning empty string', function() {
    $data = new City([
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('');
});

test('using static make method with all data returning city name', function() {
    $data = City::make([
        'city'         => 'kr',
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('kr');
});

test('city name property retrieved and returned as string', function() {
    $data = new City([
        'city'         => 'kr',
        'country_code' => 'pl',
    ]);

    expect($data->city)->toEqual('kr');
});

test('city nobject is immutable', function() {
    $data = new City([
        'city'         => 'kr',
        'country_code' => 'pl',
    ]);

    $data->city = 'waw';
})->expectException(\InvalidArgumentException::class);
