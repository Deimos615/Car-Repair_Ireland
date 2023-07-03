<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $table = 'sells';

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone_number', 
        'eircode', 
        'passenger_img', 
        'driver_img', 
        'front_img', 
        'rear_img', 
        'interior_img',
        'odometer_img', 
        'reg_number', 
        'mileage', 
        'miles', 
        'timing', 
        'history',
        'miles', 
        'finance', 
        'car_issue',
        'your_issue',
    ];

}
