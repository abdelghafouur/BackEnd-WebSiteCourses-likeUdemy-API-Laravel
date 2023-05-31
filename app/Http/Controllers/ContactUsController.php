<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;


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

}
