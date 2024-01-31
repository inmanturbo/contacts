<?php

namespace Inmanturbo\ContactsManager\Database\Factories;

use Faker\Provider\it_IT\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Inmanturbo\ContactsManager\Models\Contact;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'website' => $this->faker->url,
            'logo_url' => $this->faker->imageUrl(),
            'logo_path' => $this->faker->imageUrl(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->firstName,
            'business_name' => $this->faker->company,
            'address' => $this->faker->address,
            'line_two' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip_code' => $this->faker->postcode,
            'country_code' => $this->faker->countryCode,
            'email' => $this->faker->email,
            'mobile' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'fax' => $this->faker->phoneNumber,
            'vat_number' => Company::vat(),
            'notes' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['business', 'private']),
            'user_uuid' => $this->faker->uuid,
            'team_uuid' => $this->faker->uuid,
        ];

    }
}
