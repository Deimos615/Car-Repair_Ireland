<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $table = 'transports';

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'reg_number', 
        'name', 
        'email', 
        'phone_number',
        'date',
        'pickup_location', 
        'destination_location', 
        'distance', 
        'duration', 
        'estimation_value', 
        'deposit_paid',
        'cost_value', 
        'loading_purpose',
        'note', 
    ];
}
