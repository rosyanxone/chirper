<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $greeting = 'lorem ipsum dolor sit amet, consectetur adipiscing elit.';
        return view('dashboard', compact('greeting'));
    }
}
