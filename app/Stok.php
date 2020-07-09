<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    public $table = 'product_stocks';
    protected $fillable = ['name','qty','price'];
}
