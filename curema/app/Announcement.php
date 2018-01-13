<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['subject', 'content', 'showToClients', 'showToStaff', 'showMyName', 'admin_id', 'dismissed'];

    public function admin() {
        return $this->belongsTo('App\Admin', 'admin_id');
    }

    public static function user_announcements() {
        return Announcement::where('dismissed', false)->where('showToClients', true)->simplepaginate(1);
    }

    public static function staff_announcements() {
        return Announcement::where('dismissed', false)->where('showToStaff', true)->simplepaginate(1);
    }
}
