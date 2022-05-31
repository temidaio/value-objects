<?php

namespace Olsza\ValueObjects\Tests\Feature\ValueObjects;

use Illuminate\Support\Str;
use Olsza\ValueObjects\Complex\Uuid;
use Olsza\ValueObjects\Exceptions\InvalidUuidException;

test('uuid returns error if wrong uuid string', function () {
    $this->expectException(InvalidUuidException::class);
    new Uuid('test', 'test');
});

test('get uuid returns false if not found', function () {
    $result = new Uuid(Str::uuid(), 'ver');
    $this->assertNull($result->getUuidFor('test'));
});

test('can get uuid for string name', function () {
    $uuid = (string) Str::uuid();
    $result = new Uuid($uuid, 'verification');
    $this->assertSame($uuid, $result->getUuidFor('verification'));
});

test('can add multiple uuids', function () {
    $uuid = (string) Str::uuid();

    $object = new Uuid($uuid, 'verification');
    $object->add($uuid, 'any_other_model');
    $object->add($uuid, 'any_other_key');

    $this->assertIsArray($object->uuids);
    $this->assertArrayHasKey('verification', $object->uuids);
    $this->assertArrayHasKey('any_other_model', $object->uuids);
    $this->assertArrayHasKey('any_other_key', $object->uuids);
    $this->assertSame($uuid, $object->uuids['verification']);
    $this->assertSame($uuid, $object->uuids['any_other_model']);
    $this->assertSame($uuid, $object->uuids['any_other_key']);
});

test('can get first uuid from the pool', function () {
    $uuid = (string) Str::uuid();

    $object = new Uuid($uuid, 'verification');
    $object->add(Str::uuid(), 'any_other_model');
    $object->add(Str::uuid(), 'any_other_key');

    $this->assertSame($uuid, $object->first());
});

test('can cast uuid to string', function () {
    $uuid   = (string) Str::uuid();
    $string = (string) new Uuid($uuid, 'verification');
    $this->assertSame($uuid, $string);
});
