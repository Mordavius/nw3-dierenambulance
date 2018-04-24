<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = ['postal_code', 'address', 'house_number', 'city'];
    protected $primaryKey = 'destination_id';
    //

    public function ticket() {
        return $this->belongsTo('App\Ticket');
    }
}
