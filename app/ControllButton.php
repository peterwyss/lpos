<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControllButton extends Model
{
    protected $table = 'controllbutton';
    protected $fillable = ['id', 'name', 'function'];
}
