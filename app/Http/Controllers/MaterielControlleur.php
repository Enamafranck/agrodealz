<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Materiel;
use App\Models\Agriculteur;
use App\Models\Annonces;

class MaterielController extends Controller
{
    /**
     * Afficher le formulaire de location
     */
    public function index()
    {
        // Récupérer tous les matériels avec leurs annonces
        $materiels = Materiel::with('annonce')->get();
        $agriculteurs = Agriculteur::all();
        
        // Données de test si les tables sont vides
        if ($materiels->isEmpty()) {
            $materiels = collect([
                (object)['idmateriel' => 1, 'nom' => 'Tracteur John Deere', 'marque' => 'John Deere'],
                (object)['idmateriel' => 2, 'nom' => 'Moissonneuse-batteuse', 'marque' => 'Case IH'],
                (object)['idmateriel' => 3, 'nom' => 'Pulvérisateur', 'marque' => 'Amazone']
            ]);
        }
        
        if ($agriculteurs->isEmpty()) {
            $agriculteurs = collect([
                (object)['id' => 1, 'nom_complet' => 'Jean Dupont'],
                (object)['id' => 2, 'nom_complet' => 'Marie Martin'],
                (object)['id' => 3, 'nom_complet' => 'Pierre Bernard']
            ]);
        }
        
        return view('materiels.location', compact('materiels', 'agriculteurs'));
    }

    /**
     * Traiter la soumission du formulaire de location
     */
    public function submitLocation(Request $request)
    {
        $rules = [
            'idagriculteur' => 'required',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut'
        ];

        // Validation conditionnelle selon le choix
        if ($request->materiel_option === 'existing') {
            $rules['idmateriel'] = 'required';
        } else {
            $rules['nouveau_materiel'] = 'required|string|max:255';
            $rules['marque'] = 'required|string|max:255';
            $rules['description'] = 'nullable|string';
            $rules['prix_location'] = 'required|string';
            $rules['caution'] = 'required|string';
        }

        $request->validate($rules);

        // Logique de traitement
        if ($request->materiel_option === 'new') {
            // Créer d'abord une annonce
            $annonce = Annonces::create([
                // Ajoutez les champs nécessaires pour l'annonce
                'titre' => $request->nouveau_materiel,
                'description' => $request->description,
                // ... autres champs de l'annonce
            ]);

            // Créer le nouveau matériel
            $materiel = Materiel::create([
                'idannonces' => $annonce->idannonces,
                'nom' => $request->nouveau_materiel,
                'marque' => $request->marque,
                'description' => $request->description ?? '',
                'disponibilite' => 'disponible',
                'etat' => 'bon',
                'prix_location' => $request->prix_location,
                'caution' => $request->caution
            ]);
            $materielId = $materiel->idmateriel;
        } else {
            $materielId = $request->idmateriel;
        }

        // Ici vous pouvez créer la location
        // Location::create([...]);

        return redirect()->back()->with('success', 'Location enregistrée avec succès');
    }

    /**
     * Afficher le formulaire de création d'un nouveau matériel
     */
    public function create()
    {
        $annonces = Annonces::all(); // Pour sélectionner une annonce existante
        return view('materiels.create', compact('annonces'));
    }

    /**
     * Enregistrer un nouveau matériel
     */
    public function store(Request $request)
    {
        $request->validate([
            'idannonces' => 'required|exists:annonces,idannonces',
            'nom' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'description' => 'required|string',
            'disponibilite' => 'required|string',
            'etat' => 'required|string',
            'prix_location' => 'required|string',
            'caution' => 'required|string'
        ]);

        Materiel::create($request->all());

        return redirect()->route('materiels.index')->with('success', 'Matériel ajouté avec succès');
    }

    /**
     * Afficher les détails d'un matériel
     */
    public function show($idmateriel)
    {
        $materiel = Materiel::with('annonce')->findOrFail($idmateriel);
        return view('materiels.show', compact('materiel'));
    }

    /**
     * Afficher le formulaire d'édition d'un matériel
     */
    public function edit($idmateriel)
    {
        $materiel = Materiel::findOrFail($idmateriel);
        $annonces = Annonces::all();
        return view('materiels.edit', compact('materiel', 'annonces'));
    }

    /**
     * Mettre à jour un matériel
     */
    public function update(Request $request, $idmateriel)
    {
        $materiel = Materiel::findOrFail($idmateriel);

        $request->validate([
            'idannonces' => 'required|exists:annonces,idannonces',
            'nom' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'description' => 'required|string',
            'disponibilite' => 'required|string',
            'etat' => 'required|string',
            'prix_location' => 'required|string',
            'caution' => 'required|string'
        ]);

        $materiel->update($request->all());

        return redirect()->route('materiels.index')->with('success', 'Matériel mis à jour avec succès');
    }

    /**
     * Supprimer un matériel
     */
    public function destroy($idmateriel)
    {
        $materiel = Materiel::findOrFail($idmateriel);
        $materiel->delete();

        return redirect()->route('materiels.index')->with('success', 'Matériel supprimé avec succès');
    }

    /**
     * Filtrer les matériels par disponibilité
     */
    public function filterByDisponibilite($disponibilite)
    {
        $materiels = Materiel::where('disponibilite', $disponibilite)->with('annonce')->get();
        return view('materiels.index', compact('materiels'));
    }

    /**
     * Filtrer les matériels par état
     */
    public function filterByEtat($etat)
    {
        $materiels = Materiel::where('etat', $etat)->with('annonce')->get();
        return view('materiels.index', compact('materiels'));
    }
}