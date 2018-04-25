<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = ['bus_type', 'buschange_id', 'milage', 'damage', 'clean', 'damage_description'];

    public function busTicket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
