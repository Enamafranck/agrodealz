@extends('layouts.app')

@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <h5>Erreurs de validation :</h5>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row p-4 pt-5">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">
                    <i class="fas fa-user-edit me-2"></i> Formulaire d'édition d'utilisateur
                </h3>
            </div>
            
            <!-- CORRECTION PRINCIPALE : Action du formulaire -->
            <form action="{{ route('users.update', $user->iduser) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <!-- Nom complet -->
                    <div class="form-group mb-3">
                        <label for="nom_complet">Nom complet *</label>
                        <input type="text" 
                               class="form-control @error('nom_complet') is-invalid @enderror" 
                               id="nom_complet" 
                               name="nom_complet" 
                               value="{{ old('nom_complet', $user->nom_complet) }}" 
                               required>
                        @error('nom_complet')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email">Email *</label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Téléphone -->
                    <div class="form-group mb-3">
                        <label for="telephone">Téléphone *</label>
                        <input type="tel" 
                               class="form-control @error('telephone') is-invalid @enderror" 
                               id="telephone" 
                               name="telephone" 
                               value="{{ old('telephone', $user->telephone) }}" 
                               placeholder="Ex: +237 6XX XXX XXX"
                               required>
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Sexe -->
                    <div class="form-group mb-3">
                        <label for="sexe">Sexe *</label>
                        <select class="form-control @error('sexe') is-invalid @enderror" 
                                id="sexe" 
                                name="sexe" 
                                required>
                            <option value="">Sélectionner le sexe</option>
                            <option value="homme" {{ old('sexe', $user->sexe) == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('sexe', $user->sexe) == 'femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                        @error('sexe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Photo CNI -->
                    <div class="form-group mb-3">
                        <label for="photo_CNI">Photo CNI</label>
                        @if($user->photo_CNI)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $user->photo_CNI) }}" 
                                     alt="CNI actuelle" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px; max-height: 150px;">
                                <small class="text-muted d-block">Photo CNI actuelle</small>
                            </div>
                        @endif
                        <input type="file" 
                               class="form-control @error('photo_CNI') is-invalid @enderror" 
                               id="photo_CNI" 
                               name="photo_CNI"
                               accept="image/*">
                        <small class="form-text text-muted">
                            Formats acceptés: JPG, PNG, GIF. Taille max: 2MB. 
                            @if($user->photo_CNI) Laisser vide pour conserver la photo actuelle. @endif
                        </small>
                        @error('photo_CNI')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Photo Personne -->
                    <div class="form-group mb-3">
                        <label for="photo_personne">Photo de la personne</label>
                        @if($user->photo_personne)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $user->photo_personne) }}" 
                                     alt="Photo actuelle" 
                                     class="img-thumbnail" 
                                     style="max-width: 200px; max-height: 150px;">
                                <small class="text-muted d-block">Photo actuelle</small>
                            </div>
                        @endif
                        <input type="file" 
                               class="form-control @error('photo_personne') is-invalid @enderror" 
                               id="photo_personne" 
                               name="photo_personne"
                               accept="image/*">
                        <small class="form-text text-muted">
                            Formats acceptés: JPG, PNG, GIF. Taille max: 2MB. 
                            @if($user->photo_personne) Laisser vide pour conserver la photo actuelle. @endif
                        </small>
                        @error('photo_personne')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Mot de passe (optionnel pour la modification) -->
                    <div class="form-group mb-3">
                        <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password"
                               minlength="8">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               minlength="8">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection