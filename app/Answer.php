<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\User;

class Answer extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body', 'user_id'
    ];

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
     * Méthode static boot () permet à chaque fois qu'une réponse est créée d'ncrémenter le compteur de réponse
     * Pas la peine d'enregistrer la réponse ($answer->question->save()),
     * elle se fait automatiquement par Laravel avec la méthode increment ()
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

        static::deleted(function ($answer) {
            $answer->question->decrement('answers_count');
        });
    }

    /**
     * Méthode getCreatedDateAttribute () accesseur pour la date créée
     *
     * @return $this->created_at->diffForHumans();
     **/
    public function getCreatedDateAttribute ()
    {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        return $this->id === $this->question->best_answer_id ? 'vote-accepted' : '';
    }
}
