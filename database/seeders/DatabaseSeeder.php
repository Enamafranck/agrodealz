<?php

namespace Database\Seeders;

use App\Models\user;
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
       
       // 1. D'abord créer les rôles
    $this->call(roleSeeder::class);
    
    // 2. Ensuite créer les utilisateurs
    $this->call(UserSeeder::class);
    
    // 3. Enfin créer les relations (si vous avez un seeder séparé)
        $this->call(user_roleSeeder::class);
    

    
         User::factory(20)->create();

        
        agriculteur::factory(10)->create();
        proprietaire::factory(20)->create();
       administrateur::factory(20)->create();
        annonces::factory(20)->create();

        user:: find(1)->role()->attach(1);
        user:: find(2)->role()->attach(2);
        user:: find(3)->role()->attach(3);

    // Puis créer vos données
    \App\Models\Proprietaire::factory(20)->create();
    \App\Models\agriculteur::factory(20)->create();
    \App\Models\administrateur::factory(20)->create();
    \App\Models\annonces::factory(20)->create();
    
   
}
    
        // Dans votre DatabaseSeeder.php

      

   
   
    
}
