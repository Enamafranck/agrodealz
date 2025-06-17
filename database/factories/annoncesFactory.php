<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proprietaire;
use App\Models\annonces;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\annonce>
 */
class AnnoncesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idproprietaire' => Proprietaire::inRandomOrder()->first()->idproprietaire,
            'description' => fake()->randomElement(['Tracteur John Deere 75CV en excellent état, parfait pour les travaux de labour et de culture. Entretien régulier effectué, pneus neufs, cabine climatisée. Idéal pour exploitations de 50 à 100 hectares. Consommation réduite et fiabilité garantie.', 'Moissonneuse-batteuse récente avec barre de coupe 6m, trémie de grande capacité. Parfaite pour récolte céréales et légumineuses. Système GPS intégré, maintenance à jour. Rendement optimal et grain de qualité assurés.', 'Charrue réversible 4 corps, réglage hydraulique, idéale pour tous types de sols. Structure robuste en acier traité, socs et versoirs en parfait état. Permet un labour profond et régulier pour préparer vos semis.', 'Pulvérisateur traîné 2000L avec rampe 18m, système anti-dérive, pompe haute performance. Parfait pour traitements phytosanitaires précis. Cuve en polyéthylène, rinçage automatique, conforme aux normes environnementales.', 'Semoir pneumatique 24 rangs avec distributeur d\'engrais intégré. Dosage précis, enfouissement réglable, marqueurs hydrauliques. Idéal pour semis de précision maïs, tournesol et soja. Rendement et régularité garantis.', 'Herse rotative 3m avec rouleau packer, parfaite pour préparation de lit de semences. Dents forgées résistantes, transmission par cardan. Travail du sol efficace et régulier pour tous types de cultures.', 'Faucheuse conditionneuse 2,80m, coupe nette et conditionnement optimal du fourrage. Barres de coupe affûtées, conditionneur à fléaux. Idéale pour foin de qualité, séchage rapide garanti.', 'Bineuse 12 rangs avec guidage caméra, désherbage mécanique écologique. Socs interchangeables, réglage précis, buttage possible. Solution durable pour cultures sarclées sans herbicides.', 'Épandeur d\'engrais 2000kg, distribution uniforme, largeur variable 12-36m. Disques inox, dosage précis, bâche de protection incluse. Idéal pour fertilisation optimale de vos cultures.', 'Remorque agricole basculante 12T, essieux renforcés, système hydraulique performant. Benne acier haute résistance, ridelles amovibles. Parfaite pour transport céréales, engrais et matériaux.']),
            'date_publication' => $this->faker->dateTimeBetween('2025-06-01', '2025-12-31')->format('Y-m-d'),
            'date_expiration' => $this->faker->dateTimeBetween('2026-01-01', '2026-12-31')->format('Y-m-d'),
        ];
    }
}