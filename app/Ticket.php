<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = [ 'priority', 'bus_id' , 'animal_id', 'payment_invoice', 'payment_method', 'payment_gift', 'date','time', 'centralist',
    'reporter_name', 'telephone', 'driver', 'passenger'];

    // Tickets could have many destinations
    public function destinations()
    {
       return $this->hasMany('App\Destination');
    }

	public function mainDestination()
	{
		return $this->hasMany('App\Destination')->first();
	}

    // Tickets could only have one animal
    public function animal()
    {
        return $this->hasOne('App\Animal');
    }

    // Tickets could only have one bus
    public function bus()
    {
        return $this->belongsTo('App\Bus');
    }

    public function owner() {
    	return $this->hasOne('App\Owner');
    }

    /**
     * @param $query
     * @param $search
     */
}
