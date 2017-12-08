<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['subject', 'content', 'showToClients', 'showToStaff', 'showMyName', 'admin_id', 'dismissed'];

    public function admin() {
        return $this->belongsTo('App\Admin', 'admin_id');
    }
}
