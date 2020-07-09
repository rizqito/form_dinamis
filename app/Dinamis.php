<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dinamis extends Model
{
    public $table = 'dinamis';
    protected $fillable = [
        'first_name', 'last_name'
    ];
}
