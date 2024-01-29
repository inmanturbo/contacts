<?php

namespace Sellinnate\LaravelContactsManager\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sellinnate\LaravelContactsManager\ContactType;
use Sellinnate\LaravelContactsManager\Database\Factories\ContactFactory;
use Sellinnate\LaravelContactsManager\HasParent;

class Person extends Contact
{
    use HasParent;
    use HasFactory;

    protected $guarded = [];

    public function name(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => isset($attributes['middle_name']) ? $attributes['first_name'].' '.$attributes['middle_name'].' '.$attributes['last_name'] : $attributes['first_name'].' '.$attributes['last_name'],
            set: fn ($value) => $this->splitName($value),
        );
    }

    protected function splitName(?string $value = null): ?array
    {
        if (!$value) {
            return null;
        }
    
        $names = explode(' ', $value, 3); // Split into 2 parts at most to handle middle names

        return [
            'first_name' => $names[0] ?? null,
            'middle_name' => $names[1] ?? null,
            'last_name' => $names[2] ?? null,
        ];
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ContactFactory::new([
            'type' => ContactType::private->name
        ]);
    }
}
