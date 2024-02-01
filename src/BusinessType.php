<?php

namespace Inmanturbo\ContactsManager;

enum BusinessType : string
{
    use ArrayableEnum;

    case Customer = 'Customer';
    case Vendor = 'Vendor';
    case Prospect = 'Prospect';
    case Account = 'Account';
}