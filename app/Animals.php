<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    protected $fillable = ['animal_species', 'breed', 'catch_cage', 'chip_number', 'gender', 'description'];

    public function animalTicket() {
        return $this->belongsTo('App\Ticket', 'animal_id', 'id');
    }
}
