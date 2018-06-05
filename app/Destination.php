<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['ticket_id', 'postal_code', 'address', 'house_number', 'city', 'township', 'coordinates', 'bus_type' ];
    //

    // Set the relationship between a destination and a ticket
    public function destinationTicket()
    {
        return $this->belongsTo('App\Ticket', 'destination_id', 'id');
    }

    // Search function which searches on the animal species
    public function scopeSearch($query, $search)
    {
         // Search function for searching on destinations
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('city', 'LIKE', "%{$search}%");
            });
        }
    }
}
