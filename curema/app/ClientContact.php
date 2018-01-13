<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $fillable = [
      'client_id', 'contact_id', 'date', 'start_time', 'end_time', 'notes', 'type_id', 'staff_id'
    ];

    protected $dates = ['date'];

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function contact() {
        return $this->belongsTo('App\User', 'contact_id');
    }

    public function type() {
        return $this->belongsTo('App\ClientContactType', 'type_id');
    }

    public function employee() {
        return $this->belongsTo('App\Admin', 'staff_id');
    }
}
