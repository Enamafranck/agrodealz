<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
    
    
 


    /**
     * Mettre à jour un utilisateur existant
     */
    

    /**
     * Supprimer un utilisateur
     */
   public function destroy(User $user)
{
    try {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès.');
    } catch (\Exception $e) {
        return redirect()->route('users.index')
            ->with('error', 'Erreur lors de la suppression de l\'utilisateur.');
    }
}

/**
 * Afficher le formulaire d'édition
 */
public function edit(User $user)
{
    return view('users.edit', compact('user'));
}

/**
 * Mettre à jour l'utilisateur
 */
public function update(Request $request, User $user)
{
    try {
        // Validation des données avec la clé primaire correcte
        $validatedData = $request->validate([
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->iduser . ',iduser', // Correction ici
            'telephone' => 'required|string|max:20',
            'sexe' => 'required|in:homme,femme',
            'password' => 'nullable|string|min:8|confirmed',
            'photo_CNI' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'photo_personne' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Messages d'erreur personnalisés
            'nom_complet.required' => 'Le nom complet est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'telephone.required' => 'Le numéro de téléphone est obligatoire.',
            'sexe.required' => 'Le sexe est obligatoire.',
            'sexe.in' => 'Le sexe doit être "homme" ou "femme".',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'photo_CNI.image' => 'La photo CNI doit être une image.',
            'photo_CNI.mimes' => 'La photo CNI doit être au format JPEG, PNG, JPG ou GIF.',
            'photo_CNI.max' => 'La photo CNI ne doit pas dépasser 2MB.',
            'photo_personne.image' => 'La photo de la personne doit être une image.',
            'photo_personne.mimes' => 'La photo de la personne doit être au format JPEG, PNG, JPG ou GIF.',
            'photo_personne.max' => 'La photo de la personne ne doit pas dépasser 2MB.',
        ]);

        // Préparer les données à mettre à jour
        $dataToUpdate = [
            'nom_complet' => $validatedData['nom_complet'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['telephone'],
            'sexe' => $validatedData['sexe'],
        ];

        // Mettre à jour le mot de passe seulement s'il est fourni
        if (!empty($validatedData['password'])) {
            $dataToUpdate['password'] = Hash::make($validatedData['password']);
        }

        // Gestion de la photo CNI
        if ($request->hasFile('photo_CNI')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo_CNI && Storage::disk('public')->exists($user->photo_CNI)) {
                Storage::disk('public')->delete($user->photo_CNI);
            }
            
            // Enregistrer la nouvelle photo
            $photoCNIPath = $request->file('photo_CNI')->store('photos/cni', 'public');
            $dataToUpdate['photo_CNI'] = $photoCNIPath;
        }

        // Gestion de la photo de la personne
        if ($request->hasFile('photo_personne')) {
            // Supprimer l'ancienne photo si elle existe
            if ($user->photo_personne && Storage::disk('public')->exists($user->photo_personne)) {
                Storage::disk('public')->delete($user->photo_personne);
            }
            
            // Enregistrer la nouvelle photo
            $photoPersonnePath = $request->file('photo_personne')->store('photos/personnes', 'public');
            $dataToUpdate['photo_personne'] = $photoPersonnePath;
        }

        // Mettre à jour l'utilisateur
        $user->update($dataToUpdate);

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur "' . $user->nom_complet . '" modifié avec succès.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Erreur lors de la modification de l\'utilisateur: ' . $e->getMessage())
            ->withInput();
    }

 }
 

}
