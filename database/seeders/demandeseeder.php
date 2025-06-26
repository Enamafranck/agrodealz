<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\demande;

class demandeseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          demande::factory(10)->create();
    }
}
