<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegNumber extends Model
{
    use HasFactory;
    protected $table = 'regnumbers';
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'reg',
        'make',
        'model',
        'version',
        'body',
        'doors',
        'seats',
        'reg_date',
        'reg_date_ie',
        'sale_date',
        'previous_reg',
        'engine_cc',
        'colour',
        'fuel',
        'transmission',
        'year_of_manufacture',
        'tax_class',
        'tax_expiry_date',
        'NCT_expiry_date',
        'nct_pass_date',
        'no_of_owners',
        'chassis_no',
        'engine_no',
        'co2_emissions',
        'crwExpDate',
        'vehicle_category'
    ];

}
