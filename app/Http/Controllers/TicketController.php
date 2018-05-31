<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\TicketUpdateRequest;
use App\Ticket;
use App\User;
use App\Animal;
use App\Bus;
use App\Known;
use App\Destination;
use App\Finance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Response;

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
        $search = Input::get('search'); // Get  the input from the search field
        $tickets = Ticket::all(); // Grabs all the existing tickets
        $tickets_id = Ticket::all()->pluck("id");
        $destination_array = [];

        foreach($tickets_id as $ticket_id)
        {
            array_push($destination_array, Destination::where('ticket_id', $ticket_id)->first()
            );
        }

        //dd($destination_array);

        // $users = User::all(); // Grabs all the existing users
        if (Input::get('search')) {
            Destination::search($search);
            Animal::search($search);
            Ticket::search($search);
        }
        $destinations = Destination::search($search)->orderBy('created_at', 'desc')->paginate(15); // Grabs all the existing locations, searches in the locations and paginate at 15 results
        $animals = Animal::all(); // Grabs all te existings animals
        $coordinateStrings = $destinations->pluck('coordinates')->toArray(); //Grabs the coordinates and puts it into an array.
        //Decodes the array for better formatting.
        $coordinates = array_map(function ($coordinateString) {
            return json_decode($coordinateString);
        }, $coordinateStrings);
        //Animal::search(request('search'))->orderBy('created_at', 'desc')->paginate(15);
        //dd($filter);
        return view('ticket.index', compact('tickets','animals', 'destinations', 'search', 'coordinates', 'destination_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
            $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
            $coordinates = [];
            return view('ticket.create', compact('user', 'ticket', 'coordinates'));
    }

    public function createAjax(Request $request)
    {
        $destination = Destination::create($request->all()); // ->where('ticket_id', $ticket_id)->get();
        return response()->json($destination);
    }

    public function createAjaxFinance(Request $request)
    {
        $finance = Finance::create($request->all());
        return response()->json($finance);
    }
    public function knownusers($id){
        $knownusers = Known::where('id', $id)->get();
        return response()->json($knownusers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // if (Input::get('btn-add')) {

        // Stores the data for the requested fields
        $ticket = new Ticket([
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'centralist' => $request->get('centralist'),
            'reporter_name' => $request->get('reporter_name'),
            'telephone' => $request->get('telephone'),
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
        ]);
       // $ticket->destination->save($ticket);
      //  $ticket->destination()->associate($destination);

        $destination->save();// Saves the data

        // Stores the data for the requested fields
        $animal = new Animal([
            'ticket_id' => $ticket->id,
            'animal_species' => $request->get('animal_species'),
            'gender' => $request->get('gender'),
            'description' => $request->get('description'),
        ]);

        $animal->save(); // Saves the data

        return redirect('/melding')->with('message', 'Nieuwe melding is aangemaakt!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket_id)
    {
        $loaddestinations = Destination::findOrFail($ticket_id);
        $animal = Animal::all();
        $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        $ticket = Ticket::findOrFail($ticket_id); // Grabs the ticket with the correct id
      //  $tickets = Ticket::with('date')->orderBy('date', 'asc')->get();
        return view("ticket.show", compact('ticket', 'user', 'tickets', 'loaddestinations', 'animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ticket_id)
    {

            //$knowns = Destination::lists('location_name', 'id');
            //$animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');// Grabs the animal id based on the ticket id
            //$destination_id = Destination::where('ticket_id', $ticket_id);// Deletes destination based on ticket id
            $destinations = Destination::where('ticket_id', $ticket_id)->first();
            $loaddestination = Destination::where('ticket_id', $ticket_id)->get();
            $loadfinances = Finance::where('ticket_id', $ticket_id)->get();
            //$animals = Animal::where('id', $animal_id);// Deletes animal based on animal id
            $users = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
            $known = Known::all(); // Grabs all the existing known addresses and plucks the location name field
            $bus = Bus::all()->pluck('bus_type'); // Grabs all the existing buses and plucks the bus type field
            $ticket = Ticket::findOrFail($ticket_id);// Grabs the ticket with the correct id
            return view("ticket.edit", compact('destinations', 'ticket', 'users', 'checkknown', 'known', 'bus', 'loaddestination', 'ticket_id', 'loadfinances', 'countdestinations', 'knowns'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(TicketUpdateRequest $request, $id)
    {
            //dd($animal);
            // Updates the data for the requested fields
            $ticket = new Ticket([
                'date' => $request->get('date'),
                'time' => $request->get('time'),
                'reporter_name' => $request->get('reporter_name'),
                'telephone' => $request->get('telephone'),
            ]);

            // Updates the data for the requested fields
        $animal = new Animal([
            'animal_species' => $request->get('animal_species'),
            'gender' => $request->get('gender'),
            'description' => $request->get('description'),
        ]);

        $animal->save(); // Saves the data
        $ticket->save(); // Saves the data


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
            // try {
           // $animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');// Grabs the animal id based on the ticket id
            //dd($animal_id);
            Destination::where('ticket_id', $ticket_id)->delete();// Deletes destination based on ticket id
            //Animal::where('id', $animal_id)->delete();// Deletes animal based on animal id
            Ticket::findOrFail($ticket_id)->delete();// Grabs the ticket with the correct id and deletes the ticket
            return redirect('/melding')->with('message', 'Melding is verwijderd');
            // } catch (\Exception $e) {
            //     return view('auth.error')->with('message', 'Mag niet');
            // }
            // Ticket::findOrFail($ticket_id)->delete(); // Grabs the ticket with the correct id and deletes the ticket
            // return redirect('/melding')->with('message', 'Melding is verwijderd');
    }

    public function destroyAjax($task_id) {
        try {
            $task = Destination::destroy($task_id);
            return response()->json($task);
        }
        catch (\Exception $e) {
            return response()->json($e);
            }
    }

    public function destroyAjaxPayment($task_id) {
        try {
            $task = Finance::destroy($task_id);
            return response()->json($task);
        }
        catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function filterTickets(Request $request){
        return $request->date;
    }

}
