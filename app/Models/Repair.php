<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $table = 'repairs';
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'reg_number', 
        'sel_location', 
        'name', 
        'email', 
        'phone_number', 
        'price', 
        'reply'
    ];

    /**
     * Get all of the comments for the Repair
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quotes()
    {
        return $this->hasMany(Quote_Reply::class, 'quote_id', 'id');
    }    
}
