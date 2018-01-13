<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    protected $fillable = ['name', 'color_code', 'order', 'default'];
}
