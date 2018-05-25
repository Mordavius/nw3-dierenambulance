<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
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

    public function index(Request $request)
    {
        $search = Input::get('search'); // Get  the input from the search field
        $tickets = Ticket::all(); // Grabs all the existing tickets
        // $users = User::all(); // Grabs all the existing users
        $destinations = Destination::search($search)->orderBy('created_at', 'desc')->paginate(15); // Grabs all the existing locations, searches in the locations and paginate at 15 results
        $animals = Animal::all(); // Grabs all te existings animals
        $coordinateStrings = $destinations->pluck('coordinates')->toArray(); //Grabs the coordinates and puts it into an array.
        //Decodes the array for better formatting.
        $coordinates = array_map(function ($coordinateString) {
            return json_decode($coordinateString);
        }, $coordinateStrings);
        //Animal::search(request('search'))->orderBy('created_at', 'desc')->paginate(15);
        //dd($filter);
        return view('ticket.index', compact('tickets','animals', 'destinations', 'search', 'coordinates'));
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
           //  $ticket = Ticket::where('id', $ticket)->pluck('id');
            return view('ticket.create', compact('user', 'ticket', 'coordinates'));
    }

    public function createajax(Request $request)
    {
        //$tickets_id = Ticket::where('id', $ticket_id)->pluck('id');
        //Destination::where('ticket_id', $ticket_id)->get();
        $destination = Destination::create($request->all()); // ->where('ticket_id', $ticket_id)->get();
        return response()->json($destination);
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

        // $ticket = Ticket::where('id', $ticket)->pluck('id')->get();

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
      //  $ticket ->destination()->associate($destination);

        $destination->save();// Saves the data

        // Stores the data for the requested fields
        $animal = new Animal([
            'animal_species' => $request->get('animal_species'),
            'gender' => $request->get('gender'),
            'description' => $request->get('description'),
            'ticket_id' => $request->get('ticket_id'),
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
        $loaddestinations = Destination::all();
        $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        $ticket = Ticket::findOrFail($ticket_id); // Grabs the ticket with the correct id
      //  $tickets = Ticket::with('date')->orderBy('date', 'asc')->get();
        return view("ticket.show", compact('ticket', 'user', 'tickets', 'loaddestinations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $ticket_id)
    {
            $animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');// Grabs the animal id based on the ticket id
            //$destination_id = Destination::where('ticket_id', $ticket_id);// Deletes destination based on ticket id
            $destinations = Destination::where('ticket_id', $ticket_id)->first();
            $loaddestination = Destination::where('ticket_id', $ticket_id)->get();
            $loaddestination->postal_code = $request->postal_code;
            $loaddestination->address = $request->address;
            $loaddestination->house_number = $request->house_number;

            //$destinations = Destination::where();
            $animals = Animal::where('id', $animal_id);// Deletes animal based on animal id
            $users = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
            $known = Known::all()->pluck('location_name'); // Grabs all the existing known addresses and plucks the location name field
            $bus = Bus::all()->pluck('bus_type'); // Grabs all the existing buses and plucks the bus type field
            $ticket = Ticket::findOrFail($ticket_id);// Grabs the ticket with the correct id
            return view("ticket.edit", compact('destinations', 'ticket', 'users', 'animals', 'known', 'bus', 'loaddestination', 'ticket_id'));
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
        //check if destination adding submit button is clicked

        if (Input::get('btn-add')) {
          //  $destination = Destination::create($request->all());

          //  return response()->json($destination);
         //   return response()->json()->back();
        }
          //  return Response::json($destination);

         //   return response()->json($destination);

          //  return redirect('/melding/edit')->with('message', 'Bestemming toegevoegd');


        else {


            // Validates the requested fields
            //     $this->validate($request, [
            //       'date' => 'required',
            //        'time' => 'required',
            //    'telephone' => 'sometimes|numeric',
            //      ]);

            // Updates the data for the requested fields
            $destination = new Destination([
                'postal_code' => $request->get('postal_code'),
                'address' => $request->get('address'),
                'house_number' => $request->get('house_number'),
                'city' => $request->get('city'),
                'coordinates' => $request->get('coordinates'),
            ]);

            //Bus::create()

            $destination->save(); // Saves the data

            // Updates the data for the requested fields
            $animal = new Animal([
                'animal_species' => $request->get('animal_species'),
                'gender' => $request->get('gender'),
                'description' => $request->get('description'),
            ]);

            $animal->save(); // Saves the data

            //dd($animal);

            // Updates the data for the requested fields
            $ticket = new Ticket([
                'animal_id' => $animal->id,
                'destination_id' => $destination->id,
                'date' => $request->get('date'),
                'time' => $request->get('time'),
                'reporter_name' => $request->get('reporter_name'),
                'telephone' => $request->get('telephone'),
            ]);

            $finance = new Finance([
                'ticket_id' => $ticket->id,
                'payment_invoice' => $request->get('payment_invoice'),
                'payment_method_invoice' => $request->get('payment_method_invoice'),
                'payment_gift' => $request->get('Payment_gift'),
                'payment_method_gifts' => $request->get('payment_method_gifts'),
            ]);

            $ticket->save(); // Saves the data
            $finance->save(); // Saves the data

            return redirect('/melding')->with('message', 'Melding is geupdate');
        }
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
            $animal_id = Ticket::where('id', $ticket_id)->pluck('animal_id');// Grabs the animal id based on the ticket id
            //dd($animal_id);
            Destination::where('ticket_id', $ticket_id)->delete();// Deletes destination based on ticket id
            Animal::where('id', $animal_id)->delete();// Deletes animal based on animal id
            Ticket::findOrFail($ticket_id)->delete();// Grabs the ticket with the correct id and deletes the ticket
            return redirect('/melding')->with('message', 'Melding is verwijderd');
            // } catch (\Exception $e) {
            //     return view('auth.error')->with('message', 'Mag niet');
            // }
            // Ticket::findOrFail($ticket_id)->delete(); // Grabs the ticket with the correct id and deletes the ticket
            // return redirect('/melding')->with('message', 'Melding is verwijderd');
    }

    public function destroyajax($task_id) {
        try {
            $task = Destination::destroy($task_id);
            return response()->json($task);
        }
        catch (\Exception $e) {
            return response()->json($e);
            }
    }
}
