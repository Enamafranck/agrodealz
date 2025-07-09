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
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create($materiel_id = null)
    {
        $materiel = null;
        $materiels = Materiel::where('disponibilite', 'disponible')->get();

        if ($materiel_id) {
            $materiel = Materiel::findOrFail($materiel_id);
        }

        return view('reservations.create', compact('materiel', 'users'));
    }

    public function calculerPrix(Request $request)
    {
        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut'
        ]);

        $materiel = Materiel::findOrFail($request->materiel_id);
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
            'idmateriel' => 'required|exists:materiels,id',
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|email|max:255',
            'telephone_client' => 'required|string|max:20',
            'adresse_client' => 'required|string|max:500',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'commentaires' => 'nullable|string|max:1000',
            'conditions_acceptees' => 'required|array|min:1'
        ]);

        $materiel = Materiel::findOrFail($request->materiel_id);
        
        // Vérifier la disponibilité
        $conflits = Reservation::where('materiel_id', $request->materiel_id)
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
                'idmateriel' => $request->materiel_id,
                'iduser' => Auth::id(),
                'nom_client' => $request->nom_client,
                'email_client' => $request->email_client,
                'telephone_client' => $request->telephone_client,
                'adresse_client' => $request->adresse_client,
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

            return redirect()->route('reservations.show', $reservation)
                ->with('success', 'Réservation créée avec succès!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erreur lors de la création de la réservation.']);
        }
    }

    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        
        $reservation->load('materiel');
        
        return view('reservations.show', compact('reservation'));
    }

    public function confirmer(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        
        $reservation->update(['statut' => 'confirmee']);
        
        return back()->with('success', 'Réservation confirmée!');
    }

    public function annuler(Reservation $reservation)
    {
        $this->authorize('update', $reservation);
        
        $reservation->update(['statut' => 'annulee']);
        
        return back()->with('success', 'Réservation annulée!');
    }
}
