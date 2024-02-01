<?php

namespace Inmanturbo\ContactsManager\Database\Factories;

use Faker\Provider\it_IT\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Inmanturbo\ContactsManager\BusinessDirectory;
use Inmanturbo\ContactsManager\BusinessType;
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
            'slug' => $this->faker->slug,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->firstName,
            'business_name' => $this->faker->company,
            'business_branch' => $this->faker->companySuffix,
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
            'business_type' => $this->faker->randomElement(BusinessType::cases()),
            'directory' => $this->faker->randomElement(BusinessDirectory::cases()),
            'referred_by' => $this->faker->name,
            'use_accounts' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
            'send_newsletter' => $this->faker->boolean,
            'user_uuid' => $this->faker->uuid,
            'team_uuid' => $this->faker->uuid,
        ];

    }
}
