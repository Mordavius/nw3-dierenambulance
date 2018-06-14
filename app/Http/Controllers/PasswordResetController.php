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
        $user = User::where('token', $token)->get();
        $token_user = User::where('token', $token)->pluck('token');

        if ($token == $token_user[0]) {
            return view('user.PasswordReset', compact('user'));
        }
    }
    public function update(Request $request, $id)
    {
        $new_password = $request['password'];
        User::where('id', $id)->update([
            'password' => Hash::make($new_password), // Hash the password
        ]);
        return redirect('/')->with('alert', "Wachtwoord opgeslagen");
    }
}
