<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote_Reply extends Model
{
    use HasFactory;
    protected $table = 'quote_replies';
    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'quote_id', 
        'garage_id', 
        'price', 
        'reply', 
        'picked_date', 
        'user_id', 
        'user_date', 
        'deposit'
    ];
}
