<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $primaryKey = 'bus_id';
    protected $fillable = ['date', 'bus', 'from', 'to', 'kilometerstraveled'];
}
