<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Ticket extends Model
{
    protected $primaryKey = 'ticket_id';
    protected $fillable = ['date', 'time', 'address', 'house_number', 'postal_code', 'city',
        'centralist', 'reporter_name', 'telephone', 'township'];

    /**
     * @param $query
     * @param $search
     */
    public function scopeSearch($query, $search)
    {
        // check on term for search function
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('animalspecies', 'LIKE', "%{$search}%");
            });
        }
    }

    public function scopeFilter($filter)
    {
        switch ($filter) {
            case "alles":
                break;
            case "week":
                return dd($filter);
                return $filter = Carbon::now()->subWeeks(1);
                break;
            case "month":
                return $filter = Carbon::now()->subMonths(1);
                break;
            case "year":
                return $filter = Carbon::now()->subYears(1);
                break;
        }
    }
}
