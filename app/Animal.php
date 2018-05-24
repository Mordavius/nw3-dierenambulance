<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['animal_species', 'breed', 'catch_cage', 'chip_number', 'gender', 'injury', 'description'];

    // Set the relationship with a animal and a ticket
    public function animalTicket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
