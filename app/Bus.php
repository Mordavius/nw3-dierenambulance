<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['bus_type', 'buschange_id', 'milage', 'damage', 'clean', 'damage_description'];

    // Setting the relationship between a bus and a ticket
    public function busTicket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
