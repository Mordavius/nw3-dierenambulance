<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ticket;
use App\User;
use App\Animal;
use App\Bus;
use App\Destination;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $search = $request->input('search');
        $tickets = Ticket::all();
        $users = User::all();
        $destinations = Destination::search($search)->orderBy('created_at', 'desc')->paginate(15);
        $animals = Animal::all();
        //Animal::search(request('search'))->orderBy('created_at', 'desc')->paginate(15);
        //dd($filter);
        return view('ticket.index', compact('tickets', 'animals', 'destinations', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
        $user = User::all()->pluck('name');
        return view('ticket.create', compact('ticket'), compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destination = new Destination([
            'postal_code' => $request->get('postal_code'),
            'address' => $request->get('address'),
            'house_number' => $request->get('house_number'),
            'city' => $request->get('city'),
        ]);

        $destination->save();
        //dd($destination);

        $animal = new Animal([
        'animal_species' => $request->get('animal_species'),
        'gender' => $request->get('gender'),
        'description' => $request->get('description'),
        ]);

        $animal->save();

        //dd($animal);

        $ticket = new Ticket([
            'animal_id' => $animal->id,
            'destination_id' => $destination->id,
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'centralist' => $request->get('centralist'),
            'reporter_name' => $request->get('reporter_name'),
            'telephone' => $request->get('telephone'),
        ]);
       // $ticket->destination->save($ticket);
      //  $ticket ->destination()->associate($destination);
        $ticket->save();


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
        $user = User::all()->pluck('name');
        $ticket = Ticket::findOrFail($ticket_id);
      //  $tickets = Ticket::with('date')->orderBy('date', 'asc')->get();
        return view("ticket.show", compact('ticket'), compact('user'), compact('tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ticket_id)
    {
        $user = User::all()->pluck('name');
        $ticket = Ticket::findOrFail($ticket_id);
        return view("ticket.edit", compact('ticket'), compact('user'));
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
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
        //    'telephone' => 'sometimes|numeric',
        ]);

        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->date = $request->get('date');
        $ticket->time = $request->get('time');
        $ticket->address = $request->get('address');
        $ticket->housenumber = $request->get('housenumber');
        $ticket->postalcode = $request->get('postalcode');
        $ticket->city = $request->get('city');
        $ticket->township = $request->get('township');
        $ticket->centralist = $request->get('centralist');
        $ticket->reportername = $request->get('reportername');
        $ticket->telephone = $request->get('telephone');
        $ticket->animalspecies = $request->get('animalspecies');
        $ticket->gender = $request->get('gender');
        $ticket->comments = $request->get('comments');
        $ticket->save();

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
        Ticket::findOrFail($ticket_id)->delete();
        return redirect('/melding')->with('message', 'Melding is verwijderd');
    }
}
