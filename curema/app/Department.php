<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'color_code'];

    public function agents() {
        return $this->belongsToMany('App\Admin', 'admin_departments', 'department_id', 'admin_id')->where('agent', '1');
    }
}
