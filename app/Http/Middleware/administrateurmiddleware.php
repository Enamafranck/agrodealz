<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdministrateurMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // VERSION TEMPORAIRE - POUR DÉVELOPPEMENT SEULEMENT
        
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Connectez-vous d\'abord.');
        }

        // POUR TESTER: Accepter tout utilisateur connecté comme admin
        // RETIREZ CETTE LIGNE EN PRODUCTION
        return $next($request);

        // Ou vérifier par email spécifique :
        // $adminEmails = ['admin@example.com', 'votre@email.com'];
        // if (!in_array(Auth::user()->email, $adminEmails)) {
        //     abort(403, 'Accès refusé.');
        // }
        // return $next($request);
    }
}

?>