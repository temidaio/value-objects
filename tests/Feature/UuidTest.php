<?php

namespace Olsza\ValueObjects\Tests\Feature;

use Illuminate\Support\Str;
use Olsza\ValueObjects\Complex\Uuid;
use Olsza\ValueObjects\Exceptions\InvalidUuidException;
use Olsza\ValueObjects\Tests\TestCase;

class UuidTest extends TestCase
{
    /** @test */
    public function testUuidReturnsErrorIfWrongUuidString()
    {
        $this->expectException(InvalidUuidException::class);
        new Uuid('test', 'test');
    }

    /** @test */
    public function testGetUuidReturnsFalseIfNotFound()
    {
        $result = new Uuid(Str::uuid(), 'ver');
        $this->assertNull($result->getUuidFor('test'));
    }

    /** @test */
    public function testCanGetUuidForStringName()
    {
        $uuid = (string) Str::uuid();
        $result = new Uuid($uuid, 'verification');
        $this->assertSame($uuid, $result->getUuidFor('verification'));
    }

    /** @test */
    public function testCanAddMultipleUuids()
    {
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
    }

    /** @test */
    public function testCanGetFirstUuidFromThePool()
    {
        $uuid = (string) Str::uuid();

        $object = new Uuid($uuid, 'verification');
        $object->add(Str::uuid(), 'any_other_model');
        $object->add(Str::uuid(), 'any_other_key');

        $this->assertSame($uuid, $object->first());
    }

    /** @test */
    public function testCanCastToString()
    {
        $uuid   = (string) Str::uuid();
        $string = (string) new Uuid($uuid, 'verification');
        $this->assertSame($uuid, $string);
    }
}
