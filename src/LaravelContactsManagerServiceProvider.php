<?php

namespace Sellinnate\LaravelContactsManager;

use Sellinnate\LaravelContactsManager\Commands\LaravelContactsManagerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasMigrations('create_contacts_table', 'create_contact_lists_table', 'create_contacts_lists_contacts_pivot_table');
    }
}
