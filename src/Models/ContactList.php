<?php

namespace Sellinnate\LaravelContactsManager\Models;

use Illuminate\Database\Eloquent\Model;

class ContactList extends Model {

    protected $table = 'contact_lists';

    protected $fillable = ['name'];

    public function contacts() {
        return $this->belongsToMany(Contact::class, 'contact_lists_contacts');
    }

}
