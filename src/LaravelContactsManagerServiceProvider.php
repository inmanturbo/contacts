<?php

namespace Sellinnate\LaravelContactsManager;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Sellinnate\LaravelContactsManager\Commands\LaravelContactsManagerCommand;

class LaravelContactsManagerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-contacts-manager')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-contacts-manager_table')
            ->hasCommand(LaravelContactsManagerCommand::class);
    }
}
