<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = [
        'OptionName'
    ];

    function optionvalues(){
        return $this->hasMany(Option_Value::class, 'Option_id', 'id');
     }

}
