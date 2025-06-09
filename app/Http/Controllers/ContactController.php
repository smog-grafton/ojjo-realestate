<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact us form.
     *
     * @return \Illuminate\View\View
     */
    public function showContactForm()
    {
        return view('contact-us');
    }

    /**
     * Store a new contact message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeContactMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Add IP address and User Agent
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->header('User-Agent');
        
        // Create the contact message
        ContactMessage::create($validated);

        // Redirect back with success message
        return redirect()->route('contact.show')->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}
