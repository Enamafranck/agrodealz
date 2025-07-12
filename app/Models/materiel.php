<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materiel extends Model
{
    use HasFactory;

    protected $table = 'materiel';
    protected $primaryKey = 'idmateriel';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'idannonces',
        'nom',
        'marque',
        'description',
        'disponibilite',
        'etat',
        'prix_location',
        'caution'
    ];

    protected $casts = [
        'idmateriel' => 'integer',
        'idannonces' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    

    /**
     * Relation avec le model Annonces
     */
    public function annonce()
    {
        return $this->belongsTo(Annonces::class, 'idannonces', 'idannonces');
    }

    /**
     * Accessor pour formater le prix de location
     */
    public function getFormattedPrixLocationAttribute()
    {
        // Si le prix est numérique, on le formate
        if (is_numeric($this->prix_location)) {
            return number_format($this->prix_location, 0, ',', ' ') . ' FCFA';
        }
        return $this->prix_location;
    }

    /**
     * Accessor pour formater la caution
     */
    public function getFormattedCautionAttribute()
    {
        // Si la caution est numérique, on la formate
        if (is_numeric($this->caution)) {
            return number_format($this->caution, 0, ',', ' ') . ' FCFA';
        }
        return $this->caution;
    }

    /**
     * Accessor pour obtenir le nom complet (nom + marque)
     */
    public function getNomCompletAttribute()
    {
        return $this->nom . ' - ' . $this->marque;
    }

    /**
     * Scope pour filtrer les matériels disponibles
     */
    public function scopeDisponible($query)
    {
        return $query->where('disponibilite', 'disponible');
    }

    /**
     * Scope pour filtrer par état
     */
    public function scopeParEtat($query, $etat)
    {
        return $query->where('etat', $etat);
    }

    /**
     * Scope pour filtrer par marque
     */
    public function scopeParMarque($query, $marque)
    {
        return $query->where('marque', $marque);
    }

    /**
     * Scope pour rechercher par nom ou marque
     */
    public function scopeRechercher($query, $terme)
    {
        return $query->where(function ($q) use ($terme) {
            $q->where('nom', 'LIKE', '%' . $terme . '%')
              ->orWhere('marque', 'LIKE', '%' . $terme . '%')
              ->orWhere('description', 'LIKE', '%' . $terme . '%');
        });
    }

    /**
     * Vérifier si le matériel est disponible
     */
    public function estDisponible()
    {
        return $this->disponibilite === 'disponible';
    }

    /**
     * Vérifier si le matériel est en bon état
     */
    public function estEnBonEtat()
    {
        return $this->etat === 'bon';
    }

    /**
     * Obtenir les états possibles
     */
    public static function getEtatsPossibles()
    {
        return [
            'bon' => 'Bon état',
            'moyen' => 'État moyen',
            'mauvais' => 'Mauvais état',
            'maintenance' => 'En maintenance'
        ];
    }

    /**
     * Obtenir les disponibilités possibles
     */
    public static function getDisponibilitesPossibles()
    {
        return [
            'disponible' => 'Disponible',
            'loue' => 'Loué',
            'maintenance' => 'En maintenance',
            'indisponible' => 'Indisponible'
        ];
    }

    /**
     * Mutator pour s'assurer que la disponibilité est valide
     */
    public function setDisponibiliteAttribute($value)
    {
        $disponibilites = array_keys(self::getDisponibilitesPossibles());
        $this->attributes['disponibilite'] = in_array($value, $disponibilites) ? $value : 'disponible';
    }

    /**
     * Mutator pour s'assurer que l'état est valide
     */
    public function setEtatAttribute($value)
    {
        $etats = array_keys(self::getEtatsPossibles());
        $this->attributes['etat'] = in_array($value, $etats) ? $value : 'bon';
    }
}