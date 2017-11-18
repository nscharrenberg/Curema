<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItemTax extends Model
{
    protected $fillable = [
      'item_id', 'invoice_id', 'rate', 'name'
    ];
}
