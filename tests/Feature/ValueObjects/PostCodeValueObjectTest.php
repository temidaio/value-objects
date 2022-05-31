<?php

declare(strict_types = 1);

use Olsza\ValueObjects\Custom\PostCode;

test('all postcode data provided returning as string', function() {
    $data = new PostCode([
        'postcode'     => '69-420',
        'city'         => 'krk',
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('69-420');
});

test('using static make method with all data returning postcode', function() {
    $data = PostCode::make([
        'postcode'     => '69-420',
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('69-420');
});

test('postcode data with whitespaces returning as trimmed string', function() {
    $data = new PostCode([
        'postcode'     => '                  69-420 ',
        'country_code' => 'pl',
    ]);

    expect($data)->toEqual('69-420');
});

test('set postcode individually, returning set value', function () {
    $data = new PostCode([
        'postcode'     => '69-420',
        'city'         => 'krk',
        'country_code' => 'pl',
    ]);

    $data->postcode = '21-337';

    expect($data->postcode)->toEqual('21-337');
});
