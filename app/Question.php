<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Answer;

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
    * Méthode answers () relation entre les tables questions et answers
    * Ici une question a plusieurs réponses
    *
    * @return $this->hasMany(Answer::class);
    **/
    public function answers ()
    {
        return $this->hasMany(Answer::class);
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

    /**
     * Méthode getUrlAttribute () accesseur pour l'url
     *
     * return route("questions.show", $this->id);
     **/
    public function getUrlAttribute ()
    {
        return route("questions.show", $this->slug);
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

    /**
    	* Méthode getStatusAttribute () accesseur pour le statut des questions
    	*
    	*
    	* return "answered_accepted"; return "answered";
    **/
    public function getStatusAttribute ()
    {
        if ($this->answers_count > 0) {
            if ($this->best_answer_id) {
                return "answered_accepted";
            }
            return "answered";
        }
        return "unanswered";
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
     * Méthode acceptBestAnswer () pour la méthode __invoke () du contrôleur AcceptAnswerController.php
     *
     * @param Answer $answer
     **/
    public function acceptBestAnswer (Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();
    }
}
