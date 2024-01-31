<?php

namespace Inmanturbo\ContactsManager;

enum ContactType: string
{
    use ArrayableEnum;
    use HasEloquentModelableValue;

    case private = Models\Person::class;
    case business = Models\Business::class;
}
