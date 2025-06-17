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
        Schema::create('Proprietaire', function (Blueprint $table) { 
            $table->unsignedBigInteger("idproprietaire")->primary()->autoIncrement();
            $table->string('nom_complet');
            $table->string('email')->unique();
            $table->dateTime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('numero_CNI');
            $table->string('telephone');
            $table->string('photo_CNI');
            $table->string('photo de la personne');
            $table->json('materiels')->nullable();
            $table->rememberToken();
            $table->timestamps();
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proprietaire');
    }
};
