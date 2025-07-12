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
    protected $primaryKey = 'idmateriel';


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

}
