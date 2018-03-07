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
    public function index()
    {
        return view('home');
    }
    public function ambulance()
    {
        return view('ambulance');
    }
<<<<<<< HEAD
    public function register()
    {
        return view('auth/register');
    }
=======
>>>>>>> 0a5026e42558c15984794f941861e560f9c8ebde
}
