<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['ticket_id', 'postal_code', 'address', 'house_number', 'city', 'township', 'coordinates', 'vehicle', 'milage' ];
    //

    // Set the relationship between a destination and a ticket
    public function destinationTicket()
    {
        return $this->belongsTo('App\Ticket', 'destination_id', 'id');
    }
}
