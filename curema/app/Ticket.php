<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{

    protected $fillable = ['subject', 'content', 'status_id', 'priority_id', 'user_id', 'agent_id', 'category_id', 'complete'];
    public function category() {
        return $this->belongsTo('App\Department', 'category_id');
    }

    public function status() {
        return $this->belongsTo('App\TicketStatus', 'status_id');
    }

    public function priority() {
        return $this->belongsTo('App\TicketPriority', 'priority_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function agent() {
        return $this->belongsTo('App\Admin', 'agent_id');
    }

    public function summary() {
        return Str::words($this->content, $words = 10, $end = '...');
    }

    public function comments()
    {
        return $this->hasMany('App\TicketComment', 'ticket_id');
    }

    public static function rank(TicketPriority $prio) {
        return Ticket::whereNotIn('status_id', [2])->where('priority_id', $prio->id)->where('agent_id', auth()->user()->id)->get();
    }
}
