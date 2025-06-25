<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GovernmentController extends Controller
{
    public function dashboard()
    {
        // You can pass any data needed to the view here
        return view('dashboard.government');
    }
}
