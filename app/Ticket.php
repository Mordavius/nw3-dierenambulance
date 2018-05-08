<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    protected $fillable = ['destination_id', 'animal_id', 'bus_id', 'finance_id', 'date','time', 'centralist', 'reporter_name', 'telephone', 'driver', 'passenger', 'finished'];


    public function destination()
    {
        return $this->hasMany('App\Destination');
    }

    public function animal()
    {
        return $this->hasOne('App\Animal');
    }

    public function bus()
    {
        return $this->hasOne('App\Bus');
    }
    /**
     * @param $query
     * @param $search
     */
}
