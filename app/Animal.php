<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['animal_species', 'breed', 'catch_cage', 'chip_number', 'gender', 'description'];

    public function animalTicket()
    {
        return $this->belongsTo('App\Ticket');
    }

    // Search function which searches on the animal species
    public function scopeSearch($query, $search)
    {
        // check on term for search function
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('animal_species', 'LIKE', "%{$search}%");
            });
        }
    }
}
