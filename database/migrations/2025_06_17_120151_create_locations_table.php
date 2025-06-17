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
        Schema::create('location', function (Blueprint $table) {
            $table->unsignedBigInteger("idlocation")->primary()->autoIncrement();
            $table->unsignedBigInteger("idagriculteur");
            $table->dateTime('date_debut')->nullable(); // Correction du type
            $table->dateTime('date_fin')->nullable(); // Correction du type
            $table->timestamps(); // Création automatique de created_at et updated_at

             $table->foreign('idagriculteur')->references('idagriculteur')->on('agriculteur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location');
    }
};
