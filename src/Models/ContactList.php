<?php

namespace Sellinnate\LaravelContactsManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User;

class ContactList extends Model
{
    protected $table = 'contact_lists';

    protected $fillable = ['name', 'user_id'];

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
}
