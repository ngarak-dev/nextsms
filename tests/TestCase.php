<?php

namespace NgarakDev\NextSMS\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use NgarakDev\NextSMS\NextSMSServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'NgarakDev\\NextSMS\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            NextSMSServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-nextsms_table.php.stub';
        $migration->up();
        */
    }
}