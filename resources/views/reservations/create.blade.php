{{-- resources/views/reservations/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Nouvelle Réservation</h4>
                        <a href="/" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Messages d'erreur --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="/reservation">
                        @csrf
                        <div class="row">
                            {{-- Sélection du matériel --}}
                            <div class="col-md-6 mb-3">
                                <label for="materiel_id" class="form-label">Matériel <span class="text-danger">*</span></label>
                                <select name="materiel_id" id="materiel_id" class="form-select @error('materiel_id') is-invalid @enderror" required>
                                    <option value="">Sélectionnez un matériel</option>
                                    @foreach($materiels as $materiel)
                                        <option value="{{ $materiel->id }}" 
                                                data-prix="{{ $materiel->prix_location }}"
                                                {{ old('materiel_id') == $materiel->id ? 'selected' : '' }}>
                                            {{ $materiel->nom }} - {{ number_format($materiel->prix_location, 2, ',', ' ') }} €/jour
                                        </option>
                                    @endforeach
                                </select>
                                @error('materiel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Utilisateur --}}
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label">Utilisateur</label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                    <option value="">Sélectionnez un utilisateur</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Informations client --}}
                            <div class="col-12 mb-4">
                                <h5 class="border-bottom pb-2">Informations du client</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nom_client" class="form-label">Nom du client <span class="text-danger">*</span></label>
                                <input type="text" name="nom_client" id="nom_client" 
                                       class="form-control @error('nom_client') is-invalid @enderror" 
                                       value="{{ old('nom_client') }}" required>
                                @error('nom_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email_client" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email_client" id="email_client" 
                                       class="form-control @error('email_client') is-invalid @enderror" 
                                       value="{{ old('email_client') }}" required>
                                @error('email_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="telephone_client" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                <input type="tel" name="telephone_client" id="telephone_client" 
                                       class="form-control @error('telephone_client') is-invalid @enderror" 
                                       value="{{ old('telephone_client') }}" required>
                                @error('telephone_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="adresse_client" class="form-label">Adresse <span class="text-danger">*</span></label>
                                <input type="text" name="adresse_client" id="adresse_client" 
                                       class="form-control @error('adresse_client') is-invalid @enderror" 
                                       value="{{ old('adresse_client') }}" required>
                                @error('adresse_client')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Dates et durée --}}
                            <div class="col-12 mb-4">
                                <h5 class="border-bottom pb-2">Période de location</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="date_debut" class="form-label">Date de début <span class="text-danger">*</span></label>
                                <input type="date" name="date_debut" id="date_debut" 
                                       class="form-control @error('date_debut') is-invalid @enderror" 
                                       value="{{ old('date_debut') }}" required>
                                @error('date_debut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="date_fin" class="form-label">Date de fin <span class="text-danger">*</span></label>
                                <input type="date" name="date_fin" id="date_fin" 
                                       class="form-control @error('date_fin') is-invalid @enderror" 
                                       value="{{ old('date_fin') }}" required>
                                @error('date_fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="duree_jours" class="form-label">Durée (jours)</label>
                                <input type="number" name="duree_jours" id="duree_jours" 
                                       class="form-control @error('duree_jours') is-invalid @enderror" 
                                       value="{{ old('duree_jours') }}" readonly>
                                @error('duree_jours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Calculs financiers --}}
                            <div class="col-12 mb-4">
                                <h5 class="border-bottom pb-2">Calculs financiers</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="prix_unitaire" class="form-label">Prix unitaire (€/jour)</label>
                                <input type="number" name="prix_unitaire" id="prix_unitaire" 
                                       class="form-control @error('prix_unitaire') is-invalid @enderror" 
                                       value="{{ old('prix_unitaire') }}" step="0.01" readonly>
                                @error('prix_unitaire')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="sous_total" class="form-label">Sous-total (€)</label>
                                <input type="number" name="sous_total" id="sous_total" 
                                       class="form-control @error('sous_total') is-invalid @enderror" 
                                       value="{{ old('sous_total') }}" step="0.01" readonly>
                                @error('sous_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="caution" class="form-label">Caution (€) <span class="text-danger">*</span></label>
                                <input type="number" name="caution" id="caution" 
                                       class="form-control @error('caution') is-invalid @enderror" 
                                       value="{{ old('caution') }}" step="0.01" required>
                                @error('caution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="tva" class="form-label">TVA (€)</label>
                                <input type="number" name="tva" id="tva" 
                                       class="form-control @error('tva') is-invalid @enderror" 
                                       value="{{ old('tva', 0) }}" step="0.01">
                                @error('tva')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="total_ttc" class="form-label">Total TTC (€)</label>
                                <input type="number" name="total_ttc" id="total_ttc" 
                                       class="form-control @error('total_ttc') is-invalid @enderror" 
                                       value="{{ old('total_ttc') }}" step="0.01" readonly>
                                @error('total_ttc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Statuts --}}
                            <div class="col-12 mb-4">
                                <h5 class="border-bottom pb-2">Statuts</h5>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="statut" class="form-label">Statut de la réservation</label>
                                <select name="statut" id="statut" class="form-select @error('statut') is-invalid @enderror">
                                    <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmee" {{ old('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="en_cours" {{ old('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="terminee" {{ old('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                                    <option value="annulee" {{ old('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                @error('statut')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="statut_paiement" class="form-label">Statut du paiement</label>
                                <select name="statut_paiement" id="statut_paiement" class="form-select @error('statut_paiement') is-invalid @enderror">
                                    <option value="non_paye" {{ old('statut_paiement') == 'non_paye' ? 'selected' : '' }}>Non payé</option>
                                    <option value="acompte" {{ old('statut_paiement') == 'acompte' ? 'selected' : '' }}>Acompte</option>
                                    <option value="paye" {{ old('statut_paiement') == 'paye' ? 'selected' : '' }}>Payé</option>
                                    <option value="rembourse" {{ old('statut_paiement') == 'rembourse' ? 'selected' : '' }}>Remboursé</option>
                                </select>
                                @error('statut_paiement')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Commentaires --}}
                            <div class="col-12 mb-3">
                                <label for="commentaires" class="form-label">Commentaires</label>
                                <textarea name="commentaires" id="commentaires" 
                                          class="form-control @error('commentaires') is-invalid @enderror" 
                                          rows="3">{{ old('commentaires') }}</textarea>
                                @error('commentaires')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Conditions --}}
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('conditions_acceptees') is-invalid @enderror" 
                                           type="checkbox" id="conditions_acceptees" name="conditions_acceptees" 
                                           {{ old('conditions_acceptees') ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="conditions_acceptees">
                                        J'accepte les conditions de location <span class="text-danger">*</span>
                                    </label>
                                    @error('conditions_acceptees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Boutons --}}
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <a href="/" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Annuler
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Créer la réservation
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Calcul automatique des montants
    function calculateAmounts() {
        const materielSelect = document.getElementById('materiel_id');
        const dateDebut = document.getElementById('date_debut');
        const dateFin = document.getElementById('date_fin');
        const dureeInput = document.getElementById('duree_jours');
        const prixUnitaireInput = document.getElementById('prix_unitaire');
        const sousTotalInput = document.getElementById('sous_total');
        const cautionInput = document.getElementById('caution');
        const tvaInput = document.getElementById('tva');
        const totalTtcInput = document.getElementById('total_ttc');

        if (dateDebut.value && dateFin.value) {
            const debut = new Date(dateDebut.value);
            const fin = new Date(dateFin.value);
            const duree = Math.ceil((fin - debut) / (1000 * 60 * 60 * 24));
            
            if (duree > 0) {
                dureeInput.value = duree;
                
                const selectedOption = materielSelect.options[materielSelect.selectedIndex];
                if (selectedOption && selectedOption.dataset.prix) {
                    const prixUnitaire = parseFloat(selectedOption.dataset.prix);
                    prixUnitaireInput.value = prixUnitaire.toFixed(2);
                    
                    const sousTotal = prixUnitaire * duree;
                    sousTotalInput.value = sousTotal.toFixed(2);
                    
                    calculateTotal();
                }
            }
        }
    }

    function calculateTotal() {
        const sousTotal = parseFloat(document.getElementById('sous_total').value) || 0;
        const caution = parseFloat(document.getElementById('caution').value) || 0;
        const tva = parseFloat(document.getElementById('tva').value) || 0;
        const totalTtc = sousTotal + caution + tva;
        document.getElementById('total_ttc').value = totalTtc.toFixed(2);
    }

    // Événements pour le calcul automatique
    document.getElementById('materiel_id').addEventListener('change', calculateAmounts);
    document.getElementById('date_debut').addEventListener('change', calculateAmounts);
    document.getElementById('date_fin').addEventListener('change', calculateAmounts);
    document.getElementById('caution').addEventListener('input', calculateTotal);
    document.getElementById('tva').addEventListener('input', calculateTotal);

    // Définir la date minimale à aujourd'hui
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date_debut').min = today;
    document.getElementById('date_fin').min = today;

    // Assurer que la date de fin est après la date de début
    document.getElementById('date_debut').addEventListener('change', function() {
        document.getElementById('date_fin').min = this.value;
    });
});
</script>
@endsection