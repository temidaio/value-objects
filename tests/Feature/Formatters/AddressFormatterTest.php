<?php

declare(strict_types=1);

use Temidaio\ValueObjects\Formatters\AddressFormatter;

$street   = 'ul. Street 21/37';
$country  = 'Poland';
$postcode = '69-420';
$city     = 'Warsaw';

test('returns full address', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'   => $street,
        'postcode' => $postcode,
        'city'     => $city,
        'country'  => $country,
    ]);

    expect($data)->toEqual('ul. Street 21/37, 69-420 Warsaw Poland');
});

test('returns full address with country iso code', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'   => $street,
        'postcode' => $postcode,
        'city'     => $city,
        'iso_code' => 'PL',
    ]);

    expect($data)->toEqual('ul. Street 21/37, 69-420 Warsaw PL');
});

test('missing street returns partial address', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'postcode' => $postcode,
        'city'     => $city,
        'country'  => $country,
    ]);

    expect($data)->toEqual('69-420 Warsaw Poland');
});

test('missing postcode returining partial address', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'  => $street,
        'city'    => $city,
        'country' => $country,
    ]);

    expect($data)->toEqual('ul. Street 21/37, Warsaw Poland');
});

test('returns partial address with missing city', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'   => $street,
        'postcode' => $postcode,
        'country'  => $country,
    ]);

    expect($data)->toEqual('ul. Street 21/37, 69-420 Poland');
});

test('returns partial address with missing country', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'   => $street,
        'postcode' => $postcode,
        'city'     => $city,
    ]);

    expect($data)->toEqual('ul. Street 21/37, 69-420 Warsaw');
});

test('returns partial address with missing street & postcode', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'city'    => $city,
        'country' => $country,
    ]);

    expect($data)->toEqual('Warsaw Poland');
});

test('returns partial address with missing postcode & city', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'  => $street,
        'country' => $country,
    ]);

    expect($data)->toEqual('ul. Street 21/37, Poland');
});

test('returns partial address with missing city & country', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street'   => $street,
        'postcode' => $postcode,
    ]);

    expect($data)->toEqual('ul. Street 21/37, 69-420');
});

test('returns partial address with only country passed', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'country' => $country,
    ]);

    expect($data)->toEqual('Poland');
});

test('returns partial address with only street passed', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, [
        'street' => $street,
    ]);

    expect($data)->toEqual('ul. Street 21/37');
});

test('returns empty string address of all keys is missing', function () use ($street, $postcode, $city, $country) {
    $data = format(AddressFormatter::class, []);

    expect($data)->toEqual('');
});
