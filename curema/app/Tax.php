<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'name', 'rate'
    ];

    public function getFullTaxAttribute()
    {
        return ucfirst($this->name) . ' ' . ucfirst($this->rate);
    }
}
