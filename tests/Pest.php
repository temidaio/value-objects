<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is 'PHPUnit\Framework\TestCase'. Of course, you may
| need to change it using the 'uses()' function to bind a different classes or traits.
|
*/

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Olsza\ValueObjects\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(fn () => Http::preventStrayRequests())
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| 'expect()' function gives you access to a set of 'expectations' methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

expect()->extend('toBeModel', function () {
    return $this->toBeInstanceOf(Model::class);
});

/*
|--------------------------------------------------------------------------
| Global test functions
|--------------------------------------------------------------------------
*/

//
