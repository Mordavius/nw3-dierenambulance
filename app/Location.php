<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['locationHash', 'coordinates'];
}
