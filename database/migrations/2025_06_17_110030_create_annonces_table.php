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
        Schema::create('annonces', function (Blueprint $table) {
           $table->unsignedBigInteger("idannonces")->primary()->autoIncrement();
            $table->unsignedBigInteger('idproprietaire');
            $table->text('description');
            $table->date('date_publication');
            $table->date('date_expiration');
            $table->timestamps();

               $table->foreign('idproprietaire')->references('idproprietaire')->on('proprietaire')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
