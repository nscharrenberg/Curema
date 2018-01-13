<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = ['type_id', 'subject', 'description', 'content', 'client_id', 'start_date', 'end_date', 'sales_agent', 'currency_id', 'value', 'showToClient', 'accepted', 'response_date'];

    protected $dates =['start_date', 'end_date'];

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function type() {
        return $this->belongsTo('App\ContractType', 'type_id');
    }

    public function currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }


}
