<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['ticket_id', 'postal_code', 'address', 'house_number', 'city', 'coordinates'];
    //

    public function destinationTicket()
    {
        return $this->belongsTo('App\Ticket', 'destination_id', 'id');
    }
}
