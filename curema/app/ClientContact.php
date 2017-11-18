<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $fillable = [
      'client_id', 'contact_id', 'date', 'start_time', 'end_time', 'notes'
    ];

    protected $dates = ['date'];

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function contact() {
        return $this->belongsTo('App\User', 'contact_id');
    }
}
