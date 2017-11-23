<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContactType extends Model
{
    protected $fillable = ['name'];

    public function clientContacts() {
        return $this->hasMany('App\ClientContact', 'type_id');
    }
}
