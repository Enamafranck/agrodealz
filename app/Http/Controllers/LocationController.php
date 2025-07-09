<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use App\Models\agriculteur;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function submit(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'idmateriel' => 'required|integer',
            'idagriculteur' => 'required|integer',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        // Logique d'enregistrement (exemple avec un modèle Location)
        // Location::create($validated);

        return redirect()->back()->with('success', 'Location enregistrée avec succès !');

        
    }

    public function create()
{
    // Optionnel : récupérer les matériels et agriculteurs
    $materiels = Materiel::all();
    $agriculteurs = Agriculteur::all();

    return view('location.form', compact('materiels', 'agriculteurs'));
}

}

