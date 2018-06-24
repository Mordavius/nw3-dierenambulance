<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // Set the columns for storing data in the database
    protected $fillable = [
        'name', 'email', 'password','role_id', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {

        return $this->belongsTo('App\Role');
    }
    // Check if a user is Administrator
    public function isAdmin()
    {
        return $this->role()->where('name', 'Administrator')->exists();
    }
    // Check if a user is Centralist
    public function isCentralist()
    {
        return $this->role()->where('name', 'Centralist')->exists();
    }
    // Check if a user is Ambulance worker
    public function isAmbulance()
    {
        return $this->role()->where('name', 'Ambulance Medewerker')->exists();
    }


}
