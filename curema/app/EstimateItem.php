<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimateItem extends Model
{
    protected $fillable = [
        'estimate_id', 'name', 'description', 'quantity', 'rate', 'unit'
    ];

    public function estimate() {
        return $this->belongsTo('App\Estimate', 'estimate_id');
    }

    public function tax() {
        return $this->hasMany('App\EstimateItemTax', 'item_id');
    }
}
