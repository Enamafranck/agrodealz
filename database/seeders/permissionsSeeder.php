<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB:: table("permissions")->insert([
            ["name"=>"ajouter un agriculteur"],
             ["name"=>"consulter un agriculteur"],
              ["name"=>"editer un agriculteur"],

              
            ["name"=>"ajouter une location"],
             ["name"=>"consulter une location"],
              ["name"=>"editer une location"],

               ["name"=>"ajouter un matériel"],
             ["name"=>"consulter un matériel"],
              ["name"=>"editer un matériel"],
        ]);
    }
}
