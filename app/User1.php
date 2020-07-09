<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User1 extends Model
{
    protected $table='user';
    protected $fillable=['first_name','last_name'];
}
