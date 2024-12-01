<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('contactus');
    }

    public function sentmail(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'messages' => 'required|string',
        ]);

        // Send the email
        Mail::to('thawhtoozin200811@gmail.com')->send(new ContactUsMail($validated['name'], $validated['email'], $validated['messages']));

        return back()->with('success', 'Message sent successfully!');
    }
}
