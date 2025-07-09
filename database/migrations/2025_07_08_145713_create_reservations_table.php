<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materiel_id');
            $table->unsignedBigInteger('user_id'); // ou client_id selon votre système
            $table->string('nom_client');
            $table->string('email_client');
            $table->string('telephone_client');
            $table->string('adresse_client');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->integer('duree_jours');
            $table->decimal('prix_unitaire', 10, 2);
            $table->decimal('sous_total', 10, 2);
            $table->decimal('caution', 10, 2);
            $table->decimal('tva', 10, 2)->default(0);
            $table->decimal('total_ttc', 10, 2);
            $table->enum('statut', ['en_attente', 'confirmee', 'en_cours', 'terminee', 'annulee'])->default('en_attente');
            $table->enum('statut_paiement', ['non_paye', 'acompte', 'paye', 'rembourse'])->default('non_paye');
            $table->text('commentaires')->nullable();
            $table->json('conditions_acceptees');
            $table->timestamps();

            $table->foreign('materiel_id')->references('id')->on('materiels');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }

};
