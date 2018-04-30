<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['ticket_id', 'postal_code', 'address', 'house_number', 'city'];
    //

    public function destinationTicket()
    {
        return $this->belongsTo('App\Ticket', 'destination_id', 'id');
    }

    // Search function which searches on the animal species
    public function scopeSearch($query, $search)
    {
        // check on term for search function
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('city', 'LIKE', "%{$search}%");
            });
        }
    }
}
