@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-credit-card"></i> Paiement de la réservation
                    </h3>
                </div>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                <div class="card-body">
                    <!-- Résumé de la réservation -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-primary">Détails de la réservation</h5>
                            <p><strong>Matériel:</strong> {{ $reservation->materiel->nom }}</p>
                            <p><strong>Client:</strong> {{ $reservation->nom_complet }}</p>
                            <p><strong>Période:</strong> {{ Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }} - {{ Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-primary">Montants</h5>
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Total TTC:</span>
                                    <strong>{{ number_format($reservation->total_ttc, 2) }} FCFA</strong>
                                </div>
                                @if($reservation->statut_paiement == 'acompte')
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Déjà payé:</span>
                                        <span class="text-success">{{ number_format($reservation->paiements->sum('montant'), 2) }} FCFA</span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span><strong>Reste à payer:</strong></span>
                                    <strong class="text-danger">{{ number_format($montant_restant, 2) }} FCFA</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de paiement -->
                    <form method="POST" action="{{ route('paiements.store', $reservation) }}">
                        @csrf
                        
                        <!-- Montant à payer -->
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant à payer</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('montant') is-invalid @enderror" 
                                       id="montant" name="montant" value="{{ old('montant', $montant_restant) }}" 
                                       max="{{ $montant_restant }}" required>
                                <span class="input-group-text">FCFA</span>
                            </div>
                            @error('montant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Méthode de paiement -->
                        <div class="mb-4">
                            <label class="form-label">Méthode de paiement</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card payment-method" data-method="orange_money">
                                        <div class="card-body text-center">
                                            <i class="fas fa-mobile-alt fa-2x text-orange mb-2"></i>
                                            <h6>Orange Money</h6>
                                            <input type="radio" name="methode_paiement" value="orange_money" class="form-check-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card payment-method" data-method="mtn_momo">
                                        <div class="card-body text-center">
                                            <i class="fas fa-mobile-alt fa-2x text-warning mb-2"></i>
                                            <h6>MTN Mobile Money</h6>
                                            <input type="radio" name="methode_paiement" value="mtn_momo" class="form-check-input">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card payment-method" data-method="especes">
                                        <div class="card-body text-center">
                                            <i class="fas fa-money-bill-wave fa-2x text-success mb-2"></i>
                                            <h6>Espèces</h6>
                                            <input type="radio" name="methode_paiement" value="especes" class="form-check-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('methode_paiement')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Champs spécifiques aux méthodes mobiles -->
                        <div id="mobile-fields" class="mb-3" style="display: none;">
                            <label for="numero_telephone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control @error('numero_telephone') is-invalid @enderror" 
                                   id="numero_telephone" name="numero_telephone" value="{{ old('numero_telephone') }}" 
                                   placeholder="Ex: 677123456">
                            @error('numero_telephone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Commentaires -->
                        <div class="mb-3">
                            <label for="commentaires" class="form-label">Commentaires (optionnel)</label>
                            <textarea class="form-control" id="commentaires" name="commentaires" rows="3" 
                                      placeholder="Informations supplémentaires sur le paiement...">{{ old('commentaires') }}</textarea>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i> Procéder au paiement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-method {
    cursor: pointer;
    transition: all 0.3s;
    border: 2px solid #e9ecef;
}

.payment-method:hover {
    border-color: #007bff;
    transform: translateY(-2px);
}

.payment-method.active {
    border-color: #007bff;
    background-color: #f8f9ff;
}

.text-orange {
    color: #ff6600 !important;
}

.form-check-input {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des méthodes de paiement
    const paymentMethods = document.querySelectorAll('.payment-method');
    const mobileFields = document.getElementById('mobile-fields');
    
    paymentMethods.forEach(method => {
        method.addEventListener('click', function() {
            // Désélectionner tous
            paymentMethods.forEach(m => m.classList.remove('active'));
            
            // Sélectionner celui cliqué
            this.classList.add('active');
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            
            // Afficher/masquer champs mobile
            const methodType = this.dataset.method;
            if (methodType === 'orange_money' || methodType === 'mtn_momo') {
                mobileFields.style.display = 'block';
            } else {
                mobileFields.style.display = 'none';
            }
        });
    });
});
</script>
@endsection