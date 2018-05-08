<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\DB;
class LocationController extends Controller
{
    // Show the location and set the location with id
    public function setLocation($id){
        return(view('location.set', compact('id',$id)));
    }

    // Grab the requested location and store the lat long coordinates
    public function writeLocation(Request $data){
        $loc = array('lat'=>$data->lat, 'lon'=>$data->lon);
        $location = new Location([
            'locationHash'=> $data->id,
            'coordinates'=> json_encode($loc),
        ]);
        $location->save(); // save the location
    }

    // Get the location
    public function getLocation(Request $data){
        $location = Location::where('locationHash', $data->id)->get();

        // if the location count is smaller then zero and the location has coordinates, response with the location
        if (count($location) > 0 && $location->first()->coordinates) {
            return response()->json($location->first()->coordinates);
        }
        else {
            return response()->json('no location'); // response with 'no location' found
        }
        //return response()->json(array('msg' => $location), 200);
    }
}
