<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['bus_type', 'buschange_id', 'milage'];

    // Setting the relationship between a bus and a ticket
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
