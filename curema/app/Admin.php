<?php

namespace App;

use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'phonenumber', 'facebook', 'linkedin', 'skype', 'admin', 'is_not_staff', 'role', 'default_language', 'media_path_slug', 'hourly_rate', 'email_signature', 'active', 'profile_image', 'direction', 'agent'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }

    public function language() {
        return $this->hasOne('App\Language', 'default_language');
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->firstname) . ' ' . ucfirst($this->lastname);
    }

    public function invoices() {
        return $this->hasMany('App\Invoice', 'sales_agent');
    }

    public static function isAgent($id = null)
    {
        if (isset($id)) {
            $agent = Admin::find($id);
            if ($agent->agent) {
                return true;
            }

            return false;
        }

        if (auth()->check()) {
            if (auth()->admin()->agent) {
                return true;
            }
        }
    }

    public static function isAdmin() {
        return auth()->check() && auth()->admin()->agent;
    }

    public function departments() {
        return $this->belongsToMany('App\Department', 'admin_departments', 'admin_id', 'department_id');
    }
}
