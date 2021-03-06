<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPriority extends Model
{
    protected $fillable = ['name', 'color_code'];

    public static function getByRank($id) {
        return TicketPriority::where('id', $id)->firstOrFail();
    }

    public function tickets() {
        return $this->hasMany('App\Ticket');
    }
}
