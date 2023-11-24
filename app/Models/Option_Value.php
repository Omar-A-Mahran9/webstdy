<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option_Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'valueName',
        'Option_id'
    ];

    function getoption(){
        return $this->BelongsTo(Option::class, 'Option_id', 'id');
     }

}
