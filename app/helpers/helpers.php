<?php

// app/helpers.php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


if (!function_exists('userFullName')) {
    /**
     * Récupère le nom complet de l'utilisateur connecté
     * 
     * @param string $default
     * @return string
     */
    function userFullName($default = 'Invité')
    {
        if (!Auth::check()) {
            return $default;
        }

        $user = Auth::user();
        
        if (!$user) {
            return $default;
        }

        // Essayer différents champs selon votre structure de base de données
        return $user->nom_complet ?? $user->name ?? $user->nom ?? $default;
    }

}


if (!function_exists('userName')) {
    function userName($default = 'Invité')
    {
        if (!Auth::check()) {
            return $default;
        }

        $user = Auth::user();
        return $user->name ?? $user->nom ?? $default;
    }
}

if (!function_exists('userEmail')) {
    function userEmail()
    {
        return Auth::check() ? Auth::user()->email : null;
    }
}

function getroleName() {
    if (!Auth::check()) {
        return "";
    }
    
    $user = Auth::user();
    
    if (!$user || !$user->roles || $user->roles->count() == 0) {
        return "";
    }
    
    $roleNames = [];
    foreach ($user->roles as $role) {
        $roleNames[] = $role->role;
    }
    
    return implode(", ", $roleNames);
}

function setMenuClass($route, $classe){
    $routeActuel = request()->route()->getName();

    if(contains($routeActuel,  $route )){
        return $classe  ;
    }
    return "";
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}




