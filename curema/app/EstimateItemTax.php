<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimateItemTax extends Model
{
    protected $fillable = [
        'item_id', 'estimate_id', 'rate', 'name'
    ];
}
