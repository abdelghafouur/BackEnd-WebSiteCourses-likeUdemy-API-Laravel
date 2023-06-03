<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registerForme');
    }
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->tele = $request->tele;
            $user->date = $request->date;
            $user->sexe = $request->sexe;
            $user->adresse = $request->adresse;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
// Retrieve the registered user with all attributes
$registeredUser = User::find($user->id);

return response()->json(['user' => $registeredUser, 'message' => 'Registration successful'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }

}
