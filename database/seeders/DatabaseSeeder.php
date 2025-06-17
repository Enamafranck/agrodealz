<?php

namespace Database\Seeders;

use App\Models\Annonces;
use App\Models\agriculteur;
use App\Models\materiel;
use App\Models\proprietaire;
use App\Models\administrateur;
use Database\Factories\AnnoncesFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
    
        // User::factory(10)->create();

        
        agriculteur::factory(10)->create();
        proprietaire::factory(20)->create();
       administrateur::factory(20)->create();
        annonces::factory(20)->create();

    // Puis créer vos données
    \App\Models\Proprietaire::factory(20)->create();
    \App\Models\agriculteur::factory(20)->create();
    \App\Models\administrateur::factory(20)->create();
    \App\Models\annonces::factory(20)->create();
    
   
}
    
        // Dans votre DatabaseSeeder.php

      
   
    
}
