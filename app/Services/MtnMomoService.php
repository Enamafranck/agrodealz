@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="fas fa-check-circle"></i> Paiement initié
                    </h3>
                </div>
                
                <div class="card-body text-center">
                    @if($paiement->methode_paiement == 'orange_money')
                        <i class="fas fa-mobile-alt fa-4x text-orange mb-3"></i>
                        <h4>Paiement Orange Money</h4>
                        <p class="lead">Vous allez recevoir un SMS sur le numéro <strong>{{ $paiement->numero_telephone }}</strong></p>
                        <div class="alert alert-info">
                            <strong>Instructions:</strong><br>
                            1. Vous recevrez un SMS avec le code de transaction<br>
                            2. Composez le code reçu pour confirmer le paiement<br>
                            3. Le paiement sera automatiquement validé une fois confirmé
                        </div>
                        
                    @elseif($paiement->methode_paiement == 'mtn_momo')
                        <i class="fas fa-mobile-alt fa-4x text-warning mb-3"></i>
                        <h4>Paiement MTN Mobile Money</h4>
                        <p class="lead">Vous allez recevoir un SMS sur le numéro <strong>{{ $paiement->numero_telephone }}</strong></p>
                        <div class="alert alert-info">
                            <strong>Instructions:</strong><br>
                            1. Vous recevrez un SMS avec le code de transaction<br>
                            2. Composez le code reçu pour confirmer le paiement<br>
                            3. Le paiement sera automatiquement validé une fois confirmé
                        </div>
                        
                    @elseif($paiement->methode_paiement == 'especes')
                        <i class="fas fa-money-bill-wave fa-4x text-success mb-3"></i>
                        <h4>Paiement en espèces</h4>
                        <p class="lead">Paiement enregistré, en attente de validation</p>
                        <div class="alert alert-warning">
                            <strong>Note:</strong> Ce paiement sera validé manuellement par notre équipe une fois les espèces reçues.
                        </div>
                    @endif

                    <!-- Détails du paiement -->
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Détails du paiement</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Référence:</strong> {{ $paiement->reference }}</p>
                                    <p><strong>Montant:</strong> {{ number_format($paiement->montant, 2) }} FCFA</p>
                                    <p><strong>Méthode:</strong> {{ ucfirst(str_replace('_', ' ', $paiement->methode_paiement)) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date:</strong> {{ $paiement->created_at->format('d/m/Y à H:i') }}</p>
                                    <p><strong>Statut:</strong> 
                                        <span class="badge bg-warning">{{ ucfirst($paiement->statut) }}</span>
                                    </p>
                                    <p><strong>Réservation:</strong> #{{ $paiement->reservation_id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-4">
                        <a href="{{ route('reservations.show', $paiement->reservation) }}" class="btn btn-primary">
                            <i class="fas fa-eye"></i> Voir la réservation
                        </a>
                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list"></i> Mes réservations
                        </a>
                    </div>

                    <!-- Statut en temps réel -->
                    <div class="mt-4">
                        <div id="payment-status" class="alert alert-info">
                            <i class="fas fa-spinner fa-spin"></i> Vérification du statut du paiement...
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.text-orange {
    color: #ff6600 !important;
}
</style>

<script>
// Vérification du statut du paiement toutes les 10 secondes
setInterval(function() {
    fetch(`/paiements/{{ $paiement->id }}/statut`)
        .then(response => response.json())
        .then(data => {
            const statusDiv = document.getElementById('payment-status');
            if (data.statut === 'valide') {
                statusDiv.className = 'alert alert-success';
                statusDiv.innerHTML = '<i class="fas fa-check-circle"></i> Paiement confirmé avec succès !';
                
                // Rediriger après 3 secondes
                setTimeout(() => {
                    window.location.href = '{{ route("reservations.show", $paiement->reservation) }}';
                }, 3000);
            } else if (data.statut === 'echoue') {
                statusDiv.className = 'alert alert-danger';
                statusDiv.innerHTML = '<i class="fas fa-times-circle"></i> Paiement échoué. Veuillez réessayer.';
            } else {
                statusDiv.className = 'alert alert-info';
                statusDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Paiement en cours de traitement...';
            }
        })
        .catch(error => {
            console.error('Erreur lors de la vérification du statut:', error);
        });
}, 10000); // Vérifier toutes les 10 secondes
</script>
@endsection