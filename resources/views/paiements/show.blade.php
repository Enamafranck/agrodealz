@extends('layouts.app')

@section('title', 'Paiement de la réservation')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Paiement de la réservation #{{ $reservation->numero_reservation }}</h4>
                </div>
                <div class="card-body">
                    <!-- Informations sur la réservation -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Détails de la réservation</h5>
                            <p><strong>Numéro:</strong> {{ $reservation->numero_reservation }}</p>
                            <p><strong>Client:</strong> {{ $reservation->client->nom }} {{ $reservation->client->prenom }}</p>
                            <p><strong>Véhicule:</strong> {{ $reservation->vehicule->marque }} {{ $reservation->vehicule->modele }}</p>
                            <p><strong>Période:</strong> {{ $reservation->date_debut->format('d/m/Y') }} au {{ $reservation->date_fin->format('d/m/Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Détails financiers</h5>
                            <p><strong>Montant total:</strong> {{ number_format($reservation->total_ttc, 2) }} FCFA</p>
                            <p><strong>Montant payé:</strong> {{ number_format($reservation->montant_paye, 2) }} FCFA</p>
                            <p><strong>Reste à payer:</strong> <span class="text-danger">{{ number_format($reservation->montant_restant, 2) }} FCFA</span></p>
                            <p><strong>Acompte minimum:</strong> {{ number_format($reservation->montant_acompte_minimum, 2) }} FCFA</p>
                        </div>
                    </div>

                    <!-- Historique des paiements -->
                    @if($reservation->paiements->count() > 0)
                        <div class="mb-4">
                            <h5>Historique des paiements</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Montant</th>
                                            <th>Méthode</th>
                                            <th>Statut</th>
                                            <th>Référence</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservation->paiements as $paiement)
                                            <tr>
                                                <td>{{ $paiement->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ number_format($paiement->montant, 2) }} FCFA</td>
                                                <td>{{ ucfirst(str_replace('_', ' ', $paiement->methode_paiement)) }}</td>
                                                <td>
                                                    @if($paiement->statut === 'reussi')
                                                        <span class="badge bg-success">Réussi</span>
                                                    @elseif($paiement->statut === 'en_attente')
                                                        <span class="badge bg-warning">En attente</span>
                                                    @else
                                                        <span class="badge bg-danger">Échec</span>
                                                    @endif
                                                </td>
                                                <td>{{ $paiement->reference_transaction }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <!-- Formulaire de paiement -->
                    @if($reservation->montant_restant > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5>Effectuer un paiement</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('paiements.store', $reservation) }}" method="POST" id="paiementForm">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="type_paiement" class="form-label">Type de paiement</label>
                                                <select class="form-select" id="type_paiement" name="type_paiement" required>
                                                    <option value="">Sélectionnez le type</option>
                                                    <option value="acompte">Acompte (minimum {{ number_format($reservation->montant_acompte_minimum, 2) }} FCFA)</option>
                                                    <option value="total">Paiement total ({{ number_format($reservation->montant_restant, 2) }} FCFA)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="montant" class="form-label">Montant (FCFA)</label>
                                                <input type="number" class="form-control" id="montant" name="montant" 
                                                       min="{{ $reservation->montant_acompte_minimum }}" 
                                                       max="{{ $reservation->montant_restant }}" 
                                                       step="0.01" required>
                                                <div class="form-text">
                                                    Montant minimum: {{ number_format($reservation->montant_acompte_minimum, 2) }} FCFA<br>
                                                    Montant maximum: {{ number_format($reservation->montant_restant, 2) }} FCFA
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="methode_paiement" class="form-label">Méthode de paiement</label>
                                        <select class="form-select" id="methode_paiement" name="methode_paiement" required>
                                            <option value="">Sélectionnez une méthode</option>
                                            <option value="orange_money">Orange Money</option>
                                            <option value="mtn_money">MTN Money</option>
                                            <option value="carte_bancaire">Carte bancaire</option>
                                            <option value="virement">Virement bancaire</option>
                                            <option value="especes">Espèces</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" id="numero_telephone_group" style="display: none;">
                                        <label for="numero_telephone" class="form-label">Numéro de téléphone</label>
                                        <input type="text" class="form-control" id="numero_telephone" name="numero_telephone" 
                                               placeholder="Exemple: 237698765432">
                                        <div class="form-text">
                                            Numéro de téléphone pour le paiement mobile money
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-credit-card"></i> Procéder au paiement
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i> Cette réservation est entièrement payée.
                        </div>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour aux réservations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typePaiement = document.getElementById('type_paiement');
    const montantInput = document.getElementById('montant');
    const methodePaiement = document.getElementById('methode_paiement');
    const numeroTelephoneGroup = document.getElementById('numero_telephone_group');
    const numeroTelephoneInput = document.getElementById('numero_telephone');

    // Gérer le changement de type de paiement
    typePaiement.addEventListener('change', function() {
        const montantRestant = {{ $reservation->montant_restant }};
        const montantAcompte = {{ $reservation->montant_acompte_minimum }};
        
        if (this.value === 'total') {
            montantInput.value = montantRestant;
            montantInput.readOnly = true;
        } else {
            montantInput.value = '';
            montantInput.readOnly = false;
            montantInput.min = montantAcompte;
        }
    });

    // Gérer le changement de méthode de paiement
    methodePaiement.addEventListener('change', function() {
        const mobileMethods = ['orange_money', 'mtn_money'];
        
        if (mobileMethods.includes(this.value)) {
            numeroTelephoneGroup.style.display = 'block';
            numeroTelephoneInput.required = true;
        } else {
            numeroTelephoneGroup.style.display = 'none';
            numeroTelephoneInput.required = false;
            numeroTelephoneInput.value = '';
        }
    });

    // Validation du formulaire
    document.getElementById('paiementForm').addEventListener('submit', function(e) {
        const montant = parseFloat(montantInput.value);
        const montantRestant = {{ $reservation->montant_restant }};
        const montantAcompte = {{ $reservation->montant_acompte_minimum }};
        
        if (montant > montantRestant) {
            e.preventDefault();
            alert('Le montant ne peut pas être supérieur au montant restant.');
            return;
        }
        
        if (typePaiement.value === 'acompte' && montant < montantAcompte) {
            e.preventDefault();
            alert('L\'acompte minimum est de ' + montantAcompte.toLocaleString() + ' FCFA.');
            return;
        }
        
        // Confirmer le paiement
        if (!confirm('Êtes-vous sûr de vouloir procéder à ce paiement de ' + montant.toLocaleString() + ' FCFA ?')) {
            e.preventDefault();
        }
    });
});
</script>
@endsection