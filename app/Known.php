<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Known extends Model
{
    protected $fillable = ['location_name', 'postal_code', 'address', 'house_number', 'city', 'damage_description'];
}
