<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;

class AcceuilController extends Controller
{
    public function index()
{
    $materiels = Materiel::all(); // ou une requête filtrée selon ce que tu veux afficher
    return view('acceuil', compact('materiels'));
}

    //
}
