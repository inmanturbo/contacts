<?php

namespace Inmanturbo\ContactsManager\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User;
use Inmanturbo\ContactsManager\BusinessDirectory;
use Inmanturbo\ContactsManager\BusinessType;
use Inmanturbo\ContactsManager\Database\Factories\ContactFactory;
use Inmanturbo\ContactsManager\HasChildren;

class Contact extends Model
{
    use HasChildren;
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'website',
        'logo_url',
        'logo_path',
        'slug',
        'first_name',
        'middle_name',
        'last_name',
        'business_name',
        'business_branch',
        'address',
        'line_two',
        'city',
        'state',
        'zip_code',
        'country_code',
        'email',
        'mobile',
        'phone',
        'fax',
        'vat_number',
        'notes',
        'type',
        'business_type',
        'directory',
        'referred_by',
        'use_accounts',
        'is_active',
        'send_newsletter',
        'user_id',
        'team_uuid',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'send_newsletter' => 'boolean',
        'business_type' => BusinessType::class,
        'directory' => BusinessDirectory::class,
    ];

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): Factory
    {
        return ContactFactory::new();
    }

    public function getChildTypes()
    {
        return config('contacts-manager.contact_types');
    }

    /*
     * ACCESSORS
     */

    public function getNameAttribute()
    {
        if ($this->type == 'business') {
            return $this->business_name;
        }

        return $this->first_name.' '.$this->last_name;
    }

    /*
     * RELATIONS
     */

    public function lists()
    {
        return $this->belongsToMany(ContactList::class, 'contact_lists_contacts');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
