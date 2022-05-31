<?php

declare(strict_types = 1);

use Olsza\ValueObjects\Custom\Address;
use Olsza\ValueObjects\Custom\City;
use Olsza\ValueObjects\Custom\Country;
use Olsza\ValueObjects\Custom\PostCode;
use Olsza\ValueObjects\Custom\Street;

$street = new Street([
    'prefix' => 'ul.',
    'street' => 'ulica',
    'number' => '21',
    'local'  => '37',
]);

$postcode = new PostCode([
    'postcode' => '69-420',
]);

$city = new City([
    'city' => 'krk',
]);

$country = new Country([
    'country' => 'pl',
]);

test('all data provided returning full address', function() use ($street, $postcode, $city, $country) {
    $data = new Address([
        'street'   => (string) $street,
        'postcode' => (string) $postcode,
        'city'     => (string) $city,
        'country'  => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, 69-420 krk Pl');
});

test('postcode property retrieved and returned as string', function() use ($street, $postcode, $city, $country) {
    $data = new Address([
        'street'   => (string) $street,
        'postcode' => (string) $postcode,
        'city'     => (string) $city,
        'country'  => (string) $country,
    ]);

    expect($data->postcode)->toEqual('69-420');
});

test('static make method used and string address returned', function() use ($street, $postcode, $city, $country) {
    $data = Address::make([
        'street'   => (string) $street,
        'postcode' => (string) $postcode,
        'city'     => (string) $city,
        'country'  => (string) $country,
    ]);

    expect((string) $data)->toEqual('ul. ulica 21/37, 69-420 krk Pl');
});

test('missing post returning partial address', function() use ($street, $city, $country) {
    $data = new Address([
        'street'  => (string) $street,
        'city'    => (string) $city,
        'country' => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, krk Pl');
});

test('missing country returning partial address', function() use ($street, $postcode, $city) {
    $data = new Address([
        'street'   => (string) $street,
        'postcode' => (string) $postcode,
        'city'     => (string) $city,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, 69-420 krk');
});

test('missing street returning partial address', function() use ($postcode, $city, $country) {
    $data = new Address([
        'postcode' => (string) $postcode,
        'city'     => (string) $city,
        'country'  => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('69-420 krk Pl');
});

test('missing city returning partial address', function() use ($street, $postcode, $country) {
    $data = new Address([
        'street'   => (string) $street,
        'postcode' => (string) $postcode,
        'country'  => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, 69-420 Pl');
});

test('providing city, country returning partial address', function() use ($city, $country) {
    $data = new Address([
        'city'    => (string) $city,
        'country' => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('krk Pl');
});

test('providing post, country returning partial address', function() use ($postcode, $country) {
    $data = new Address([
        'postcode' => (string) $postcode,
        'country'  => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('69-420 Pl');
});

test('providing post, city returning partial address', function() use ($postcode, $city) {
    $data = new Address([
        'postcode' => (string) $postcode,
        'city'     => (string) $city,
    ]);

    expect($data->getFullAddress())->toEqual('69-420 krk');
});

test('providing street, country returning partial address', function() use ($street, $country) {
    $data = new Address([
        'street'  => (string) $street,
        'country' => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, Pl');
});

test('providing street, city returning partial address', function() use ($street, $city) {
    $data = new Address([
        'street' => (string) $street,
        'city'   => (string) $city,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, krk');
});

test('providing street, post returning partial address', function() use ($street, $postcode) {
    $data = new Address([
        'street'   => (string) $street,
        'postcode' => (string) $postcode,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37, 69-420');
});

test('providing street returning partial address', function() use ($street) {
    $data = new Address([
        'street' => (string) $street,
    ]);

    expect($data->getFullAddress())->toEqual('ul. ulica 21/37');
});

test('providing postcode returning partial address', function() use ($postcode) {
    $data = new Address([
        'postcode' => (string) $postcode,
    ]);

    expect($data->getFullAddress())->toEqual('69-420');
});

test('providing city returning partial address', function() use ($city) {
    $data = new Address([
        'city' => (string) $city,
    ]);

    expect($data->getFullAddress())->toEqual('krk');
});

test('providing country returning partial address', function() use ($country) {
    $data = new Address([
        'country' => (string) $country,
    ]);

    expect($data->getFullAddress())->toEqual('Pl');
});

test('can set property individually', function() use ($street, $postcode, $city, $country) {
    $data = new Address([
        'postcode' => (string) $postcode,
    ]);

    $data->postcode = new PostCode(['postcode' => '69-1337']);

    expect($data->getFullAddress())->toEqual('69-1337');
});
