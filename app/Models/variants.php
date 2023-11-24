<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class variants extends Model
{
    use HasFactory;
    protected $fillable = [
        'Product_id',
        'Option_id',
        'option_values_id',
        'price'
    ];
}
