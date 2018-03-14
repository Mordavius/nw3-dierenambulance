<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Profile;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {

       $username = Auth::user()->name;
      //$user_id = session()->get('user_id');

       //return ($username);
       return redirect('/profiel/' .$username);

     }
     /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('name', $id)->get();
        return view('profile.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('name',$id)->get();

        //return "test edit" .$user;
        return view('profile.edit', compact('user'));
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
          'username' => 'required',
          'email' => 'required',
      ]);
      //return $request;
      $user = User::findOrFail($id);
      $user->name = $request->get('username');
      $user->email = $request->get('email');
      // if ($request->('password') = $user->password){
      //   $user->password = $request->('password');
      // }

      //$data = $this->handleRequest($request);
       $user->save();

      return redirect('/profiel')->with('message', 'Gebruiker is geupdate');

      // return "test";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
