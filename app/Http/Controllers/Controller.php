<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function index()
{
    $users = User::where('active', true)->get();

    // ✅ Pour accéder au premier utilisateur
    $firstUser = $users->first();
    echo $firstUser->id;

    // ✅ Ou pour tous les afficher
    foreach ($users as $user) {
        echo $user->id . '<br>';
    }

    // ✅ Ou pour envoyer à une vue
    return view('users.index', compact('users'));
}
}
