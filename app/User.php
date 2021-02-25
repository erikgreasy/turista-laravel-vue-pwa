<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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


    public function trips() {
        return $this->hasMany( 'App\Trip' );
    }

    public function wishlists() {
        return $this->hasMany( 'App\UserHillWishlist' );
    }

    public function isInWishlist( $hill_id ) {
        if( !empty( $this->getUserwishlist( $hill_id ) ) ) {
            return true;
        }

        return false;
    }

    public function getUserwishlist( $hill_id ) {
        $userwishlist = UserHillWishlist::where( 'hill_id', $hill_id )->where( 'user_id', $this->id )->get();
        return $userwishlist;
    }

}
