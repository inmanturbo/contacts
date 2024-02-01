<?php

return [
    'contact_types' => \Inmanturbo\ContactsManager\ContactType::toArray(),
    'features' => [
        'ui' => [
            'enabled' => env('CONTACTS_MANAGER_UI', false),
            'middleware' => ['web'],
            'theme' => 'embedded',
        ],
    ],
];
