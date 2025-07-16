<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 10, 2); // Montant payé
            $table->enum('type_paiement', ['acompte', 'solde', 'caution', 'total'])->default('total');
            $table->enum('methode_paiement', ['orange_money', 'mtn_money', 'carte_bancaire', 'virement', 'especes']);
            $table->enum('statut', ['en_attente', 'reussi', 'echoue', 'rembourse'])->default('en_attente');
            $table->string('reference_transaction')->nullable(); // Référence de la plateforme de paiement
            $table->string('numero_telephone')->nullable(); // Pour mobile money
            $table->text('notes')->nullable(); // Notes administratives
            $table->timestamp('date_paiement')->nullable(); // Date effective du paiement
            $table->timestamps();
            
            // Index pour optimiser les requêtes
            $table->index(['reservation_id', 'statut']);
            $table->index('reference_transaction');
        });
    }

    public function down()
    {
        Schema::dropIfExists('paiements');
    }
};