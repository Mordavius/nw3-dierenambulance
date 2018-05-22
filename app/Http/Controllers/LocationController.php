<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Bjrnblm\Messagebird\Messagebird;
use MessageBird\Client;
use MessageBird\Common\HttpClient;
use MessageBird\Resources\Chat\Message;
use MessageBird\Resources\Chat\Platform;
use MessageBird\Common;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function __construct()
    {

    }
    // Show the location and set the location with id
    public function setLocation($id)
    {
        return(view('location.set', compact('id', $id)));
    }

    // Grab the requested location and store the lat long coordinates
    public function writeLocation(Request $data)
    {
        $loc = array('lat'=>$data->lat, 'lon'=>$data->lon);
        $location = new Location([
            'locationHash'=> $data->id,
            'coordinates'=> json_encode($loc),
        ]);
        $location->save(); // save the location
    }

    // Get the location
    public function getLocation(Request $data)
    {
        $location = Location::where('locationHash', $data->id)->get();

        // if the location count is smaller then zero and the location has coordinates, response with the location
        if (count($location) > 0 && $location->first()->coordinates) {
            return response()->json($location->first()->coordinates);
        } else {
            return response()->json('no location'); // response with 'no location' found
        }
        //return response()->json(array('msg' => $location), 200);
    }

    public function askLocationMail(Request $request)
    {
        $data = array('name'=>"Virat Gandhi", 'link' => $request->id);
        Mail::send('mail', $data, function($message) {
            $message->to('abc@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
            $message->from('xyz@gmail.com','Virat Gandhi');
        });
        return response('iets',200);
    }

    public function askLocationSMS(Request $request)
    {
        $client = new Client('acceskey');
        $messagebird = new Messagebird($client);
        $message = $messagebird->createMessage("Dierenambu",["+31"], " mainlink/location/".$request->id);

        if (is_object($message) && $message->recipients->items[0]->status === 'sent') {
            return response(json_encode('message sent'), 200);
        }

        if (in_array($message, $messagebird->getErrorMessages())){
            // TODO: sentry log (vaste error)
        }
        // TODO: sentry error (API error)
        return response(json_encode('something went wrong'), 400);
    }

    public function markersOnCoordinates()
    {
        //
    }
}
