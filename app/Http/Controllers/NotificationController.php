<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Notification;
use App\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
       // $filterNotifications = Notification::all()->orderBy('created_at', 'desc')->paginate(3);
        //with('date')->filter(request('term'))

     //   $filterNotifications = Notification::table('notifications')
      //      ->orderBy('date', 'desc')
       //     ->get();
        //$notifications = Notification::with('date')->orderBy('date', 'asc')->get();

        $notifications = Notification::filter(request('search'))->orderBy('date', 'desc')->paginate(3);
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Notification $notification)
    {
        $user = User::all()->pluck('name');
        return view('notifications.create', compact('notification'), compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $notification = new Notification([
            'date' => $request->get('date'),
            'time' => $request->get('time'),
            'address' => $request->get('address'),
            'housenumber' => $request->get('housenumber'),
            'postalcode' => $request->get('postalcode'),
            'city' => $request->get('city'),
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

        $notification->save();

       return redirect('/melding')->with('message', 'Nieuwe melding is aangemaakt!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all()->pluck('name');
        $notification = Notification::findOrFail($id);
        $notifications = Notification::with('date')->orderBy('date', 'asc')->get();
        return view("notifications.show", compact('notification'), compact('user'), compact('notifications'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::all()->pluck('name');
        $notification = Notification::findOrFail($id);
        return view("notifications.edit", compact('notification'), compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
        //    'telephone' => 'sometimes|numeric',
        ]);

        $notification = Notification::findOrFail($id);
        $notification->date = $request->get('date');
        $notification->time = $request->get('time');
        $notification->address = $request->get('address');
        $notification->housenumber = $request->get('housenumber');
        $notification->postalcode = $request->get('postalcode');
        $notification->city = $request->get('city');
        $notification->centralist = $request->get('centralist');
        $notification->reportername = $request->get('reportername');
        $notification->telephone = $request->get('telephone');
        $notification->animalspecies = $request->get('animalspecies');
        $notification->gender = $request->get('gender');
        $notification->comments = $request->get('comments');
        $notification->save();

        return redirect('/melding')->with('message', 'Melding is geupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notification::findOrFail($id)->delete();
        return redirect('/melding')->with('message', 'Melding is verwijderd');
    }
}
