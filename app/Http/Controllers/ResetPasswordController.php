<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Password_reset;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request, $code)
{
    // Find the password reset record by code
    $passwordReset = Password_reset::where('code', $code)->first();

    if (!$passwordReset) {
        return response()->json(['message' => 'Invalid code'], 400);
    }

    // Find the user by email
    $user = User::where('email', $passwordReset->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    // Validate the request data
   // $request->validate([
     //   'password' => 'required|confirmed|min:8',
    //]);

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->password),
    ]);

    // Delete the password reset record
    $passwordReset->delete();

    // You can perform any additional actions or return a response as needed
    return response()->json(['message' => 'Password reset successful']);
}
}

