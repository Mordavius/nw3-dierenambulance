<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Ticket;
use App\User;
use Carbon\Carbon;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $filter = Ticket::all('date');
        $users = User::all();
        $notifications = Ticket::search(request('search'))->orderBy('date', 'desc')->paginate(15);
        return view('Ticket.index', compact('Ticket'), compact('filter'))->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ticket $ticket)
    {
        $user = User::all()->pluck('name');
        return view('Ticket.create', compact('Ticket'), compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket([
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'address' => $request->get('address'),
            'housenumber' => $request->get('housenumber'),
            'postalcode' => $request->get('postalcode'),
            'city' => $request->get('city'),
            'township' => $request->get('township'),
            'centralist' => $request->get('centralist'),
            'reportername' => $request->get('reportername'),
            'telephone' => $request->get('telephone'),
            'animalspecies' => $request->get('animalspecies'),
            'gender' => $request->get('gender'),
            'comments' => $request->get('comments'),
        ]);

        $request->validate([
            'date' => 'required',
            'time' => 'required',
         //   'housenumber' => 'sometimes|numeric',
         //   'telephone' => 'sometimes|numeric',
        ]);

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
        return view("notifications.show", compact('ticket'), compact('user'), compact('tickets'));
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
        return view("ticket.edit", compact('Ticket'), compact('user'));
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

        $ticket = Notification::findOrFail($ticket_id);
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
