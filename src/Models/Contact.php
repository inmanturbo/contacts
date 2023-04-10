<?php

namespace Sellinnate\LaravelContactsManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'zip_code',
        'country_code',
        'email',
        'mobile',
        'phone',
        'mobile',
        'vat_number',
        'notes',
        'type',
    ];

    public function getNameAttribute()
    {
        if ($this->type == 'business') {
            return $this->business_name;
        }

        return $this->first_name.' '.$this->last_name;
    }

    public function lists()
    {
        return $this->belongsToMany(ContactList::class, 'contact_lists_contacts');
    }
}
