<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['category_id', 'name', 'note', 'number', 'prefix', 'amount', 'tax_percentage', 'currency_id', 'client_id', 'invoice_id', 'date'];

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    public function invoice() {
        return $this->belongsTo('App\Invoice', 'invoice_id');
    }

    public function category() {
        return $this->belongsTo('App\ExpenseCategory', 'category_id');
    }
}
