<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
    public function dashboard()
    {
        return view('Admin/dashboard');
    }
}
