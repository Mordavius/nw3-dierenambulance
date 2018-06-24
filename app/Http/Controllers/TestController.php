<?php

// TODO: Volgens mij kan deze nog de container in...

namespace App\Http\Controllers;

use App\Destination;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('ticket.test')->with('tasks', $destinations);
    }

    public function create(Request $request)
    {
        $destination = Destination::create($request->all());

        return response()->json($destination);
    }

    public function edit(Request $request, $id)
    {
        $destination = Destination::find($id);

	    $destination->postal_code = $request->postal_code;
	    $destination->city = $request->city;

	    $destination->save();

        return response()->json($destination);
    }
    public function destroy($id)
    {
        $destinations = Destination::destroy($id);

        return response()->json($destinations);
    }
}
