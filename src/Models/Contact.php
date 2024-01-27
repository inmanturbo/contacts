<?php

namespace Sellinnate\LaravelContactsManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User;
use Sellinnate\LaravelContactsManager\HasChildren;

class Contact extends Model
{
    use HasChildren;
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'website',
        'logo_url',
        'logo_path',
        'first_name',
        'last_name',
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
        'user_id',
        'team_uuid',
    ];

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
