<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\proprietaire;

class proprietaireseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         proprietaire::factory(20)->create();
    }
}
