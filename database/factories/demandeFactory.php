<?php

namespace Database\Factories;

use App\Models\demande;
use App\Models\Annonce;
use App\Models\Agriculteur;
use App\Models\annonces;
use App\Models\Proprietaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeFactory extends Factory
{
    protected $model = Demande::class;

    public function definition()
    {
        // Récupérer une annonce existante ou en créer une
        $annonce = annonces::inRandomOrder()->first() ?? annonces::factory()->create();
        
        // S'assurer qu'il y a des agriculteurs dans la base, sinon en créer
        if (Agriculteur::count() == 0) {
            Agriculteur::factory()->count(5)->create();
        }
        
        // Récupérer un agriculteur existant de la table agriculteurs
        $agriculteur = Agriculteur::inRandomOrder()->first();
        
        // Utiliser le même idproprietaire que celui de l'annonce sélectionnée
        $idproprietaire = $annonce->idproprietaire;

        return [
            'idannonces' =>annonces::inRandomOrder()->first()->idannonces,
            'idagriculteur' => Agriculteur::inRandomOrder()->first()->idagriculteur, // ID qui existe réellement dans la table agriculteurs
            'idproprietaire' => Proprietaire::inRandomOrder()->first()->idproprietaire,
            'statut Enum' => $this->faker->randomElement(['en_attente', 'acceptee', 'refusee']),
            'date_demande' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'message' => $request->message ?? 'je souhaite louer ce materiel',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Factory avec un agriculteur spécifique
     */
    public function withAgriculteur($agriculteurId)
    {
        return $this->state(function (array $attributes) use ($agriculteurId) {
            // Vérifier que l'agriculteur existe
            $agriculteur = Agriculteur::find($agriculteurId);
            if (!$agriculteur) {
                throw new \Exception("Agriculteur avec l'ID {$agriculteurId} n'existe pas");
            }

            return [
                'idagriculteur' => $agriculteurId,
            ];
        });
    }

    /**
     * Factory avec un propriétaire spécifique
     */
    public function withProprietaire($proprietaireId)
    {
        return $this->state(function (array $attributes) use ($proprietaireId) {
            // Trouver une annonce de ce propriétaire ou en créer une
            $annonce = annonces::where('idproprietaire', $proprietaireId)->inRandomOrder()->first()
                ?? annonces::factory()->create(['idproprietaire' => $proprietaireId]);

            return [
                'idannonce' => $annonce->id,
                'idproprietaire' => $proprietaireId,
            ];
        });
    }

    /**
     * Factory avec une annonce spécifique
     */
    public function withAnnonce($annonceId)
    {
        return $this->state(function (array $attributes) use ($annonceId) {
            $annonce = annonces::find($annonceId);
            
            return [
                'idannonce' => $annonceId,
                'idproprietaire' => $annonce->idproprietaire,
            ];
        });
    }
}

