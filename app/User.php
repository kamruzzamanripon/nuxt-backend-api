<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        //return the primary key of the user - user ID
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        //return a key value array, containing any custom claims to be added to jwt
        return [];
    }

    //Policy Function
    public function ownTopic(Topic $topic)
    {
        return $this->id === $topic->user->id;
    }

    public function ownPost(Post $post)
    {
        return $this->id === $post->user->id;
    }

    public function hasLikedPost(Post $post)
    {
        return $post->likes()->where('user_id', $this->id)->count() === 1;
    }
}
