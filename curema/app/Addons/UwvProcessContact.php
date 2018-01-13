<?php

namespace App\Addons;

use Illuminate\Database\Eloquent\Model;

class UwvProcessContact extends Model
{
    protected $fillable = ['process_id', 'contact_id'];

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($process) {
            foreach($process->contacts as $contact) {
                $contact->delete();
            }
        });
    }
}
