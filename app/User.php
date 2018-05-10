<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'name', 'email', 'password','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Check if a user is administrator
    public function isAdmin()
    {
        if($this->role->name == 'Administrator') {
            return true;
        }
        return false;
        // return $this->where('id', '=', Auth::user()->id)->where('role', '=', '1')->exists();
    }

    public function isCentralist()
    {
        if($this->role->name == 'Centralist') {
            return true;
        }
        return false;
        // return $this->where('id', '=', Auth::user()->id)->where('role', '=', '1')->exists();
    }

    public function isAmbulance()
    {
        if($this->role->name == 'Ambulance Medewerker') {
            return true;
        }
        return false;
        // return $this->where('id', '=', Auth::user()->id)->where('role', '=', '1')->exists();
    }

    public function role() {

        return $this->belongsTo('App\Role');
    }
}
