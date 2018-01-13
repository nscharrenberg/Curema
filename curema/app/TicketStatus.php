<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $fillable = ['name', 'color_code'];

    public function tickets() {
        return $this->hasMany('App\Ticket');
    }
}
