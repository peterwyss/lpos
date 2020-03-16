<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleButton extends Model
{
    protected $table = 'articlebutton';
    protected $fillable = ['name', 'reference', 'level'];
}
