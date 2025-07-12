<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('materiel')
            ->where('iduser', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create($idmateriel = null)
    {
        // Récupérer TOUS les matériaux disponibles
        $materiels = Materiel::where('disponibilite', 'disponible')->get();
        
        // Initialiser $materiel à null
        $materiel = null;
        
        // Si un matériel spécifique est demandé, le récupérer
        if ($idmateriel) {
            $materiel = Materiel::findOrFail($idmateriel);
        }

        return view('reservations.create', compact('materiels', 'materiel'));
    }

    public function calculerPrix(Request $request)
    {
        $request->validate([
            'idmateriel' => 'required|exists:materiel,idmateriel',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut'
        ]);

        $materiel = Materiel::findOrFail($request->idmateriel);
        $dateDebut = Carbon::parse($request->date_debut);
        $dateFin = Carbon::parse($request->date_fin);
        $dureeJours = $dateDebut->diffInDays($dateFin) + 1;

        $prixUnitaire = $materiel->prix_location;
        $sousTotal = $prixUnitaire * $dureeJours;
        $tva = $sousTotal * 0.18; // 18% de TVA
        $caution = $materiel->caution;
        $totalTTC = $sousTotal + $tva + $caution;

        return response()->json([
            'duree_jours' => $dureeJours,
            'prix_unitaire' => number_format($prixUnitaire, 2),
            'sous_total' => number_format($sousTotal, 2),
            'tva' => number_format($tva, 2),
            'caution' => number_format($caution, 2),
            'total_ttc' => number_format($totalTTC, 2)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'idmateriel' => 'required|exists:materiel,idmateriel',
            'nom_complet' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
            'adresse' => 'required|string|max:500',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'commentaires' => 'nullable|string|max:1000',
            'conditions_acceptees' => 'required|array|min:1'
        ]);

        $materiel = Materiel::findOrFail($request->idmateriel);
        
        // Vérifier la disponibilité
        $conflits = Reservation::where('idmateriel', $request->idmateriel)
            ->where('statut', '!=', 'annulee')
            ->where(function($query) use ($request) {
                $query->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
                      ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
                      ->orWhere(function($q) use ($request) {
                          $q->where('date_debut', '<=', $request->date_debut)
                            ->where('date_fin', '>=', $request->date_fin);
                      });
            })->exists();

        if ($conflits) {
            return back()->withErrors(['dates' => 'Le matériel n\'est pas disponible pour ces dates.']);
        }

        DB::beginTransaction();
        try {
            $dateDebut = Carbon::parse($request->date_debut);
            $dateFin = Carbon::parse($request->date_fin);
            $dureeJours = $dateDebut->diffInDays($dateFin) + 1;

            $prixUnitaire = $materiel->prix_location;
            $sousTotal = $prixUnitaire * $dureeJours;
            $tva = $sousTotal * 0.18;
            $caution = $materiel->caution;
            $totalTTC = $sousTotal + $tva + $caution;

            $reservation = Reservation::create([
                'idmateriel' => $request->idmateriel,
                'iduser' => Auth::id(),
                'nom_complet' => $request->nom_complet,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'date_debut' => $request->date_debut,
                'date_fin' => $request->date_fin,
                'duree_jours' => $dureeJours,
                'prix_unitaire' => $prixUnitaire,
                'sous_total' => $sousTotal,
                'caution' => $caution,
                'tva' => $tva,
                'total_ttc' => $totalTTC,
                'commentaires' => $request->commentaires,
                'conditions_acceptees' => $request->conditions_acceptees,
                'statut' => 'en_attente',
                'statut_paiement' => 'non_paye'
            ]);

            DB::commit();

            return redirect()->route('reservations.index')
                ->with('success', 'Réservation créée avec succès!');

       } catch (\Exception $e) {
            DB::rollBack();
             return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show(Reservation $reservation)
    {
        // Supprimer l'autorisation pour permettre à tous les utilisateurs connectés
        // $this->authorize('view', $reservation);
        
        // Ou garder l'autorisation si vous voulez que seuls les propriétaires voient leurs réservations
        // $this->authorize('view', $reservation);
        
        $reservation->load('materiel');
        
        return view('reservations.show', compact('reservation'));
    }

    public function confirmer(Reservation $reservation)
    {
        // Supprimer l'autorisation pour permettre à tous les utilisateurs connectés
        // $this->authorize('update', $reservation);
        
        // Ou garder l'autorisation si vous voulez que seuls les propriétaires confirment leurs réservations
        // $this->authorize('confirmer', $reservation);
        
        $reservation->update(['statut' => 'confirmee']);
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation confirmée avec succès !');
    }

    public function annuler(Reservation $reservation)
    {
        // Supprimer l'autorisation pour permettre à tous les utilisateurs connectés
        // $this->authorize('update', $reservation);
        
        // Ou garder l'autorisation si vous voulez que seuls les propriétaires annulent leurs réservations
        // $this->authorize('annuler', $reservation);
        
        $reservation->update(['statut' => 'annulee']);
        
        return back()->with('success', 'Réservation annulée!');
    }

    public function listeReservations()
    {
        $request = request();
        
        $query = Reservation::with('materiel')
            ->where('iduser', Auth::id())
            ->orderBy('created_at', 'desc');

        // Filtres
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('statut_paiement')) {
            $query->where('statut_paiement', $request->statut_paiement);
        }

        if ($request->filled('date_debut')) {
            $query->where('date_debut', '>=', $request->date_debut);
        }

        $reservations = $query->paginate(10);

        return view('reservations.index', compact('reservations'));
    }
}