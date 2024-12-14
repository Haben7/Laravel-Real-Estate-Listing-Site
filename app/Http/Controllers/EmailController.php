<?php

namespace App\Http\Controllers;

use App\Mail\UserToOwnerMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmailToOwner(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
            'owner_email' => 'required|email' // Owner's email address
        ]);

        // Prepare the email details
        $details = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'message' => $validatedData['message']
        ];

        // Send the email to the owner's email address
        Mail::to($validatedData['owner_email'])->send(new UserToOwnerMail($details));

        // Return a response to the frontend (React)
        return response()->json(['message' => 'Email sent successfully!']);
    }
}
