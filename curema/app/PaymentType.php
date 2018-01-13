<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $fillable = [
      'name', 'description', 'show_on_pdf', 'default', 'active'
    ];
}
