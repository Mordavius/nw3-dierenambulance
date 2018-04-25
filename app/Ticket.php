<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    protected $fillable = ['destination_id', 'date', 'time', 'centralist', 'reporter_name', 'telephone', 'driver', 'passenger'];


    public function destination() {
        return $this->hasMany('App\Destination', 'destination_id', 'id');
    }

    public function animal() {
        return $this->hasOne('App\Animal', 'animal_id', 'id');
    }

    /**
     * @param $query
     * @param $search
     */

    // Search function which searches on the animal species
    public function scopeSearch($query, $search)
    {
        // check on term for search function
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('animalspecies', 'LIKE', "%{$search}%");
            });
        }
    }
}
