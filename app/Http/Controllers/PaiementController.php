<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaiementController extends Controller
{
       
    public function create(Reservation $reservation)
    {
        // Vérifier que la réservation peut être payée
        if (!in_array($reservation->statut, ['confirmee', 'en_cours'])) {
            return redirect()->route('reservations.index')
                ->with('error', 'Cette réservation ne peut pas être payée dans son état actuel.');
        }

        if ($reservation->statut_paiement === 'paye') {
            return redirect()->route('reservations.index')
                ->with('error', 'Cette réservation est déjà entièrement payée.');
        }

        // Calculer le montant restant à payer
        $montantPaye = $reservation->paiements()->where('statut', 'reussi')->sum('montant');
        $montant_restant = $reservation->total_ttc - $montantPaye;
        
        // Alternative: si vous avez déjà un accessor dans le modèle
        // $montant_restant = $reservation->montant_restant;
        
        return view('paiements.create', compact('reservation', 'montant_restant'));
    }

    // Traiter le formulaire de paiement (store)
   public function store(Request $request, Reservation $reservation)
{
    $request->validate([
        'montant' => 'required|numeric|min:0.01',
        'methode_paiement' => 'required|in:orange_money,mtn_momo,especes',
        'numero_telephone' => 'required_if:methode_paiement,orange_money,mtn_momo|string|max:20',
       
    ]);

    // Vérifier que la réservation peut être payée
    if (!in_array($reservation->statut, ['confirmee', 'en_cours'])) {
        return redirect()->route('reservations.index')
            ->with('error', 'Cette réservation ne peut pas être payée dans son état actuel.');
    }

    if ($reservation->statut_paiement === 'paye') {
        return redirect()->route('reservations.index')
            ->with('error', 'Cette réservation est déjà entièrement payée.');
    }

    // Calculer le montant restant à payer
    $montantPaye = $reservation->paiements()->where('statut', 'reussi')->sum('montant');
    $montant_restant = $reservation->total_ttc - $montantPaye;

    // Vérifier le montant
    $montant = $request->montant;
    if ($montant > $montant_restant) {
        return back()->with('error', 'Le montant ne peut pas être supérieur au montant restant.');
    }

    // Déterminer le type de paiement automatiquement
    $type_paiement = ($montant >= $montant_restant) ? 'total' : 'acompte';

    // Créer le paiement
    $paiement = Paiement::create([
        'reservation_id' => $reservation->id,
        'montant' => $montant,
        'type_paiement' => $type_paiement,
        'methode_paiement' => $request->methode_paiement,
        'statut' => 'en_attente',
        'reference_transaction' => 'PAY_' . Str::upper(Str::random(10)),
        'numero_telephone' => $request->numero_telephone,
        
    ]);

    // Rediriger selon la méthode de paiement
    switch ($request->methode_paiement) {
        case 'orange_money':
        case 'mtn_momo':
            // Pour les paiements mobiles, rediriger vers la page de confirmation
            return view('paiements.confirmation', compact('paiement'));
        
        case 'especes':
            // Pour les espèces, rediriger vers la page de confirmation
            return view('paiements.confirmation', compact('paiement'));
        
        default:
            return back()->with('error', 'Méthode de paiement non supportée.');
    }
}

    // Afficher la page de paiement
    public function show(Reservation $reservation)
    {
        // Vérifier si la réservation peut être payée
        if (!$reservation->peutEffectuerPaiement()) {
            return redirect()->route('reservations.index')
                ->with('error', 'Cette réservation ne peut pas être payée actuellement.');
        }

        return view('paiements.show', compact('reservation'));
    }

    // Initier un paiement
   // Initier un paiement
public function initier(Request $request, Reservation $reservation)
{
    $request->validate([
        'montant' => 'required|numeric|min:0.01',
        'methode_paiement' => 'required|in:orange_money,mtn_momo,especes',
        'numero_telephone' => 'required_if:methode_paiement,orange_money,mtn_momo|string|max:20',
        
    ]);

    // Calculer le montant restant à payer - AJOUTÉ
    $montantPaye = $reservation->paiements()->where('statut', 'reussi')->sum('montant');
    $montant_restant = $reservation->total_ttc - $montantPaye;

    // Vérifier le montant
    $montant = $request->montant;
    if ($montant > $montant_restant) {
        return back()->with('error', 'Le montant ne peut pas être supérieur au montant restant.');
    }

    // Déterminer le type de paiement automatiquement
    $type_paiement = ($montant >= $montant_restant) ? 'total' : 'acompte';

    // Créer le paiement
    $paiement = Paiement::create([
        'reservation_id' => $reservation->id,
        'montant' => $montant,
        'type_paiement' => $type_paiement,
        'methode_paiement' => $request->methode_paiement,
        'statut' => 'en_attente',
        'reference_transaction' => 'PAY_' . Str::upper(Str::random(10)),
        'numero_telephone' => $request->numero_telephone,
        
    ]);

    // Rediriger selon la méthode de paiement
    switch ($request->methode_paiement) {
        case 'orange_money':
        case 'mtn_momo':
            // Simuler l'initiation du paiement mobile
            return view('paiements.confirmation', compact('paiement'));
        
        case 'especes':
            // Paiement espèces
            return view('paiements.confirmation', compact('paiement'));
        
        default:
            return back()->with('error', 'Méthode de paiement non supportée.');
    }
}

    // Traiter le paiement mobile money (simulation)
    private function traiterPaiementMobileMoney(Paiement $paiement)
    {
        // Pour l'instant, on simule le paiement
        // Plus tard, vous intégrerez l'API réelle
        
        return view('paiements.mobile-money', compact('paiement'));
    }

    // Traiter le paiement par carte
    private function traiterPaiementCarte(Paiement $paiement)
    {
        // Intégration avec Stripe ou autre
        return view('paiements.carte', compact('paiement'));
    }

    // Traiter le paiement manuel
    private function traiterPaiementManuel(Paiement $paiement)
    {
        return view('paiements.manuel', compact('paiement'));
    }

    // Confirmer un paiement (pour les paiements manuels)
    public function confirmer(Paiement $paiement)
    {
        $paiement->update([
            'statut' => 'reussi',
            'date_paiement' => now(),
        ]);

        // Mettre à jour le statut de la réservation
        $paiement->reservation->mettreAJourStatutPaiement();

        return redirect()->route('reservations.index')
            ->with('success', 'Paiement confirmé avec succès !');
    }

    // Annuler un paiement
    public function annuler(Paiement $paiement)
    {
        if ($paiement->statut === 'en_attente') {
            $paiement->update(['statut' => 'echoue']);
        }

        return redirect()->route('reservations.index')
            ->with('info', 'Paiement annulé.');
    }

    // Callback pour les paiements externes
    public function callback(Request $request)
    {
        // Traiter les callbacks des plateformes de paiement
        // Cette méthode sera développée selon la plateforme choisie
        
        return response()->json(['status' => 'success']);
    }
    
public function statut(Paiement $paiement)
{
    return response()->json([
        'statut' => $paiement->statut,
        'montant' => $paiement->montant,
        'reference' => $paiement->reference_transaction,
        'date_paiement' => $paiement->date_paiement
    ]);
}
}