<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    // Set the columns for storing data in the database
    protected $fillable = ['ticket_id', 'name', 'telephone_number', 'owner_postal_code', 'owner_address', 'owner_house_number', 'owner_city', 'owner_township' ];
    //
}
