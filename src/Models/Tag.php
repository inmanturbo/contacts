<?php

namespace Sellinnate\LaravelContactsManager\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name', 'user_id'];

    /**
     * Get all of the contacts that are assigned this tag.
     */
    public function contacts(): MorphToMany
    {
        return $this->morphedByMany(Contact::class, 'taggable');
    }

    /**
     * Get all of the contactlists that are assigned this tag.
     */
    public function contactLists(): MorphToMany
    {
        return $this->morphedByMany(ContactList::class, 'taggable');
    }
}
