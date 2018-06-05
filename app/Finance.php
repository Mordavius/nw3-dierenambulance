<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    // Set the id for the finance table
    protected $fillable = ['ticket_id', 'payment_invoice', 'payment_gifts', 'payment_method'];
}
