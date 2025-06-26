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
        Schema::create('demande', function (Blueprint $table) {
            $table->unsignedBigInteger("iddemande")->primary()->autoIncrement();
            $table->unsignedBigInteger('idannonces')->nullable();
            $table->unsignedBigInteger("idproprietaire");
            $table->unsignedBigInteger("idagriculteur");
            $table->string("statut Enum");
            $table->date('date_demande');
            $table->string('message');
            $table->timestamps();
            $table->foreign('idannonces')->references('idannonces')->on('annonces')->onDelete('cascade');
            $table->foreign('idproprietaire')->references('idproprietaire')->on('proprietaire')->onDelete('cascade');
            $table->foreign('idagriculteur')->references('idagriculteur')->on('agriculteur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande');
    }
};
