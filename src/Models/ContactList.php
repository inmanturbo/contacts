<?php

namespace Inmanturbo\ContactsManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User;

class ContactList extends Model
{
    protected $table = 'contact_lists';

    protected $fillable = ['name', 'user_id'];

    /*
     * RELATIONS
     */

    public function contacts()
    {
        return $this->belongsToMany(Contact::class, 'contact_lists_contacts');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /*
     * UTILS
     */

    public function toEmailsArray()
    {
        return collect($this->contacts)->map(function (Contact $contact) {
            return $contact->email;
        })->reject(function ($email) {
            return $email == '' || is_null($email);
        })->toArray();
    }

    public function toNamesArray()
    {
        return collect($this->contacts)->map(function (Contact $contact) {
            return $contact->name;
        })->reject(function ($name) {
            return $name == '' || is_null($name);
        })->toArray();
    }
}
