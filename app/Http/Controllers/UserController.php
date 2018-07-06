<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users      = User::orderBy('name')->paginate(5); // Grab all existing users and paginate by 5 results
        $usersCount = User::count(); // Count the users
        return view("profile.index", compact('users', 'usersCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        User::create($request->all()); // Stores the created user
        return redirect("/administratie")->with("message", "Nieuwe gebruiker is aangemaakt!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the correct user by id
        return view("profile.adminedit", compact('user'), compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $new_password = $request->get('password');

        if (Hash::check($new_password, Auth::user()->password)) {
            return redirect("/leden/{$id}/edit")->with("message", "Het ingevoerde wachtwoord is al eens gebruikt.");
        }

        // Update the requested data for the fields
        if ($new_password == null && $new_password == "") {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'role_id' => $request['role_id'],
            ]);
        }
        else {
            $user->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($new_password), // Hash the password
                'role_id' => $request['role_id'],
            ]);
        }

        return redirect("/administratie")->with("message", "Gebruiker is geupdate!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete(); // Find the correct user by id and delete it
        return redirect("/administratie")->with("message", "Gebruiker is verwijderd!");
    }
}
