<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'montant',
        'type_paiement',
        'methode_paiement',
        'statut',
        'reference_transaction',
        'numero_telephone',
        'notes',
        'date_paiement',
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'datetime',
    ];

    // Relation avec la réservation
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // Méthodes utilitaires
    public function getStatutLibelleAttribute()
    {
        return match($this->statut) {
            'en_attente' => 'En attente',
            'reussi' => 'Réussi',
            'echoue' => 'Échec',
            'rembourse' => 'Remboursé',
            default => 'Inconnu'
        };
    }

    public function getTypeLibelleAttribute()
    {
        return match($this->type_paiement) {
            'acompte' => 'Acompte',
            'solde' => 'Solde',
            'caution' => 'Caution',
            'total' => 'Paiement total',
            default => 'Inconnu'
        };
    }

    public function getMethodeLibelleAttribute()
    {
        return match($this->methode_paiement) {
            'orange_money' => 'Orange Money',
            'mtn_money' => 'MTN Mobile Money',
            'carte_bancaire' => 'Carte bancaire',
            'virement' => 'Virement bancaire',
            'especes' => 'Espèces',
            default => 'Inconnu'
        };
    }

    // Scopes
    public function scopeReussi($query)
    {
        return $query->where('statut', 'reussi');
    }

    public function scopeEnAttente($query)
    {
        return $query->where('statut', 'en_attente');
    }
}