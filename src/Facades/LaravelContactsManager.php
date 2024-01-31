<?php

namespace Inmanturbo\ContactsManager\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Inmanturbo\ContactsManager\ContactsManager
 */
class ContactsManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Inmanturbo\ContactsManager\ContactsManager::class;
    }
}
