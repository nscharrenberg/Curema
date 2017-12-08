<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    protected $fillable = ['content', 'user_id', 'ticket_id'];

    public function ticket()
    {
        return $this->belongsTo('App\Ticket', 'ticket_id');
    }

    public function user() {
            return $this->belongsTo('App\User', 'user_id');
    }

    public function agent() {
        return $this->belongsTo('App\Admin', 'user_id');
    }
}
