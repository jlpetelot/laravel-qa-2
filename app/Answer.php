<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\User;

class Answer extends Model
{

    /**
    * Méthode question () relation entre les tables answers et questions
    * Ici une réponse appartient a une seule question
    * 
    * @return $this->belongsTo(Question::class);;
    **/
    public function question ()
    {
        return $this->belongsTo(Question::class);
    }

     /**
    * Méthode user () relation entre les tables answers et users
    * Ici une réponse appartient a un seul user
    * 
    * @return $this->belongsTo(User::class);;
    **/
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
    * Méthode getBodyHtmlAttribute () accesseur pour le formatage markdown HTML des body
    *
    * @return \Parsedown::instance()->text($this->body);
    **/
    public function getBodyHtmlAttribute ()
    {
        return \Parsedown::instance()->text($this->body);
    }

    /**
     * Méthode statique boot () accesseur pour le formatage markdown HTML des body
     *
     * @param $answer
     * @return void
     **/
    public static function boot ()
    {
        parent::boot();

        static::created(function ($answer) {
            $answer->question->increment('answers_count');
            // $answer->question->save();
        });
    }
}
