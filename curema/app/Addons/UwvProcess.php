<?php

namespace App\Addons;

use Illuminate\Database\Eloquent\Model;

class UwvProcess extends Model
{
    protected $fillable = ['ordernr', 'start_date', 'end_date', 'client_id', 'uwv_service_id'];
    protected $dates = ['start_date', 'end_date'];

    public function service() {
        return $this->belongsTo('App\Addons\UwvService', 'uwv_service_id');
    }

    public function client() {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function contacts() {
        return $this->belongsToMany('App\Addons\UwvContact', 'uwv_process_contacts', 'process_id', 'contact_id');
    }
}
