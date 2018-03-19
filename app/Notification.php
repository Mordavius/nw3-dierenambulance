<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'time', 'address', 'housenumber', 'postalcode', 'city',
        'centralist', 'reportername', 'telephone', 'animalspecies', 'gender', 'comments'];

    /**
     * @param $query
     * @param $search
     */
    public function scopeFilter($query, $search)
    {
        // check on term for search function
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('animalspecies', 'LIKE', "%{$search}%");
            });
        }
    }

}
