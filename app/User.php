<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Méthode questions () pour la relation entre les tables users et questions
     * Ici, un user peut avoir plusieurs questions
     *
     * return $this->hasMany(Question::class);
     **/
    public function questions ()
    {
        return $this->hasMany(Question::class);
    }

    /**
     * Méthode getUrlAttribute () accesseur pour l'url
     *
     * @return route("questions.show", $this->id);
     **/
    public function getUrlAttribute ()
    {
        // return route("questions.show", $this->id);
        return "#";
    }

    /**
     * Méthode getAvatarAttribute () accesseur pour l'avatar des users
     *
     * @return $this->created_at->diffForHumans();
     **/
    public function getAvatarAttribute ()
    {

        $email = $this->email;
        $size = 32;
        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
}