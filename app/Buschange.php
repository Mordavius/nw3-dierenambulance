<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buschange extends Model
{
    // Set the id for the buschange table
    protected $primaryKey = 'buschange_id';
    // Set the columns for storing data in the database
    protected $fillable = ['date', 'bus', 'from', 'to', 'kilometerstraveled'];

    /**
     * @param $query
     * @param $search
     */
}
