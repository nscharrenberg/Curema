<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $fillable = [
        'send', 'date_send', 'client_id', 'prefix', 'number', 'number_format',
        'date', 'deadline', 'status', 'currency_id', 'subtotal', 'total_tax', 'total',
        'adjustment', 'discount_percentage', 'discount_type', 'discount_total', 'sales_agent',
        'include_shipping', 'show_shipping_adress_on_invoice', 'show_quantity_as', 'terms',
        'admin_note', 'client_note', 'allowed_payment_types', 'kanban_order'
    ];

    protected $dates = ['date', 'deadline', 'recurring_deadline'];

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function items() {
        return $this->hasMany('App\EstimateItem', 'estimate_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    public function agent() {
        return $this->belongsTo('App\Admin', 'sales_agent');
    }
}
