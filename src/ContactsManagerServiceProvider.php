<?php

namespace Inmanturbo\ContactsManager;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\File;
use Laravel\Folio\Folio;
use Livewire\Volt\Volt;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ContactsManagerServiceProvider extends PackageServiceProvider
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
            ->hasViews('contacts')
            ->hasRoute('web')
            ->hasMigrations(
                'create_contacts_table',
                'create_contact_lists_table',
                'create_contacts_lists_contacts_pivot_table',
                'create_tags_table',
                'create_taggables_table'
            )
            ->runsMigrations();
    }

    public function packageBooted()
    {
        if($this->app->config['contacts-manager.features.ui.enabled']) {
            $this->configureUi();
        }
    }

    protected function configureUi()
    {
        foreach (File::glob(__DIR__.'/../resources/views/pages/[0-9]*', GLOB_ONLYDIR) as $version) {
            $version = basename($version);
            Folio::path(__DIR__.'/../resources/views/pages/'.$version)
                ->uri('/contacts/v'.$version)
                ->middleware(config('contacts-manager.features.ui.middleware', ['web']));
        }

        $this->app->booted(function () {
            /** @var Router $router */
            $router = $this->app['router'];
            $router->pushMiddlewareToGroup('web', NavigationMiddleware::class);

            $voltPaths = collect(Volt::paths())->map(function ($path) {
                return $path->path;
            })->toArray();

            $paths = array_merge($voltPaths, [
                __DIR__.'/../resources/views/livewire',
                __DIR__.'/../resources/views/pages',
            ]);

            Volt::mount($paths);
        });
    }
}
