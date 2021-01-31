<?php

namespace App\Http\Controllers;

use App\ControllButton;

use Illuminate\Http\Request;

class ControllButtonController extends Controller
{
    public function index()
    {
        $controllButtonList = ControllButton::all();
        return response()->json([ $controllButtonList]);
    }
}
