<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class TeamProject extends Controller
{
    public function team()
    {
        return view('teamproject');
    }
}
