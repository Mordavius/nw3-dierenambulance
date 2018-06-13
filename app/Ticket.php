<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = [ 'priority', 'bus_id' , 'animal_id', 'finance_id', 'date','time', 'centralist',
    'reporter_name', 'telephone', 'driver', 'passenger'];

    // Tickets could have many destinations
    public function destination()
    {
        //return $this->belongsTo('App\Destination', 'ticket_id', 'id');
       return $this->hasMany('App\Destination');
    }

    // Tickets could only have one animal
    public function animal()
    {
        return $this->hasOne('App\Animal');
    }

    // Tickets could only have one bus
    public function bus()
    {
        return $this->hasOne('App\Bus');
    }

    public function scopeSearch($query, $search)
    {
        // Search function for searching on destinations
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('city', 'LIKE', "%{$search}%");
            });
        }
    }
    /**
     * @param $query
     * @param $search
     */
}
