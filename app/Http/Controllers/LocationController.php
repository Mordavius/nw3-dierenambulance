<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\DB;
class LocationController extends Controller
{
    public function setLocation($id){
        return(view('location.set', compact('id',$id)));
    }

    public function writeLocation(Request $data){
        $loc = array('lat'=>$data->lat, 'lon'=>$data->lon);
        $location = new Location([
            'locationHash'=> $data->id,
            'coordinates'=> json_encode($loc),
        ]);
        $location->save();
    }

    public function getLocation(Request $data){
        $location = Location::where('locationHash', $data->id)->get();

        if (count($location) > 0 && $location->first()->coordinates) {
            return response()->json($location->first()->coordinates);
        }
        else {
            return response()->json('no location');
        }
        //return response()->json(array('msg' => $location), 200);
    }
}
