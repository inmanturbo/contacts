<?php

// config for Sellinnate/LaravelContactsManager
return [
    'contact_types' => \Inmanturbo\ContactsManager\ContactType::toArray(),
    'features' => [
        'routes' => env('CONTACTS_MANAGER_ROUTES', false),
    ],
];
