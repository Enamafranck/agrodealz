@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- En-tête -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-1">
                        <i class="fas fa-eye text-primary"></i>
                        Détails de la Réservation
                    </h1>
                    <small class="text-muted">Réservation #{{ $reservation->id }}</small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                    @if($reservation->statut == 'en_attente')
                        <form method="POST" action="{{ route('reservations.confirmer', $reservation) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success" onclick="return confirm('Confirmer cette réservation ?')">
                                <i class="fas fa-check"></i> Confirmer
                            </button>
                        </form>
                    @endif
                    @if(in_array($reservation->statut, ['en_attente', 'confirmee']))
                        <form method="POST" action="{{ route('reservations.annuler', $reservation) }}" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Annuler cette réservation ?')">
                                <i class="fas fa-times"></i> Annuler
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Messages de succès/erreur -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Informations principales -->
            <div class="row">
                <!-- Statuts -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle text-primary"></i>
                                Statut de la Réservation
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-center p-4">
                                        <div class="mb-2">
                                            <span class="badge fs-6 
                                                @if($reservation->statut == 'en_attente') bg-warning text-dark
                                                @elseif($reservation->statut == 'confirmee') bg-info
                                                @elseif($reservation->statut == 'en_cours') bg-primary
                                                @elseif($reservation->statut == 'terminee') bg-success
                                                @elseif($reservation->statut == 'annulee') bg-danger
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $reservation->statut)) }}
                                            </span>
                                        </div>
                                        <small class="text-muted">Statut de la réservation</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-center p-4">
                                        <div class="mb-2">
                                            <span class="badge fs-6 
                                                @if($reservation->statut_paiement == 'non_paye') bg-danger
                                                @elseif($reservation->statut_paiement == 'acompte') bg-warning text-dark
                                                @elseif($reservation->statut_paiement == 'paye') bg-success
                                                @elseif($reservation->statut_paiement == 'rembourse') bg-secondary
                                                @endif">
                                                {{ ucfirst(str_replace('_', ' ', $reservation->statut_paiement)) }}
                                            </span>
                                        </div>
                                        <small class="text-muted">Statut du paiement</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations du matériel -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-tools text-primary"></i>
                                Matériel Réservé
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($reservation->materiel)
                                <div class="text-center mb-3">
                                    @if($reservation->materiel->image)
                                        <img src="{{ asset('storage/' . $reservation->materiel->image) }}" 
                                             alt="{{ $reservation->materiel->nom }}" 
                                             class="img-fluid rounded mb-3" 
                                             style="max-height: 200px;">
                                    @else
                                        <div class="bg-light rounded p-4 mb-3">
                                            <i class="fas fa-tools fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <h6 class="text-center mb-3">{{ $reservation->materiel->nom }}</h6>
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded">
                                            <div class="fw-bold">{{ number_format($reservation->materiel->prix_location, 2) }} Fcfa</div>
                                            <small class="text-muted">Prix/jour</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-light rounded">
                                            <div class="fw-bold">{{ number_format($reservation->materiel->caution, 2) }} Fcfa</div>
                                            <small class="text-muted">Caution</small>
                                        </div>
                                    </div>
                                </div>
                                @if($reservation->materiel->description)
                                    <div class="mt-3">
                                        <small class="text-muted">{{ $reservation->materiel->description }}</small>
                                    </div>
                                @endif
                            @else
                                <div class="text-center text-muted">
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                    <p>Matériel non trouvé ou supprimé</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informations client -->
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-user text-primary"></i>
                                Informations Client
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom complet</label>
                                <div class="p-2 bg-light rounded">{{ $reservation->nom_complet }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <div class="p-2 bg-light rounded">
                                    <a href="mailto:{{ $reservation->email }}" class="text-decoration-none">
                                        {{ $reservation->email }}
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Téléphone</label>
                                <div class="p-2 bg-light rounded">
                                    <a href="tel:{{ $reservation->telephone }}" class="text-decoration-none">
                                        {{ $reservation->telephone }}
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Adresse</label>
                                <div class="p-2 bg-light rounded">{{ $reservation->adresse }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails de la réservation -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar text-primary"></i>
                                Détails de la Réservation
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}</div>
                                        <small class="text-muted">Date de début</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}</div>
                                        <small class="text-muted">Date de fin</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ $reservation->duree_jours }} jour(s)</div>
                                        <small class="text-muted">Durée</small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ $reservation->created_at->format('d/m/Y à H:i') }}</div>
                                        <small class="text-muted">Date de création</small>
                                    </div>
                                </div>
                            </div>
                            @if($reservation->commentaires)
                                <hr>
                                <div class="mt-3">
                                    <label class="form-label fw-bold">Commentaires</label>
                                    <div class="p-3 bg-light rounded">
                                        {{ $reservation->commentaires }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Détails financiers -->
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-euro-sign text-primary"></i>
                                Détails Financiers
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ number_format($reservation->prix_unitaire, 2) }} Fcfa</div>
                                        <small class="text-muted">Prix unitaire</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ number_format($reservation->sous_total, 2) }} Fcfa</div>
                                        <small class="text-muted">Sous-total</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ number_format($reservation->tva, 2) }} Fcfa</div>
                                        <small class="text-muted">TVA (18%)</small>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-center p-3 bg-light rounded">
                                        <div class="h6 mb-1">{{ number_format($reservation->caution, 2) }} Fcfa</div>
                                        <small class="text-muted">Caution</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center p-3 bg-primary text-white rounded">
                                        <div class="h5 mb-1">{{ number_format($reservation->total_ttc, 2) }} Fcfa</div>
                                        <small>Total TTC</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conditions acceptées -->
                @if($reservation->conditions_acceptees)
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas fa-check-circle text-success"></i>
                                    Conditions Acceptées
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($reservation->getConditionsArray() as $condition)
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-check text-success me-2 mt-1"></i>
                                                <span>{{ $condition }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: all 0.3s ease;
    border: 1px solid #e3e6f0;
}

.card:hover {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.badge {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.text-primary {
    color: #0d6efd !important;
}

.img-fluid {
    max-width: 100%;
    height: auto;
}

@media (max-width: 768px) {
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch !important;
    }
    
    .d-flex.gap-2 {
        justify-content: center;
    }
    
    .card-body .row > div {
        margin-bottom: 1rem;
    }
}
</style>
@endsection