<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB:: table("role")->insert([
            ["role"=>"agriculteur"],
             ["role"=>"proprietaire"],
              ["role"=>"administrateur"],
               ]);
     
           
         
    }
}
