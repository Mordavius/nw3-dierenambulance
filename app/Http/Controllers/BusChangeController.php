<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\BusChange;
use App\User;
use App\Profile;

class BusChangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buschanges = Buschange::All(); // Grabs all the existing bus change details
        return view('BusChange.index', compact('buschanges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Buschange $buschange)
    {
        $users = User::all()->pluck('name'); // Grabs all the users and plucks the name field from the table
        return view('BusChange.create', compact('buschange'), compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Stores the data for the requested fields
        $buschange = new BusChange([
          'bus' => $request->get('bus'),
          'from' => $request->get('from'),
          'to' => $request->get('to'),
          'kilometerstraveled' => $request->get('kilometerstraveled'),
          'date' => $request->get('date'),
        ]);

        // Validates the requested data
        $request->validate([
          'date' => 'required',
          'kilometerstraveled' => 'required',
        ]);

        $buschange->save(); // saves the data

        return redirect('/buswissel')->with('success', 'Nieuwe buswissel is aangemaakt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}