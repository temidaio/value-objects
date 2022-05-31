<?php

declare(strict_types=1);

use Olsza\ValueObjects\Custom\Street;

test('all street data provided returning full street address', function () {
    $data = new Street([
        'prefix' => 'ul.',
        'street' => 'ulica',
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data)->toEqual('ul. ulica 21/37');
});

test('using static make method with all data returning full street address', function () {
    $data = Street::make([
        'prefix' => 'ul.',
        'street' => 'ulica',
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data)->toEqual('ul. ulica 21/37');
});

test('street data with whitespaces returning trimmed full street address', function () {
    $data = new Street([
        'prefix' => '  ul.  ',
        'street' => '  ulica  ',
        'number' => '  21  ',
        'local'  => '  37  ',
    ]);

    expect((string) $data)->toEqual('ul. ulica 21/37');
});

test('missing prefix returning partial street address', function () {
    $data = new Street([
        'street' => 'ulica',
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data)->toEqual('ulica 21/37');
});


test('missing local number returning partial street address', function () {
    $data = new Street([
        'prefix' => 'ul.',
        'street' => 'ulica',
        'number' => '21',
    ]);

    expect($data)->toEqual('ul. ulica 21');
});

test('all properties individually retrieved and returned as string', function () {
    $data = new Street([
        'prefix' => 'ul.',
        'street' => 'ulica',
        'number' => '21',
        'local'  => '37',
    ]);

    expect($data->prefix)->toEqual('ul.');
    expect($data->street)->toEqual('ulica');
    expect($data->number)->toEqual('21');
    expect($data->local)->toEqual('37');
});

test('set different values individually to each property, returning set values', function () {
    $data = new Street([
        'prefix' => '',
        'street' => 's',
        'number' => '1',
        'local'  => '',
    ]);

    $data->prefix = 'ul.';
    $data->street = 'ulica';
    $data->number = '21';
    $data->local  = '37';

    expect($data->{'prefix'})->toEqual('ul.');
    expect($data->{'street'})->toEqual('ulica');
    expect($data->{'number'})->toEqual('21');
    expect($data->{'local'})->toEqual('37');
});
