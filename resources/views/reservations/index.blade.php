@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <!-- En-tête -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">
                    <i class="fas fa-calendar-alt text-primary"></i>
                    Mes Réservations
                </h1>
                <a href="{{ route('reservation.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle Réservation
                </a>
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

          @foreach($reservations as $reservation)
    <div class="card mb-2">
        <div class="card-body">
            <strong>{{ $reservation->nom_complet }}</strong><br>
            <small>Conditions :</small>
            <ul>
              @foreach($reservation->getConditionsArray() as $condition)
                    <li>{{ $condition }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endforeach



            <!-- Filtres -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('reservations.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmee" {{ request('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                <option value="en_cours" {{ request('statut') == 'en_cours' ? 'selected' : '' }}>En cours</option>
                                <option value="terminee" {{ request('statut') == 'terminee' ? 'selected' : '' }}>Terminée</option>
                                <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Paiement</label>
                            <select name="statut_paiement" class="form-select">
                                <option value="">Tous les paiements</option>
                                <option value="non_paye" {{ request('statut_paiement') == 'non_paye' ? 'selected' : '' }}>Non payé</option>
                                <option value="acompte" {{ request('statut_paiement') == 'acompte' ? 'selected' : '' }}>Acompte</option>
                                <option value="paye" {{ request('statut_paiement') == 'paye' ? 'selected' : '' }}>Payé</option>
                                <option value="rembourse" {{ request('statut_paiement') == 'rembourse' ? 'selected' : '' }}>Remboursé</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date début</label>
                            <input type="date" name="date_debut" class="form-control" value="{{ request('date_debut') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-outline-primary">
                                    <i class="fas fa-search"></i> Filtrer
                                </button>
                                <a href="{{ route('reservations.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Liste des réservations -->
           <!-- Liste des réservations -->
            @if($reservations->count() > 0)
                <div class="row">
                    @foreach($reservations as $reservation)
                        <div class="col-12 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">
                                            <i class="fas fa-tools text-primary"></i>
                                            {{ $reservation->materiel->nom ?? 'Matériel supprimé' }}
                                        </h5>
                                        <small class="text-muted">
                                            Réservation #{{ $reservation->id }} - 
                                            Créée le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                                        </small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <!-- Badge statut -->
                                        <span class="badge 
                                            @if($reservation->statut == 'en_attente') bg-warning
                                            @elseif($reservation->statut == 'confirmee') bg-info
                                            @elseif($reservation->statut == 'en_cours') bg-primary
                                            @elseif($reservation->statut == 'terminee') bg-success
                                            @elseif($reservation->statut == 'annulee') bg-danger
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $reservation->statut)) }}
                                        </span>

                                        <!-- Badge paiement -->
                                        <span class="badge 
                                            @if($reservation->statut_paiement == 'non_paye') bg-danger
                                            @elseif($reservation->statut_paiement == 'acompte') bg-warning
                                            @elseif($reservation->statut_paiement == 'paye') bg-success
                                            @elseif($reservation->statut_paiement == 'rembourse') bg-secondary
                                            @endif">
                                            {{ ucfirst(str_replace('_', ' ', $reservation->statut_paiement)) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <!-- Informations client -->
                                        <div class="col-md-6">
                                            <h6 class="text-primary mb-3">
                                                <i class="fas fa-user"></i> Informations Client
                                            </h6>
                                            <div class="mb-2">
                                                <strong>Nom:</strong> {{ $reservation->nom_complet }}
                                            </div>
                                            <div class="mb-2">
                                                <strong>Email:</strong> 
                                                <a href="mailto:{{ $reservation->email }}">{{ $reservation->email }}</a>
                                            </div>
                                            <div class="mb-2">
                                                <strong>Téléphone:</strong> 
                                                <a href="tel:{{ $reservation->telephone }}">{{ $reservation->telephone }}</a>
                                            </div>
                                            <div class="mb-2">
                                                <strong>Adresse:</strong> {{ $reservation->adresse }}
                                            </div>
                                        </div>

                                        <!-- Informations réservation -->
                                        <div class="col-md-6">
                                            <h6 class="text-primary mb-3">
                                                <i class="fas fa-calendar"></i> Détails de la Réservation
                                            </h6>
                                            <div class="mb-2">
                                                <strong>Date début:</strong> 
                                                {{ \Carbon\Carbon::parse($reservation->date_debut)->format('d/m/Y') }}
                                            </div>
                                            <div class="mb-2">
                                                <strong>Date fin:</strong> 
                                                {{ \Carbon\Carbon::parse($reservation->date_fin)->format('d/m/Y') }}
                                            </div>
                                            <div class="mb-2">
                                                <strong>Durée:</strong> {{ $reservation->duree_jours }} jour(s)
                                            </div>
                                            @if($reservation->commentaires)
                                                <div class="mb-2">
                                                    <strong>Commentaires:</strong> 
                                                    <span class="text-muted">{{ $reservation->commentaires }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Informations financières -->
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h6 class="text-primary mb-3">
                                                <i class="fas fa-euro-sign"></i> Détails Financiers
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="text-center p-3 bg-light rounded">
                                                        <div class="h5 mb-0">{{ number_format($reservation->prix_unitaire, 2) }} Fcfa</div>
                                                        <small class="text-muted">Prix unitaire</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="text-center p-3 bg-light rounded">
                                                        <div class="h5 mb-0">{{ number_format($reservation->sous_total, 2) }} Fcfa</div>
                                                        <small class="text-muted">Sous-total</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center p-3 bg-light rounded">
                                                        <div class="h5 mb-0">{{ number_format($reservation->tva, 2) }} Fcfa</div>
                                                        <small class="text-muted">TVA (18%)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center p-3 bg-light rounded">
                                                        <div class="h5 mb-0">{{ number_format($reservation->caution, 2) }} fcfa</div>
                                                        <small class="text-muted">Caution</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center p-3 bg-primary text-white rounded">
                                                        <div class="h5 mb-0">{{ number_format($reservation->total_ttc, 2) }} fcfa</div>
                                                        <small>Total TTC</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Conditions acceptées -->
                                    @if($reservation->conditions_acceptees)
                                        <hr>
                                        <h6 class="text-primary mb-3">
                                            <i class="fas fa-check-circle"></i> Conditions Acceptées
                                        </h6>
                                        <div class="row">
                                           @foreach($reservation->getConditionsArray() as $condition)
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-check text-success me-2"></i>
                                                        <small>{{ $condition }}</small>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                               <!-- Actions -->
<div class="card-footer">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-eye"></i> Voir détails
            </a>
        </div>
        <div class="btn-group">
            {{-- Bouton Payer pour les réservations non payées --}}
            @if($reservation->statut_paiement == 'non_paye' && in_array($reservation->statut, ['confirmee', 'en_cours']))
                <a href="{{ route('paiements.create', $reservation) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-credit-card"></i> Payer
                </a>
            @endif

            {{-- Bouton Compléter paiement pour les acomptes --}}
            @if($reservation->statut_paiement == 'acompte' && in_array($reservation->statut, ['confirmee', 'en_cours']))
                <a href="{{ route('paiements.create', $reservation) }}" class="btn btn-info btn-sm">
                    <i class="fas fa-credit-card"></i> Compléter paiement
                </a>
            @endif

            @if($reservation->statut == 'en_attente')
                <form method="POST" action="{{ route('reservations.confirmer', $reservation) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Confirmer cette réservation ?')">
                        <i class="fas fa-check"></i> Confirmer
                    </button>
                </form>
            @endif
            
            @if(in_array($reservation->statut, ['en_attente', 'confirmee']))
                <form method="POST" action="{{ route('reservations.annuler', $reservation) }}" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Annuler cette réservation ?')">
                        <i class="fas fa-times"></i> Annuler
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $reservations->withQueryString()->links() }}
                </div>
            @else
                <!-- Aucune réservation -->
                <div class="text-center py-5">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucune réservation trouvée</h4>
                    <p class="text-muted">Vous n'avez encore aucune réservation.</p>
                    <a href="{{ route('reservation.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Créer ma première réservation
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.badge {
    font-size: 0.8em;
}

.bg-light {
    background-color: #f8f9fa !important;
}

.text-primary {
    color: #0d6efd !important;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .card-body .row > div {
        margin-bottom: 2rem;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 1rem;
    }
}
</style>
@endsection