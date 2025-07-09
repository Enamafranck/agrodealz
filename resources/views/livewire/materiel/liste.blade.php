@extends('layouts.app')

@section('title', 'Liste des Matériels')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Liste du Matériel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active">Matériels</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Messages de succès -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gestion des Matériels</h3>
                            <div class="card-tools">
                                <a href="{{ route('materiels.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Ajouter un matériel
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="materielsTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Description</th>
                                            <th>Prix de location</th>
                                            <th>Statut</th>
                                            <th>Date d'ajout</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($materiels as $materiel)
                                            <tr>
                                                <td>{{ $materiel->id }}</td>
                                                <td>{{ $materiel->nom }}</td>
                                                <td>{{ Str::limit($materiel->description, 50) }}</td>
                                                <td>{{ number_format($materiel->prix_location, 0, ',', ' ') }} FCFA</td>
                                                <td>
                                                    @switch($materiel->statut)
                                                        @case('disponible')
                                                            <span class="badge badge-success">Disponible</span>
                                                            @break
                                                        @case('loue')
                                                            <span class="badge badge-warning">Loué</span>
                                                            @break
                                                        @case('maintenance')
                                                            <span class="badge badge-danger">En maintenance</span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-secondary">{{ $materiel->statut }}</span>
                                                    @endswitch
                                                </td>
                                                <td>{{ $materiel->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('materiels.show', $materiel->id) }}" 
                                                           class="btn btn-info btn-sm" title="Voir">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('materiels.edit', $materiel->id) }}" 
                                                           class="btn btn-warning btn-sm" title="Modifier">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('materiels.destroy', $materiel->id) }}" 
                                                              method="POST" class="d-inline"
                                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce matériel ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle"></i>
                                                        Aucun matériel trouvé. 
                                                        <a href="{{ route('materiels.create') }}">Ajouter le premier matériel</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        @if($materiels->count() > 0)
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info">
                                            Affichage de {{ $materiels->count() }} matériel(s)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#materielsTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            },
            "responsive": true,
            "autoWidth": false,
            "pageLength": 10,
            "order": [[0, 'desc']]
        });
    });
</script>
@endsection