<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Bjrnblm\Messagebird\Messagebird;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
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
        $this->request = $request;
        $data = array('name'=>$request->name, 'link' => $request->id);
        Mail::send('mail', $data, function($message) use ($request) {
            $message->to($request->mail, $request->name)->subject
            ('Laravel HTML Testing Mail');
            $message->from('@gmail.com','Dierenambulance');
        });
        return response('succes',200);
    }

    public function askLocationSMS(Request $request)
    {
        $client = new Client('');
        $messagebird = new Messagebird($client);
        $phonenumber = substr($request->phonenumber, 1);
        $message = $messagebird->createMessage("Dierenambu",["+31".$phonenumber], "https://mainlink/api/location/".$request->id);

        if (is_object($message) && $message->recipients->items[0]->status === 'sent') {
            return response(json_encode('message sent'), 200);
        }

        if (in_array($message, $messagebird->getErrorMessages())){
            Log::channel('sentry')->error($message);
            return response(json_encode('something went wrong'), 400);
        }
        else {
            Log::channel('sentry')->error('Messagebird API error: ' . $message);
            return response(json_encode('something went wrong'), 400);
        }
    }

    public function markersOnCoordinates()
    {
        //
    }
}
