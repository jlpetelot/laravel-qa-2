<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    /**
     * Méthode user () pour la relation entre les tables questions et users
     * Ici, une question appartient à un seul user
     *
     * return $this->belongsTo(User::class);
     **/
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Méthode setTitleAttribute () pour le mutator du slug
     *
     * @param
     * @return
     **/
    public function setTitleAttribute ($value)
    {
        $this->attributes['title'] = $value;
        // $this->attributes['slug'] = str_slug($value);
        $this->attributes['slug'] = Str::slug($value);
    }
}
