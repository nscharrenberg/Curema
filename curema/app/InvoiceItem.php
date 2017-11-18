<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id', 'name', 'description', 'quantity', 'rate', 'unit'
    ];

    public function invoice() {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }

    public function tax() {
        return $this->hasMany('App\InvoiceItemTax', 'item_id');
    }
}
