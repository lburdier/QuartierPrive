<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Affiche le formulaire de contact.
     */
    public function showContactForm()
    {
        return view('contact.form');
    }

    /**
     * Envoie le message de contact.
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Enregistre le message de contact dans la base de données
        Contact::create($request->all());

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès.');
    }
}
