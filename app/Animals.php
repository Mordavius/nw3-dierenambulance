<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animals extends Model
{
    protected $primaryKey = 'animal_id';

    protected $fillable = ['animal_species', 'gender', 'comments'];
    //
}
