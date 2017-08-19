<?php

namespace App\Domains\Users;

use App\Notifications\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

//use Illuminate\Contracts\Auth\CanResetPassword;
//use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * @var Url path to spa reset link
     */
    public static $resetPasswordRoute;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isAdmin'
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $link = str_replace('{token}', $token, self::$resetPasswordRoute);

        $this->notify(new ResetPassword($link));
    }

    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdminStr() {
        return $this->isAdmin? 'Sim': 'Não';
    }
}
