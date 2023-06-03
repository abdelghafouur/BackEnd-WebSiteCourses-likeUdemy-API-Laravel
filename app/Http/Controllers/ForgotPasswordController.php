<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $code = Str::random(10);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['email' => $email, 'code' => $code, 'created_at' => now()]
        );

        // Send the password reset email to the user
        $this->sendResetEmail($email, $code);

        return response()->json(['message' => 'Password reset code sent']);
    }

    private function sendResetEmail($email, $code)
    {
        // Customize the email content and subject as per your requirements
        Mail::send('emails.password_reset', ['code' => $code], function ($message) use ($email) {
            $message->to($email)->subject('Password Reset');
        });
    }
}
