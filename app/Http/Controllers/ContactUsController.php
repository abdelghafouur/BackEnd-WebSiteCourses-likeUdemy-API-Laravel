<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;
use App\Mail\MailUser;
use App\Models\User;

class ContactUsController extends Controller
{


    public function sendEmail(Request $request)
    {
        $mailData = [
                        'name' => $request->name,
                        'email' => $request->email,
                        'message' => $request->message,
        ];

        // Send the email
        Mail::to("nvabdouamanu@gmail.com")->send(new ContactUsMail($mailData));

        // Return a response indicating the email was sent successfully
        return response()->json(['message' => 'Email sent successfully'], 200);
    }
    public function sendEmailEnregister(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $mailData = [
                        'firstname' => $user->firstname,
                        'lastname' => $user->lastname,
                        'email' => $user->email,
        ];

        // Send the email
        Mail::to($user->email)->send(new MailUser($mailData));

        // Return a response indicating the email was sent successfully
        return response()->json(['message' => 'Email sent successfully'], 200);
    }

}
