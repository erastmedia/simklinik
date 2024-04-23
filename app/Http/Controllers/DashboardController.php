<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    
    public function index()
    {
        $accessToken = Session::get('access_token');
        return view('dashboard', compact('accessToken'));
    }
}
