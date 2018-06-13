<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Buschange extends Model
{
    // Set the id for the buschange table
    protected $primaryKey = 'buschange_id';
    // Set the columns for storing data in the database
    protected $fillable = ['bus', 'from', 'to', 'milage', 'date'];

    public function role() {

        return $this->belongsTo('App\Role');
    }

    /**
     * @param $query
     * @param $search
     */
}
