<?php

namespace Sellinnate\LaravelContactsManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Sellinnate\LaravelContactsManager\LaravelContactsManager
 */
class LaravelContactsManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Sellinnate\LaravelContactsManager\LaravelContactsManager::class;
    }
}
