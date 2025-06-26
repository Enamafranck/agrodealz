<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use App\Models\user_role;

class userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user::factory(20)->create();
        user:: find(1)->role()->attach(1);
        user:: find(2)->role()->attach(2);
        user:: find(3)->role()->attach(3);
        user:: find(7)->role()->attach(3);
       
}
}
