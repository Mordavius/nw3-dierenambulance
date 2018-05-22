<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    // Set the id for the finance table
    protected $fillable = ['invoice', 'payment_method_invoice', 'gifts', 'payment_method_gifts'];
}
