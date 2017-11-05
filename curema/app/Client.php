<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'company', 'vat', 'phonenumber', 'country_id', 'city', 'zipcode', 'state', 'address', 'website', 'active', 'lead_id',
        'billing_country_id', 'billing_address', 'billing_city', 'billing_state', 'billing_zipcode',
        'shipping_country_id', 'shipping_address', 'shipping_city', 'shipping_state', 'shipping_zipcode',
        'longitude', 'latitude', 'default_language', 'currency_id', 'primary_contact_id'
    ];

    public function users() {
        return $this->hasMany('App\User');
    }

    public function user() {
        return $this->belongsTo('App\User', 'primary_contact_id');
    }

    public function country() {
        return $this->belongsTo('App\Country', 'country_id');
    }
}
