<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'sujet' => 'required|string',
            'message' => 'required|string',
        ]);

        // Logique d'envoi d'email ici
        
        return redirect()->back()->with('success', 'Message envoyé avec succès!');
    }
}