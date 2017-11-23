<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name', 'email', 'title', 'company', 'description', 'website' ,'phonenumber', 'country_id', 'state',
        'city', 'address', 'zipcode', 'assigned_to', 'added_by', 'status_id', 'source_id', 'last_contact', 'last_status_change',
        'lost_lead', 'public', 'default_language', 'client_id'
    ];

    protected $dates = ['last_status_change', 'last_contact'];
}
