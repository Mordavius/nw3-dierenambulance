<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    protected $fillable = ['destination_id', 'animal_id', 'bus_id', 'finance_id', 'date','time', 'centralist', 'reporter_name', 'telephone', 'driver', 'passenger'];

    public function destination()
    {
        return $this->hasMany('App\Destination');
    }

    public function animal()
    {
        return $this->hasOne('App\Animal');
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
                $q->orWhere('animal_species', 'LIKE', "%{$search}%");
            });
        }
    }
}
