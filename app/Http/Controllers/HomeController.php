<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home() {
        $services = ['Software Development', 'Graphic Design', 'Digital Marketing'];
        return view('home', compact('services'));
    }
}
