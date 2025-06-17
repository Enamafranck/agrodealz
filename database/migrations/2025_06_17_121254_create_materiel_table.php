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
        Schema::create('materiel', function (Blueprint $table) {
            $table->unsignedBigInteger("idmateriel")->primary()->autoIncrement();
            $table->unsignedBigInteger('idannonces');
            $table->string('nom');
            $table->string('marque');
            $table->text('description');
            $table->string('disponibilite');
             $table->string('etat');
              $table->string('prix_location');
               $table->string('caution');
            $table->timestamps();

            $table->foreign('idannonces')->references('idannonces')->on('annonces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiel');
    }
};