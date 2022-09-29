<?php

namespace Temidaio\ValueObjects\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('testing');
    }
}
