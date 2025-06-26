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
        Schema::create('payement', function (Blueprint $table) {
            $table->unsignedBigInteger('idpayement')->primary()->autoIncrement();
             $table->unsignedBigInteger("idagriculteur");
            $table->double("montantPaye");
            $table->dateTime("datePayement");
             $table->timestamps();

            $table->foreign('idagriculteur')->references('idagriculteur')->on('agriculteur')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payement');
    }
};
