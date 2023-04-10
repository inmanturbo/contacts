<?php

namespace Sellinnate\LaravelContactsManager\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Sellinnate\LaravelContactsManager\LaravelContactsManagerServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Sellinnate\\LaravelContactsManager\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelContactsManagerServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_contacts_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_contact_lists_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_contact_lists_contacts_pivot_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_tags_table.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_taggables_table.php';
        $migration->up();

    }
}
