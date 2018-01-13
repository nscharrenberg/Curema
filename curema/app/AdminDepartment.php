<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminDepartment extends Model
{
    protected $fillable = ['department_id', 'admin_id'];
    public $timestamps = false;

    public function  departments() {
        return $this->belongsTo('App\Department', 'department_id');
    }
}
