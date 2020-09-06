<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journal';
    protected $fillable = ['invoice', 'quantity', 'name', 'plu', 'category', 'price', 'purchasePrice', 'stock'];
}
