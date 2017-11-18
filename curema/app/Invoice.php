<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'send', 'date_send', 'client_id', 'prefix', 'number', 'number_format',
        'date', 'deadline', 'status', 'currency_id', 'subtotal', 'total_tax', 'total',
        'adjustment', 'last_overdue_reminder', 'cancel_overdue_reminder', 'discount_percentage',
        'discount_type', 'discount_total', 'recurring', 'custom_recurring', 'recurring_type', 'recurring_deadline',
        'is_recurring_from', 'last_recurring_date', 'sales_agent', 'include_shipping', 'show_shipping_adress_on_invoice',
        'show_quantity_as', 'terms', 'admin_note', 'client_note', 'allowed_payment_types'
    ];

    protected $dates = ['date', 'deadline', 'recurring_deadline'];

    public function client() {
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function payment_types() {
        return $this->hasMany('App\PaymentType', 'id');
    }

    public function items() {
        return $this->hasMany('App\InvoiceItem', 'invoice_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    public function agent() {
        return $this->belongsTo('App\Admin', 'sales_agent');
    }
}
