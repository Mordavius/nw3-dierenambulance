<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = [ 'priority', 'bus_id' , 'animal_id', 'invoice', 'payment_method_invoice', 'gift', 'payment_method_gift', 'date','time', 'centralist',
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

    /**
     * @param $query
     * @param $search
     */
}
