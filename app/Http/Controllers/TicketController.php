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
        // Grabs all the existing tickets and split the finished and unfinished
        $finishedtickets = Ticket::where('finished', '1')->orderBy('date', 'desc')->get();
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('created_at', 'desc')->get();
        $coordinates = [];

        foreach ($unfinishedtickets as $unfinishedticket) {
            if ($unfinishedticket->mainDestination()) {
                array_push($coordinates, json_decode($unfinishedticket->mainDestination()->coordinates));
            }
        }
        $coordinates = json_encode($coordinates);

        return view('ticket.administrator', compact('search', 'finishedtickets', 'unfinishedtickets', 'coordinates'));
    }

    public function administrator(Request $request)
    {
        // Grabs all the existing tickets and split the finished and unfinished
        $finishedtickets = Ticket::where('finished', '1')->orderBy('date', 'desc')->get();
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('created_at', 'desc')->get();
        $coordinates = [];

        foreach ($unfinishedtickets as $unfinishedticket) {
            if ($unfinishedticket->mainDestination()) {
                array_push($coordinates, json_decode($unfinishedticket->mainDestination()->coordinates));
            }
        }
        $coordinates = json_encode($coordinates);

        return view('ticket.administrator', compact('search', 'finishedtickets', 'unfinishedtickets', 'coordinates'));
    }

    public function ambulance(Request $request)
    {
        // Grabs all the existing tickets and split the finished and unfinished
        $finishedtickets = Ticket::where('finished', '1')->orderBy('date', 'desc')->get();
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('created_at', 'desc')->get();
        $coordinates = [];

        foreach ($unfinishedtickets as $unfinishedticket) {
            if ($unfinishedticket->mainDestination()) {
                array_push($coordinates, json_decode($unfinishedticket->mainDestination()->coordinates));
            }
        }
        $coordinates = json_encode($coordinates);

        return view('ticket.ambulance', compact('search', 'finishedtickets', 'unfinishedtickets', 'coordinates'));
    }


    public function centralist(Request $request)
    {
        // Grabs all the existing tickets and split the finished and unfinished
        $finishedtickets = Ticket::where('finished', '1')->orderBy('date', 'desc')->get();
        $unfinishedtickets = Ticket::where('finished', '0')->orderBy('created_at', 'desc')->get();
        $coordinates = [];

        foreach ($unfinishedtickets as $unfinishedticket) {
            if ($unfinishedticket->mainDestination()) {
                array_push($coordinates, json_decode($unfinishedticket->mainDestination()->coordinates));
            }
        }
        $coordinates = json_encode($coordinates);

        return view('ticket.centralist', compact('search', 'finishedtickets', 'unfinishedtickets', 'coordinates'));
    }



    public function createAjaxDestination(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'postal_code' => 'required',
            'house_number' => 'required',
            'address' => 'required',
            'city' => 'required',
            'milage' => 'required|numeric',
            'ticket_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $destination = Destination::create($request->all());
            $ticket = Ticket::findOrFail($request->get('ticket_id'));
            $bus = $ticket->bus;

	        $bus->update(['milage' => $request->get('milage')]);

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
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $ticket_id = $request->ticket_id;
            $ticket = Ticket::findOrFail($ticket_id);

            $ticket->update([
                'payment_invoice' => Input::get('payment_invoice'),
                'payment_gift' => Input::get('payment_gifts'),
                'payment_method' => Input::get('payment_method'),
            ]);

            return response()->json(); // Todo: helemaal geen enkele response?
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
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
            $owner = Owner::create($request->all());
            return response()->json($owner);
        }
    }

    public function knownusers($id)
    {
        if (is_numeric($id)) {
            $knownAddress = Known::where('id', $id)->get();
            return response()->json($knownAddress);
        } else {
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
            $output = "";
            $search = Destination::where('city', 'LIKE', '%' . $request->search . "%")->get();

            if ($search) {
                foreach ($search as $key => $city) {
                    $output .= '<tr>' .
                        '<td><a href="/melding/' . $city->ticket_id . '/edit">' . $city->postal_code . ' ' . $city->address . ' ' . $city->house_number . ' ' . $city->city . '</i></a></td>' .
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

        $tickets_id = Ticket::all()->pluck("id");
        $destination_array = [];

        foreach ($tickets_id as $ticket_id) {
            array_push($destination_array, Destination::where('ticket_id', $ticket_id)->first());
        }

        $coordinates = array_map(function ($coordinateString) {
            return json_decode($coordinateString);
        }, $coordinateStrings);
        $user = User::all()->pluck('name'); // Grabs all the existing users and plucks the name field
        return view('ticketcreate', compact('animals', 'unfinishedtickets', 'destination_array', 'coordinates', 'user', 'ticket', 'coordinates', 'bus', 'milage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $priority = $request->get('priority');
        $unfinishedtickets = Ticket::where('finished', '=', '0')->where('priority', '>=', $priority)->get();

        foreach ($unfinishedtickets as $unfinishedticket) {
	        $unfinishedticket->update(['priority' => $unfinishedticket->priority + 1]);
        }

        // Stores the data for the requested fields
        $animal = new Animal([
            'animal_species' => $request->get('animal_species'),
            'gender' => $request->get('gender'),
            'description' => $request->get('description'),
            'breed' => $request->get('breed'),
            'injury' => $request->get('injury'),
        ]);

        $bus = Bus::where('bus_type', $request->vehicle)->first();

        // Stores the data for the requested fields
        $ticket = new Ticket([
            'priority' => $request->get('priority'),
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'centralist' => $request->get('centralist'),
            'reporter_name' => $request->get('reporter_name'),
            'telephone' => $request->get('telephone'),
        ]);
        // Stores the data for the requested fields
        $destination = new Destination([
            'postal_code' => $request->get('postal_code'),
            'address' => $request->get('address'),
            'house_number' => $request->get('house_number'),
            'city' => $request->get('city'),
            'township' => $request->get('township'),
            'coordinates' => $request->get('coordinates'),
            'ticket_id' => $ticket->id,
            'milage' => $request->get('milage'),
        ]);

        $ticket_id = Ticket::all()->pluck('id')->last()+1;

        // Stores the data for the requested fields
        $owner = new Owner([
           'ticket_id' => $ticket_id,
            ]);

        try {
            $ticket->save();
		    $ticket->animal()->save($animal);
		    $bus->tickets()->save($ticket);
		    $ticket->animal()->save($destination);
		    $owner->save();
	    } catch (\Exception $e) {
	        return response()->json($e);
        }

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
	 * @param $ticket_id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
	 * @param $ticket_id
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function edit($ticket_id)
    {
    	$ticket = Ticket::findOrFail($ticket_id);
        $known_addresses = Known::all();
        $known_users = User::all();
        return view("ticket.edit", compact('ticket', 'known_addresses', 'known_users'));
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param         $ticket_id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(Request $request, $ticket_id)
    {
    	$ticket = Ticket::findOrFail($ticket_id);
        $ticket->telephone = $request->get('telephone');
        $ticket->save();

        $animal = $ticket->animal;
        $animal->update([
            'animal_species' => $request->get('animal_species'),
            'breed' => $request->get('breed'),
            'gender' => $request->get('gender'),
            'injury' => $request->get('injury'),
            'description' => $request->get('description'),
        ]);

	    $owner = $ticket->owner;
	    if ($owner) {
		    $owner->update([
	            'name' => $request->get('owner_name'),
	            'owner_house_number' => $request->get('owner_house_number'),
	            'telephone_number' => $request->get('owner_telephone_number'),
	            'owner_address' => $request->get('owner_address'),
	            'owner_city' => $request->get('owner_city'),
	            'owner_township' => $request->get('owner_township'),
	            'owner_postal_code' => $request->get('owner_postal_code'),
	        ]);
	    };

        return redirect('/melding')->with('message', 'Melding is geupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ticket_id)
    {
    	$ticket = Ticket::findOrFail($ticket_id);// Grabs the animal id based on the ticket id
	    $ticket->destinations->delete();
	    $ticket->animal->delete();
	    $ticket->delete();

        return redirect('/melding')->with('message', 'Melding is verwijderd');
    }

    public function destroyTicketAjax($ticket_id)
    {
        Destination::where('ticket_id', $ticket_id)->delete();// Deletes destination based on ticket id
        Ticket::findOrFail($ticket_id)->delete();// Grabs the ticket with the correct id and deletes the ticket

        return response()->json('Ticket verwijdert  ', 200);
    }

    public function destroyAjaxDestination($destination_id)
    {
        try {
            $destination = Destination::destroy($destination_id);
            return response()->json($destination);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function destroyAjaxPayment($ticket_id)
    {
        Ticket::where('id', $ticket_id)->update([
            'payment_invoice' => 0,
            'payment_gift' => 0,
        ]);
        return response()->json();
    }

    public function filterTickets()
    {
	    $ticket_search = Ticket::query(); // Start search query
	    $date_filter = Input::get('date', null);
	    $animal_filter = Input::get('animal', null);
	    $city_filter = Input::get('city', null);

	    // Add date query
	    if ($date_filter) {
		    $ticket_search->whereBetween('date', [$date_filter, date(now())]);
	    }

	    // Add animal query
	    if ($animal_filter) {
		    $ticket_search->whereHas('animal', function($query) use ($animal_filter) {
			    $query->where('animals.animal_species', 'LIKE', '%' . $animal_filter . '%');
		    });
	    }

	    // Add place query
	    if ($city_filter) {
		    $ticket_search->whereHas('destinations', function($query) use ($city_filter)  {
			    $query->where('destinations.city', 'LIKE', '%' . $city_filter . '%');
		    });
	    }
	    $ticket_search->with(['animal', 'destinations']);
	    $ticket_search->orderBy('created_at', 'desc');

	    $result = $ticket_search->get();
        return response()->json($result, 200);
    }

    public function destroyAjaxOwner($owner_id)
    {
        try {
            $task = Owner::destroy($owner_id);
            return response()->json($task);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
