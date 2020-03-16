<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';
    protected $fillable = ['name', 'plu', 'category', 'price', 'purchasePrice', 'stock'];
}
