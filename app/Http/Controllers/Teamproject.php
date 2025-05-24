<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class TeamProject extends Controller
{
    public function team()
    {
        return view('teamproject');
    }
}
