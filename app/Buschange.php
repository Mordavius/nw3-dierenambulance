<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buschange extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'bus', 'from', 'to', 'kilometerstraveled'];

    /**
     * @param $query
     * @param $search
     */
    public function scopeFilter($query, $search)
    {
        // check term for search function
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->orWhere('title', 'LIKE', "%{$search}%");
            });
        }
    }

}
