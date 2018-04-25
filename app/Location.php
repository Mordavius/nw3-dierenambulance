<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['locationHash', 'coordinates'];
}
