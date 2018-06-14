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
use DB;
use App\Http\Requests\TicketStoreRequest;
//use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = $request->input('search'); // Get  the input from the search field
        // Grabs all the existing tickets and split the finished and unfinished
        $finishedtickets = Ticket::where('finished', '1')->orderBy('date', 'desc')->get();
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('id', 'desc')->get();

        $tickets_id = Ticket::all()->pluck("id");
        $destination_array = [];

        foreach($tickets_id as $ticket_id)
        {
            array_push($destination_array, Destination::where('ticket_id', $ticket_id)->first()
            );
        }

        //TODO: Check tickets for not finished tickets
        // Check destinations for coordinates based on not finished tickets
        // Send that data to map.
        $destinations = Destination::search($search)->orderBy('created_at', 'asc')->paginate(15); // Grabs all the existing locations, searches in the locations and paginate at 15 results
        $animals = Animal::all(); // Grabs all te existings animals
        $coordinateStrings = $destinations->pluck('coordinates')->toArray(); //Grabs the coordinates and puts it into an array.
        //Decodes the array for better formatting.
        $coordinates = array_map(function ($coordinateString) {
            return json_decode($coordinateString);
        }, $coordinateStrings);
<<<<<<< HEAD
        return view('ticket.index', compact('animals', 'destinations', 'destination_array', 'search', 'coordinates', 'finishedtickets', 'unfinishedtickets'));
    }

    public function createAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'postal_code' => 'required',
            'house_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'township' => 'required',
            'milage' => 'required|numeric',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {
            $destination = Destination::create($request->all()); // ->where('ticket_id', $ticket_id)->get();
            return response()->json($destination);
        }
    }

    public function createAjaxFinance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_invoice' => 'required_without:payment_gifts',
            'payment_gifts' => 'required_without:payment_invoice',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }
        else {
            $finance = Finance::create($request->all());
            return response()->json($finance);
        }
    }

    public function knownusers($id){
        $knownusers = Known::where('id', $id)->get();
        return response()->json($knownusers);
    }

    public function search(Request $request, Ticket $ticket_id)
    {
        if($request->ajax())
        {
            $output="";
            $search=DB::table('destinations')->where('city','LIKE','%'.$request->search."%")->get();

            if($search)
            {
                foreach ($search as $key => $city) {

                    $output.='<tr>'.
                        // '<td>'.$animals[0]->animal_species.' <br />'.$animals[0]->gender.'</td>'.
                        //  '<td>'.$animals[0]->description.'</td>'.
                        '<td>'.$city->postal_code.' <br /> '.$city->address.' '.$city->house_number.' '.$city->city.'</td>'.
                        //  '<td>'.$tickets[0]->date.' '.$tickets[0]->time.'</td>'.
                        '<td><a href="/melding/'. $ticket_id .'/edit"><i class="btn btn-primary">Aanpassen</i></a></td>'.
                        '</tr>';

                }
                return Response($output);
            }
        }
=======
        return view('ticket.centralist', compact('animals', 'destinations', 'search', 'coordinates', 'finishedtickets', 'unfinishedtickets'));
>>>>>>> 0dde516711e57e175374327dad9ebf92fa59384a
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
        // foreach ($unfinishedtickets as $unfinishedticket) {
        $destinations = Destination::whereIn('ticket_id', $unfinishedtickets_id)->get();            //$coordinateStrings = Destination::where('ticket_id', $unfinishedticket)->get();
        $coordinateStrings = $destinations->pluck('coordinates')->toArray();
        // }
        //dd($coordinateStrings);
        // $coordinateStrings = Destination::where('ticket_id', $unfinishedtickets)->get(); //Grabs the coordinates and puts it into an array.

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
        //dd($request->verhicle);
        // Stores the data for the requested fields
        $animal = new Animal([
            'animal_species' => $request->get('animal_species'),
            'gender' => $request->get('gender'),
            'description' => $request->get('description'),
        ]);

        $animal->save(); // Saves the data

        $bus = Bus::where('bus_type',$request->verhicle)->first();
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
            'bus_id' => $bus->id,
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
            'verhicle' => $request->get('verhicle'),
            'milage' => $request->get('milage'),
        ]);
        // $ticket->destination->save($ticket);
        //  $ticket ->destination()->associate($destination);

        $destination->save();// Saves the data

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
        $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        $ticket = Ticket::findOrFail($ticket_id); // Grabs the ticket with the correct id
      //  $tickets = Ticket::with('date')->orderBy('date', 'asc')->get();
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

        //$destination_id = Destination::where('ticket_id', $ticket_id);// Deletes destination based on ticket id
        $destinations = Destination::where('ticket_id', $ticket_id)->get();
        $loaddestination = Destination::where('ticket_id', $ticket_id)->get();
        $loadfinances = Finance::where('ticket_id', $ticket_id)->get();
        //$destinations = Destination::where();
        $known = Known::all();
        $animals = Animal::where('id', $animal_id)->get();// Deletes animal based on animal id
        $users = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        $ticket = Ticket::findOrFail($ticket_id);// Grabs the ticket with the correct id
        return view("ticket.edit", compact('destinations', 'animals', 'bus', 'ticket', 'users', 'animals', 'loadfinances', 'loaddestination', 'known', 'ticket_id'));
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
            'centralist' => $request->get('centralist'),
            'reporter_name' => $request->get('reporter_name'),
            'telephone' => $request->get('telephone'),
            'invoice' => $request->get('invoice'),
            'paymentmethodinvoice' => $request->get('paymentmethodinvoice'),
            'gifts' => $request->get('gifts'),
            'paymentmethodgifts' => $request->get('paymentmethodgifts'),
        ]);

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
}
