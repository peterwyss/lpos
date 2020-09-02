<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleLevel extends Model
{
    protected $table = 'articlelevel';
    protected $fillable = ["id", 'name'];
}
