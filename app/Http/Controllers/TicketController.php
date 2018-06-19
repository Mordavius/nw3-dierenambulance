<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ticket;
use App\User;
use App\Animal;
use App\Destination;
use App\Finance;
use App\Known;
use App\Bus;
use App\Owner;
use App\Http\Requests\TicketStoreRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['filterTickets']]);
    }

    public function index(Request $request)
    {
        $search = $request->input('search'); // Get  the input from the search field
        // Grabs all the existing tickets and split the finished and unfinished
        $finishedtickets = Ticket::where('finished', '1')->orderBy('date', 'desc')->get();
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('id', 'desc')->get();

        $tickets_id = Ticket::all()->pluck("id");
        $destination_array = [];

        foreach ($tickets_id as $ticket_id) {
            array_push($destination_array, Destination::where('ticket_id', $ticket_id)->first());
        }
        //TODO: Check tickets for not finished tickets
        // Check destinations for coordinates based on not finished tickets
        // Send that data to map.
        $destinations = Destination::orderBy('created_at', 'asc')->paginate(15); // Grabs all the existing locations, searches in the locations and paginate at 15 results
        $animals = Animal::all(); // Grabs all te existings animals
        $coordinateStrings = $destinations->pluck('coordinates')->toArray(); //Grabs the coordinates and puts it into an array.
        //Decodes the array for better formatting.
        $coordinates = array_map(function ($coordinateString) {
            return json_decode($coordinateString);
        }, $coordinateStrings);
        return view('ticket.centralist', compact('animals', 'destinations', 'destination_array', 'search', 'coordinates', 'finishedtickets', 'unfinishedtickets'));
    }

    public function createAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'postal_code' => 'required',
            'house_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'milage' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } else {
            $destination = Destination::create($request->all()); // ->where('ticket_id', $ticket_id)->get();

            $bus = Input::get('vehicle');
            $milage = Destination::get(['milage'])->last()->toArray();

            Bus::where('bus_type', $bus)->update($milage);

            return response()->json($destination);
        }
    }

    public function createAjaxFinance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_invoice' => 'required_without:payment_gifts',
            'payment_gifts' => 'required_without:payment_invoice',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {
            $ticket_id = $request->ticket_id;
            Ticket::where('id', $ticket_id)->update([
                'payment_invoice' => Input::get('payment_invoice'),
                'payment_gift' => Input::get('payment_gifts'),
                'payment_method' => Input::get('payment_method'),
            ]);
            return response()->json();
        }
    }

    public function createAjaxOwner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'telephone_number' => 'required|numeric',
            'owner_postal_code' => 'required',
            'owner_house_number' => 'required',
            'owner_address' => 'required',
            'owner_city' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } else {
                $owner = Owner::create($request->all());
                return response()->json($owner);
        }
    }

    public function knownusers($id)
    {
        if(is_numeric($id)) {
            $knownAddress = Known::where('id', $id)->get();
            return response()->json($knownAddress);
    }
        else {
            $knownUsers = User::where('name', $id)->get();
            return response()->json($knownUsers);
        }
    }

    public function animalowner($id)
    {
        $animalowner = Ticket::where('id', $id)->get();
        return response()->json($animalowner);
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output="";
            $search=Destination::where('city', 'LIKE', '%'.$request->search."%")->get();

            if ($search) {
                foreach ($search as $key => $city) {
                    $output.='<tr>'.
                        '<td>'.$city->postal_code.' <br /> '.$city->address.' '.$city->house_number.' '.$city->city.'</td>'.
                        '<td><a href="/melding/' . $city->ticket_id . '/edit"><i class="btn btn-primary">Aanpassen</i></a></td>' .
                        '</tr>';
                }
                if (Input::get('search') == "") {
                    return "";
                } else {
                    return Response($output);
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Ticket $ticket)
    {
        $milage = Bus::all('milage')->pluck('milage')->first();
        $bus = Bus::all('bus_type')->pluck("bus_type");
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('priority', 'asc')->get();
        $unfinishedtickets_id = Ticket::where('finished', '0')->orderBy('date', 'desc')->pluck('id');
        $animals = Animal::all();
        $destinations = Destination::whereIn('ticket_id', $unfinishedtickets_id)->get();            //$coordinateStrings = Destination::where('ticket_id', $unfinishedticket)->get();
        $coordinateStrings = $destinations->pluck('coordinates')->toArray();
        //Decodes the array for better formatting.
        $coordinates = array_map(function ($coordinateString) {
            return json_decode($coordinateString);
        }, $coordinateStrings);
        $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        return view('ticketcreate', compact('animals', 'unfinishedtickets', 'destinations', 'coordinates', 'user', 'ticket', 'coordinates', 'bus', 'milage'));
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
        $animal = new Animal([
            'animal_species' => $request->get('animal_species'),
            'gender' => $request->get('gender'),
            'description' => $request->get('description'),
        ]);

        $animal->save(); // Saves the data

        $bus = Bus::where('bus_type', $request->vehicle)->first();
        //dd($bus);

        // Stores the data for the requested fields
        $ticket = new Ticket([
            'animal_id' => $animal->id,
            'breed' => $request->get('breed'),
            'chip_number' => $request->get('chip_number'),
            'injury'=> $request->get('injury'),
            'priority'=> $request->get('priority'),
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'centralist' => $request->get('centralist'),
            'reporter_name' => $request->get('reporter_name'),
            'telephone' => $request->get('telephone'),
            // 'bus_id' => $bus->id,
        ]);

        $ticket->save(); // Saves the data

        // Stores the data for the requested fields
        $destination = new Destination([
            'postal_code' => $request->get('postal_code'),
            'address' => $request->get('address'),
            'house_number' => $request->get('house_number'),
            'city' => $request->get('city'),
            'township' => $request->get('township'),
            'coordinates' => $request->get('coordinates'),
            'ticket_id' => $ticket->id,
            'vehicle' => $request->get('vehicle'),
            // 'milage' => $request->get('milage'),
        ]);

        $destination->save();// Saves the data

        return redirect('/melding')->with('message', 'Nieuwe melding is aangemaakt!');
    }

    public function finish($id)
    {
        //Finish the ticket
        DB::table('tickets')
            ->where('id', $id)
            ->update(['finished' => 1]);

        return redirect('melding')->with('message', 'Melding afgerond!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        $ticket = Ticket::findOrFail($ticket_id); // Grabs the ticket with the correct id
        return view("ticket.show", compact('ticket', 'user', 'tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ticket_id)
    {
        $bus = Bus::all('bus_type')->pluck("bus_type");
        $animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');// Grabs the animal id based on the ticket id
        $destinations = Destination::where('ticket_id', $ticket_id)->get();
        $loaddestination = Destination::where('ticket_id', $ticket_id)->get();
        $vehicle = Destination::where('ticket_id', $ticket_id)->pluck('vehicle');
        $loadowners = Owner::where('ticket_id', $ticket_id)->get();
        $animalowner = Ticket::all();
        $known = Known::all();
        $knownUser = User::all();
        $animals = Animal::where('id', $animal_id)->get();// Grabs animal based on animal id
        $users = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        $ticket = Ticket::findOrFail($ticket_id);// Grabs the ticket with the correct id
        $animal = Animal::where('id', $animal_id)->pluck('animal_species');
        $animaldescription = Animal::where('id', $animal_id)->pluck('description');
        return view("ticket.edit", compact('tickets_id', 'destinations', 'knownUser', 'vehicle', 'destination_array', 'bus', 'ticket', 'loadowners', 'users', 'animalowner', 'animaldescription', 'animals', 'loaddestination', 'known', 'ticket_id', 'animal'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ticket_id)
    {
        // Updates the data for the requested fields
        $destination = new Destination([
            'postal_code' => $request->get('postal_code'),
            'address' => $request->get('address'),
            'house_number' => $request->get('house_number'),
            'city' => $request->get('city'),
            'coordinates' => $request->get('coordinates'),
        ]);

        // Updates the data for the requested fields
        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->date = Input::get('date');
        $ticket->time = Input::get('time');
        $ticket->centralist = Input::get('centralist');
        $ticket->reporter_name = Input::get('reporter_name');
        $ticket->telephone = Input::get('telephone');
        $ticket->save(); // Saves the data

        // Updates the data for the requested fields
        $animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');
        $animal = Animal::findOrFail($animal_id);

        Animal::whereIn('id', $animal)->update([
            'animal_species' => Input::get('animal_species'),
            'gender' => Input::get('gender'),
            'description' => Input::get('comments'),
        ]);

        return redirect('/melding')->with('message', 'Melding is geupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ticket_id)
    {
            $animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');// Grabs the animal id based on the ticket id
            //dd($animal_id);
            Destination::where('ticket_id', $ticket_id)->delete();// Deletes destination based on ticket id
            Animal::where('id', $animal_id)->delete();// Deletes animal based on animal id
            Ticket::findOrFail($ticket_id)->delete();// Grabs the ticket with the correct id and deletes the ticket
            return redirect('/melding')->with('message', 'Melding is verwijderd');
    }

    public function destroyTicketAjax($ticket_id)
    {
        Destination::where('ticket_id', $ticket_id)->delete();// Deletes destination based on ticket id
        Ticket::findOrFail($ticket_id)->delete();// Grabs the ticket with the correct id and deletes the ticket
        return response()->json('Ticket verwijdert', 200);
    }

    public function destroyAjax($task_id)
    {
        try {
            $task = Destination::destroy($task_id);
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function destroyAjaxPayment($task_id)
    {
        try {
            $task = Finance::destroy($task_id);
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function filterTickets(Request $request)
    {
        $date = $request->date;
        $animal = $request->animal;
        $city = $request->city;
        $tickets = Ticket::query()->whereBetween('date', [$date, date(now())])->get();
        $destination_array = [];
        $animal_array = [];
        $ticket_array = [];

        foreach ($tickets as $ticket) {
                $animalresult = Animal::where([['id', $ticket->id], ['animal_species', $animal],])->first();
                $destinationresult = Destination::where([['id', $ticket->id], ['city', 'LIKE', '%'.$city.'%']])->first();

                if($ticket && $animalresult && $destinationresult){
                    array_push($ticket_array, $ticket);
                    array_push($animal_array, $animalresult);
                    array_push($destination_array, $destinationresult);
                }
        }

        return response()->json(['tickets' =>  $ticket_array, 'destinations'=>$destination_array, 'animals'=>$animal_array], 200);
    }


    public function destroyAjaxOwner($task_id)
    {
        try {
            $task = Owner::destroy($task_id);
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
