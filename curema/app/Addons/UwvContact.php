<?php

namespace App\Addons;

use Illuminate\Database\Eloquent\Model;

class UwvContact extends Model
{
    protected $fillable = ['firstname', 'lastname', 'email', 'phonenumber'];

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }
}
