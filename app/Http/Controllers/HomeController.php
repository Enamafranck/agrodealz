<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiel;
use App\Models\Location; // ✅ avec une majuscule


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     public function index()
    {
        $materiels = Materiel::all();
        $location = Location::all(); // ou une autre logique

        return view('home', compact('materiels', 'location'));
    }
}
