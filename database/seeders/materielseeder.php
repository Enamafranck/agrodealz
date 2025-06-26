<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\materiel;

class materielseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         materiel::factory(20)->create();
    }
}
