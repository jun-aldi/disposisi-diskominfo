<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileShow extends Controller
{
    public function index(){
        return view('profile.show');
    }
}
