<?php

namespace Sellinnate\LaravelContactsManager;

trait ArrayableEnum
{
    public static function toArray(): array
    {
        // programatically return associative array of enum cases
        return array_column(self::cases(), 'value', 'name');
    }
}
