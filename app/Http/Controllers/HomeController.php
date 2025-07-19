<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    // Panel principal
    public function dashboard()
    {
        return view('dashboard');
    }
}
