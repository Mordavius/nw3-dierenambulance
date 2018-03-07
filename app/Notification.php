<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'time', 'address', 'housenumber', 'postalcode', 'city'];
}
