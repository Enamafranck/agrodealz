<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'idmateriel',
        'iduser',
        'nom_complet',
        'email',
        'telephone',
        'adresse',
        'date_debut',
        'date_fin',
        'duree_jours',
        'prix_unitaire',
        'sous_total',
        'caution',
        'tva',
        'total_ttc',
        'statut',
        'statut_paiement',
        'commentaires',
        'conditions_acceptees'
    ];


    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'conditions_acceptees' => 'array',
        'prix_unitaire' => 'decimal:2',
        'sous_total' => 'decimal:2',
        'caution' => 'decimal:2',
        'tva' => 'decimal:2',
        'total_ttc' => 'decimal:2'
    ];
    protected $primaryKey = 'id';


    // Relations
   public function materiel()
{
    return $this->belongsTo(Materiel::class, 'idmateriel');
}

public function user()
{
    return $this->belongsTo(User::class, 'iduser');
}

    // Méthodes de calcul
    public function calculerDuree()
    {
        return Carbon::parse($this->date_debut)->diffInDays(Carbon::parse($this->date_fin)) + 1;
    }

    public function calculerSousTotal()
    {
        return $this->prix_unitaire * $this->duree_jours;
    }

    public function calculerTva($taux = 0.19) // 19% de TVA
    {
        return $this->sous_total * $taux;
    }

    public function calculerTotal()
    {
        return $this->sous_total + $this->tva + $this->caution;
    }

    // Scopes
    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }

    public function scopeConfirmee($query)
    {
        return $query->where('statut', 'confirmee');
    }
public function getConditionsArray()
{
    if (is_string($this->conditions_acceptees)) {
        return json_decode($this->conditions_acceptees, true) ?? [];
    }
    
    if (is_array($this->conditions_acceptees)) {
        return $this->conditions_acceptees;
    }
    
    return [];
}
       public function paiements()
{
    return $this->hasMany(Paiement::class);
}

// Paiements réussis uniquement
public function paiementsReussis()
{
    return $this->hasMany(Paiement::class)->reussi();
}

// Calculer le montant total payé
public function getMontantPayeAttribute()
{
    return $this->paiementsReussis()->sum('montant');
}

// Calculer le montant restant à payer
public function getMontantRestantAttribute()
{
    return $this->total_ttc - $this->montant_paye;
}

// Vérifier si complètement payé
public function getEstComplettementPayeAttribute()
{
    return $this->montant_restant <= 0;
}

// Vérifier si un acompte a été payé
public function getAcomptePayeAttribute()
{
    return $this->paiementsReussis()->where('type_paiement', 'acompte')->exists();
}

// Calculer le montant minimum d'acompte (par exemple 30%)
public function getMontantAcompteMinimumAttribute()
{
    return $this->total_ttc * 0.30; // 30% du total
}

// Mettre à jour automatiquement le statut de paiement
public function mettreAJourStatutPaiement()
{
    if ($this->est_completement_paye) {
        $this->statut_paiement = 'paye';
    } elseif ($this->montant_paye > 0) {
        $this->statut_paiement = 'acompte';
    } else {
        $this->statut_paiement = 'non_paye';
    }
    
    $this->save();
}

// Vérifier si on peut effectuer un paiement
public function peutEffectuerPaiement()
{
    return in_array($this->statut, ['en_attente', 'confirmee']) && 
           !$this->est_completement_paye;
}
public function payer(Reservation $reservation)
{
    // Vérifier que la réservation peut être payée
    if ($reservation->statut_paiement !== 'non_paye') {
        return redirect()->back()->with('error', 'Cette réservation a déjà été payée.');
    }

    return view('reservations.payer', compact('reservation'));
}

public function traiterPaiement( $request, Reservation $reservation)
{
    // Logique de traitement du paiement
    // Ici vous intégrerez votre système de paiement (Stripe, PayPal, etc.)
    
    // Exemple simple :
    $reservation->update([
        'statut_paiement' => 'paye'
    ]);

    return redirect()->route('reservations.index')->with('success', 'Paiement effectué avec succès !');
}



}
