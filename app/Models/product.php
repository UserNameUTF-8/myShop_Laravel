<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;


    protected $fillable = ['prodName', 'pordDesc', 'prodPrice', 'prodQt', 'product_catid', 'user_id', 'prodImg'];

    
}
