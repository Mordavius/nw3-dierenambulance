<?php

// TODO: Kwown moet eigenlijk naar known_addresses veranderd worden.
// TODO: Ook het eindpunt (address) zou naar known_addresses kunnen)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Known;
use App\Http\Requests\KnownAddressRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class KnownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $known = Known::All(); // Grab all existing known addresses
        return view('address.index', compact('known'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Known $known)
    {
        return view('address.create', compact('known'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnownAddressRequest $request)
    {
        // Stores the data for the requested fields
        $known = new Known([
            'location_name' => $request->get('location_name'),
            'postal_code' => $request->get('postal_code'),
            'address' => $request->get('address'),
            'house_number' => $request->get('house_number'),
            'city' => $request->get('city'),
            'township' => $request->get('township'),
        ]);

        $known->save(); // saves the data

        return redirect('/bekende-adressen')->with('success', 'Nieuw adres is toegevoegd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $known = Known::where('id', $id)->first();
        return view('address.edit', compact('known'));
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
        $known = Known::find($id);
        $known->location_name = $request->get('location_name');
        $known->postal_code = $request->get('postal_code');
        $known->address = $request->get('address');
        $known->house_number = $request->get('house_number');
        $known->city = $request->get('city');
        $known->township = $request->get('township');
        $known->save();

        return Redirect::to('/bekende-adressen')->with('success', 'Adress '.$known->location_name.' is geupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Known::findOrFail($id)->delete(); // Find the correct address by id and delete the address
        return redirect("/bekende-adressen")->with("message", "Bekend adres is verwijderd!");
    }
}
