<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // Show the login page
    public function index()
    {
        return view('auth/login');
    }
    // Show the dashboard page
    public function ambulance()
    {
        return view('meldingen');
    }

    // Show the register page
    public function register()
    {
        return view('auth/register');
    }

    // Show the map for tickets
    public function map()
    {
        return view('map');
    }
}
