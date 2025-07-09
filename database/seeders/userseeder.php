<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\user;
use App\Models\role;
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
        user:: find(1)->roles()->attach(1);
        user:: find(2)->roles()->attach(2);
        user:: find(3)->roles()->attach(3);
        user:: find(4)->roles()->attach(4);
         user:: find(5)->roles()->attach(5);
        user:: find(6)->roles()->attach(6);
       
}
}
