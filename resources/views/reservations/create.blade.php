@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- En-tête -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="fas fa-plus text-primary"></i>
                    Nouvelle Réservation
                </h1>
                <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>

            <!-- Messages d'erreur -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            

            <!-- Formulaire -->
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Informations de réservation</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('reservation.store') }}">
                        @csrf
                        
                        <!-- Sélection du matériel -->
                        <div class="mb-3">
                            <label for="idmateriel" class="form-label">Matériel *</label>
                            <select name="idmateriel" id="idmateriel" class="form-select" required>
                                <option value="">Sélectionner un matériel</option>
                                @foreach($materiels as $mat)
                                    <option value="{{ $mat->idmateriel }}" 
                                            {{ (old('idmateriel') == $mat->idmateriel || (isset($materiel) && $materiel->idmateriel == $mat->idmateriel)) ? 'selected' : '' }}>
                                        {{ $mat->nom }} - {{ number_format((float)$mat->prix_location, 2) }}fcfa/jour
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Informations client -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom_complet" class="form-label">Nom complet *</label>
                                    <input type="text" name="nom_complet" id="nom_complet" 
                                           class="form-control" value="{{ old('nom_complet') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" name="email" id="email" 
                                           class="form-control" value="{{ old('email') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Téléphone *</label>
                                    <input type="tel" name="telephone" id="telephone" 
                                           class="form-control" value="{{ old('telephone') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse *</label>
                                    <textarea name="adresse" id="adresse" 
                                              class="form-control" rows="2" required>{{ old('adresse') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_debut" class="form-label">Date de début *</label>
                                    <input type="date" name="date_debut" id="date_debut" 
                                           class="form-control" value="{{ old('date_debut') }}" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label">Date de fin *</label>
                                    <input type="date" name="date_fin" id="date_fin" 
                                           class="form-control" value="{{ old('date_fin') }}" 
                                           min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Commentaires -->
                        <div class="mb-3">
                            <label for="commentaires" class="form-label">Commentaires</label>
                            <textarea name="commentaires" id="commentaires" 
                                      class="form-control" rows="3" 
                                      placeholder="Informations supplémentaires...">{{ old('commentaires') }}</textarea>
                        </div>

                        <!-- Aperçu des prix -->
                        <div id="prix-apercu" class="card bg-light mb-3" style="display: none;">
                            <div class="card-body">
                                <h6 class="card-title">Aperçu des coûts</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small>Durée: <span id="duree-jours">-</span> jour(s)</small><br>
                                        <small>Prix unitaire: <span id="prix-unitaire">-</span> fcfa</small><br>
                                        <small>Sous-total: <span id="sous-total">-</span> fcfa</small>
                                    </div>
                                    <div class="col-md-6">
                                        <small>TVA (18%): <span id="tva">-</span> fcfa</small><br>
                                        <small>Caution: <span id="caution">-</span> fcfa</small><br>
                                        <strong>Total TTC: <span id="total-ttc">-</span> fcfa</strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Conditions -->
                        <div class="mb-3">
                            <label class="form-label">Conditions d'utilisation *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="conditions_acceptees[]" value="Je m'engage à utiliser le matériel avec précaution" 
                                       id="condition1" required>
                                <label class="form-check-label" for="condition1">
                                    Je m'engage à utiliser le matériel avec précaution
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="conditions_acceptees[]" value="Je suis responsable des dommages causés" 
                                       id="condition2" required>
                                <label class="form-check-label" for="condition2">
                                    Je suis responsable des dommages causés
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="conditions_acceptees[]" value="J'accepte les conditions de location" 
                                       id="condition3" required>
                                <label class="form-check-label" for="condition3">
                                    J'accepte les conditions générales de location
                                </label>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('reservations.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Annuler
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Créer la réservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const materielSelect = document.getElementById('idmateriel');
    const dateDebut = document.getElementById('date_debut');
    const dateFin = document.getElementById('date_fin');
    const prixApercu = document.getElementById('prix-apercu');

    function calculerPrix() {
        if (materielSelect.value && dateDebut.value && dateFin.value) {
            fetch('/api/calculer-prix', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    materiel_id: materielSelect.value,
                    date_debut: dateDebut.value,
                    date_fin: dateFin.value
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('duree-jours').textContent = data.duree_jours;
                document.getElementById('prix-unitaire').textContent = data.prix_unitaire;
                document.getElementById('sous-total').textContent = data.sous_total;
                document.getElementById('tva').textContent = data.tva;
                document.getElementById('caution').textContent = data.caution;
                document.getElementById('total-ttc').textContent = data.total_ttc;
                prixApercu.style.display = 'block';
            })
            .catch(error => {
                console.error('Erreur:', error);
                prixApercu.style.display = 'none';
            });
        } else {
            prixApercu.style.display = 'none';
        }
    }

    materielSelect.addEventListener('change', calculerPrix);
    dateDebut.addEventListener('change', calculerPrix);
    dateFin.addEventListener('change', calculerPrix);

    // Validation des dates
    dateDebut.addEventListener('change', function() {
        dateFin.min = dateDebut.value;
        if (dateFin.value && dateFin.value < dateDebut.value) {
            dateFin.value = dateDebut.value;
        }
    });
});
</script>
@endsection