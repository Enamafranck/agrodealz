<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnnoncesController extends Controller
{
    public function create()
    {
        return view('publier-annonce');
    }

   public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'marque' => 'required|string|max:255',
        'description' => 'required|string',
        'disponibilite' => 'required|in:disponible,loue,en_maintenance',
        'etat' => 'required|in:neuf,occasion,bon_etat',
        'prix_location' => 'required|string|max:255',
        'caution' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,avif|max:2048',
    ]);

    // 1. Créer une entrée dans la table annonces
    $idAnnonce = DB::table('annonces')->insertGetId([
        'idproprietaire' => Auth::id(),
        'description' => $request->description,
        'date_publication' => now(),
        'date_expiration' => now()->addDays(30), 
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // 2. Stocker l'image si elle est présente
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('materiels', 'public');
    }
    

    // 3. Créer le matériel
    Materiel::create([
        'idannonces'     => $idAnnonce,
        'nom'            => $request->nom,
        'marque'         => $request->marque,
        'description'    => $request->description,
        'disponibilite'  => $request->disponibilite,
        'etat'           => $request->etat,
        'prix_location'  => $request->prix_location,
        'caution'        => $request->caution,
        'image'          => $imagePath,
    ]);

    return redirect()->route('catalogue')->with('success', 'Votre annonce a été publiée avec succès !');
}
    
}
