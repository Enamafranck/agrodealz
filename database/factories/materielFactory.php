<?php

namespace Database\Factories;
use App\Models\Annonces;
use App\models\materiel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class materielfactory extends Factory
{

   protected $model = materiel::class;
   
    /**
     *
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            
          "idannonces" => annonces::inRandomOrder()->first()->idannonces,

           "nom" => $this->faker->randomElement(['Tracteur', 'Moissonneuse-batteuse', 'Charrue', 'Herse', 'Semoir', 'Pulvérisateur', 'Épandeur d\'engrais', 'Faucheuse', 'Bineuse', 'Cultivateur', 'Motoculteur', 'Débroussailleuse', 'Tronçonneuse']),

           "marque" => $this->faker->randomElement(['John Deere', 'Massey Ferguson', 'Case IH', 'New Holland', 'Kubota', 'Fendt', 'Claas', 'Deutz-Fahr', 'Valtra', 'Same']),

           "description" => function (array $attributes) { $descriptions = ['Tracteur' => 'Tracteur agricole robuste de ' . $this->faker->numberBetween(40, 150) . ' CV, équipé d\'une transmission hydrostatique, cabine climatisée, relevage hydraulique 3 points, prise de force 540/1000 tr/min. Idéal pour tous travaux agricoles : labour, hersage, transport.', 'Moissonneuse-batteuse' => 'Moissonneuse-batteuse performante avec largeur de coupe de ' . $this->faker->numberBetween(4, 8) . 'm, trémie de ' . $this->faker->numberBetween(6000, 12000) . 'L, système de battage moderne, cabine ergonomique. Parfaite pour la récolte de céréales.', 'Charrue' => 'Charrue réversible ' . $this->faker->numberBetween(3, 6) . ' socs, largeur de travail ' . $this->faker->numberBetween(2, 4) . 'm, réglage hydraulique, socs en acier trempé. Excellent pour le labour profond et la préparation du sol.', 'Herse' => 'Herse rotative de ' . $this->faker->numberBetween(2, 4) . 'm de largeur, ' . $this->faker->numberBetween(24, 48) . ' couteaux, transmission par cardans, rouleau packer arrière. Idéale pour l\'émiettement et la préparation fine du sol.', 'Semoir' => 'Semoir de précision ' . $this->faker->numberBetween(4, 12) . ' rangs, espacement réglable, distribution pneumatique, trémie de ' . $this->faker->numberBetween(200, 800) . 'L, marqueurs de rangs. Parfait pour semis de céréales et légumineuses.', 'Pulvérisateur' => 'Pulvérisateur traîné avec cuve de ' . $this->faker->numberBetween(800, 3000) . 'L, rampe de ' . $this->faker->numberBetween(12, 28) . 'm, buses anti-dérive, régulation électronique, rinçage automatique. Efficace pour traitements phytosanitaires.', 'Épandeur d\'engrais' => 'Épandeur d\'engrais centrifuge, trémie de ' . $this->faker->numberBetween(500, 2000) . 'L, largeur d\'épandage ' . $this->faker->numberBetween(10, 36) . 'm, réglage de dose électronique, disques inox. Idéal pour fertilisation précise.', 'Faucheuse' => 'Faucheuse rotative ' . $this->faker->numberBetween(2, 4) . 'm de largeur, ' . $this->faker->numberBetween(4, 8) . ' rotors, lames à changement rapide, protection par boulons cisaillables. Parfaite pour fauche de prairies et fourrages.', 'Bineuse' => 'Bineuse inter-rangs ' . $this->faker->numberBetween(4, 8) . ' éléments, largeur réglable, socs interchangeables, guidage par parallélogramme, protection ressort. Excellente pour désherbage mécanique.', 'Cultivateur' => 'Cultivateur à dents rigides, largeur ' . $this->faker->numberBetween(3, 6) . 'm, ' . $this->faker->numberBetween(9, 21) . ' dents, socs réversibles, rouleau cage arrière. Idéal pour ameublissement et préparation superficielle.', 'Motoculteur' => 'Motoculteur ' . $this->faker->numberBetween(8, 15) . ' CV, transmission par courroies, fraises rotatives, marche avant/arrière, guidon réglable. Parfait pour jardinage et petites surfaces agricoles.', 'Débroussailleuse' => 'Débroussailleuse thermique ' . $this->faker->numberBetween(2, 5) . ' CV, lame métal et fil nylon, harnais ergonomique, démarrage facile, poignée anti-vibrations. Efficace pour entretien des bordures et débroussaillage.', 'Tronçonneuse' => 'Tronçonneuse professionnelle ' . $this->faker->numberBetween(40, 80) . 'cm³, guide ' . $this->faker->numberBetween(35, 70) . 'cm, système anti-vibrations, frein de chaîne, démarrage assisté. Idéale pour élagage et abattage.']; return $descriptions[$attributes['nom']] ?? 'Équipement agricole de qualité professionnelle, entretenu régulièrement et prêt à l\'emploi pour vos travaux agricoles.'; },

           "disponibilite" => $this->faker->boolean(80),

           "etat" => $this->faker->randomElement(['Neuf', 'Bon état', 'Usagé', 'À réparer']),

           "prix_location" => function (array $attributes) { $prix = ['Tracteur' => $this->faker->numberBetween(25000, 75000), 'Moissonneuse-batteuse' => $this->faker->numberBetween(80000, 150000), 'Charrue' => $this->faker->numberBetween(8000, 20000), 'Herse' => $this->faker->numberBetween(10000, 25000), 'Semoir' => $this->faker->numberBetween(15000, 35000), 'Pulvérisateur' => $this->faker->numberBetween(20000, 50000), 'Épandeur d\'engrais' => $this->faker->numberBetween(12000, 30000), 'Faucheuse' => $this->faker->numberBetween(15000, 35000), 'Bineuse' => $this->faker->numberBetween(8000, 18000), 'Cultivateur' => $this->faker->numberBetween(10000, 25000), 'Motoculteur' => $this->faker->numberBetween(5000, 15000), 'Débroussailleuse' => $this->faker->numberBetween(3000, 8000), 'Tronçonneuse' => $this->faker->numberBetween(2000, 6000)]; return ($prix[$attributes['nom']] ?? $this->faker->numberBetween(5000, 30000)) . ' FCFA'; },

           "caution" => function (array $attributes) { $prixBase = (int) str_replace(' FCFA', '', $attributes['prix_location']); $caution = $prixBase * $this->faker->randomFloat(1, 2, 5); return number_format($caution, 0, ',', ' ') . ' FCFA'; }
        ];

    }
}
