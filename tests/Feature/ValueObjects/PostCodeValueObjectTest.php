<?php

declare(strict_types = 1);

use Temidaio\ValueObjects\PostCode;

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

test('postcode object is immutable', function () {
    $data = new PostCode([
        'postcode'     => '69-420',
        'city'         => 'krk',
        'country_code' => 'pl',
    ]);

    $data->postcode = '21-337';
})->expectException(\InvalidArgumentException::class);
