<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Appliquer le middleware d'authentification à toutes les méthodes
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Afficher la liste paginée des utilisateurs
     */
    public function index()
    {
        $users = User::paginate(10);
        $showForm = request()->query('form') === 'add';
        return view('user', compact('users', 'showForm'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email', // Table 'user' au singulier
            'sexe' => 'required|in:homme,femme',
            'password' => 'required|min:6',
            'numero_CNI' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'photo_CNI' => 'required|image|mimes:jpg,jpeg,png|max:2048', // required au lieu de nullable
            'photo_personne' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Gestion de la photo CNI (obligatoire)
        if ($request->hasFile('photo_CNI')) {
            $validated['photo_CNI'] = $request->file('photo_CNI')->store('photos/cni', 'public');
        }

        // Gestion de la photo de la personne (optionnelle)
        if ($request->hasFile('photo_personne')) {
            $validated['photo_personne'] = $request->file('photo_personne')->store('photos/personne', 'public');
        } else {
            // Si aucune photo de personne n'est uploadée, on retire cette clé du tableau
            unset($validated['photo_personne']);
        }

        // Hachage du mot de passe
        $validated['password'] = bcrypt($validated['password']);

        // Création de l'utilisateur
        User::create($validated);

        // Redirection avec message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur enregistré avec succès.');
    }
    
}