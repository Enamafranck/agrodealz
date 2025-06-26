<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::table('user', function (Blueprint $table) {
        $table->string('sexe')->fake()->randomElement(['Homme', 'Femme', 'Autre'])->after('nom_complet'); // ou après un autre champ
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('user', function (Blueprint $table) {
        $table->dropColumn('sexe');
    });
    }
};
