<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Known extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['location_name', 'postal_code', 'address', 'house_number', 'city'];
}
