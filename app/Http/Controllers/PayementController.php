<?php

namespace App\Http\Controllers;
use App\Models\Payement;
use App\Models\Location;

use Illuminate\Http\Request;

class PayementController extends Controller
{
    //
    public function store(Request $request) {
    $payement = new Payement();
    $payement->idagriculteur = $request->idagriculteur;
    $payement->montantPaye = $request->montantPaye;
    $payement->datePayement = $request->datePayement;

    $payement->save();

    // Mise à jour du statut de location (si applicable)
    if ($request->has('location_id')) {
        Location::where('id', $request->location_id)->update(['status' => 'payé']);
    }

    return redirect()->route('home')->with('success', 'Payement enregistré et location confirmée.');
}
}
