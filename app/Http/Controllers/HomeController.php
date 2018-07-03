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

    // Show the login page
    public function index()
    {
        return view('auth/login');
    }

    // Show the admin page
    public function admin()
    {
        return view('ticket.centralist');
    }
    // Show the centralist page
    public function centralist()
    {
        return view('ticket.centralist');
    }

    // Show the ambulance page
    public function ambulance()
    {
        return view('ticket.ambulance');
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

    public function error() {
        return view('auth.error');
    }
}
