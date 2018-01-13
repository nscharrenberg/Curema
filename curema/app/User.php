<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'client_id', 'is_primary', 'firstname', 'lastname', 'phonenumber', 'title', 'active', 'profile_image', 'direction',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function client() {
        return $this->belongsTo('App\Client');
    }

    public function invoices() {
        return $this->hasMany('App\Invoice');
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function contact_moments() {
        return $this->hasMany('App\ClientContact', 'contact_id');
    }
}
