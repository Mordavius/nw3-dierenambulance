<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['ticket_id', 'animal_species', 'breed', 'catch_cage', 'chip_number', 'gender', 'injury', 'description'];

    // Set the relationship with a animal and a ticket
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
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
}
