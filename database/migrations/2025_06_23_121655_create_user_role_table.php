<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
           
            $table->unsignedBigInteger('iduser');
            $table->unsignedBigInteger('role_id');

            // Clés étrangères
            $table->foreign('iduser')->references('iduser')->on('user')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
