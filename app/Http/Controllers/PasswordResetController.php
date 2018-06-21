<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'update']]);
    }
    public function index($id, $token)
    {
        // dd($id, $token);
        $user = User::where('token', '=', $token)->get();
        $token_user = User::where('token', $token)->pluck('token');

        if ($token_user != null) {
            if ($token == $token_user[0]) {
                return view('user.PasswordReset', compact('user'));
            }
        } return redirect('/')->with('message', 'Gebruiker niet gevonden');
    }
    public function update(Request $request, $id)
    {
        $new_password = $request['password'];
        User::where('id', $id)->update([
            'postal_code' => $request['postal_code'],
            'address' => $request['address'],
            'house_number' => $request['house_number'],
            'city' => $request['city'],
            'township' => $request['township'],
            'token' => '',
            'password' => Hash::make($new_password), // Hash the password
        ]);
        return redirect('/')->with('message', "Wachtwoord opgeslagen");
    }
}
