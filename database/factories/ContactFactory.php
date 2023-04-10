<?php

namespace Sellinnate\LaravelContactsManager\Database\Factories;

use Faker\Provider\it_IT\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Sellinnate\LaravelContactsManager\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'business_name' => $this->faker->company,
            'address' => $this->faker->address,
            'zip_code' => $this->faker->postcode,
            'country_code' => $this->faker->countryCode,
            'email' => $this->faker->email,
            'mobile' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'vat_number' => Company::vat(),
            'notes' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['business', 'private']),
            'user_id' => 1,
        ];

    }
}
