<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdmin extends Controller
{
    public function dashboardAdmin()
    {
        return view('backend.admin');
    }
}
