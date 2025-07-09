@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        margin: 0;
        padding: 20px;
    }

    .form-container {
        max-width: 800px;
        margin: 0 auto;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        padding: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: slideUp 0.6s ease-out;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-header {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }

    .form-header::before {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        border-radius: 2px;
    }

    .form-header h2 {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .form-subtitle {
        color: #6b7280;
        font-size: 16px;
        font-weight: 400;
        margin-top: 0.5rem;
    }

    .form-group {
        margin-bottom: 24px;
        position: relative;
    }

    .form-group::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #667eea, transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .form-group:focus-within::before {
        opacity: 1;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        transition: color 0.3s ease;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e5e7eb;
        border-radius: 16px;
        font-size: 16px;
        background: #ffffff;
        transition: all 0.3s ease;
        appearance: none;
        outline: none;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
    }

    .form-control:hover, .form-select:hover {
        border-color: #d1d5db;
        transform: translateY(-1px);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .input-group {
        position: relative;
    }

    .input-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }

    .btn-primary {
        width: 100%;
        padding: 18px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 16px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        margin-top: 16px;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px -12px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    .alert {
        border: none;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .alert-success {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        color: #667eea;
        border-left: 4px solid #667eea;
    }

    .text-danger {
        color: #dc3545 !important;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        display: block;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }

    .file-input-label {
        display: block;
        padding: 16px 20px;
        background: #f8f9fa;
        border: 2px dashed #e5e7eb;
        border-radius: 16px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #6b7280;
    }

    .file-input-label:hover {
        background: #e9ecef;
        border-color: #667eea;
        color: #667eea;
        transform: translateY(-1px);
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .select-wrapper {
        position: relative;
    }

    .select-wrapper::after {
        content: '';
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 20px;
        pointer-events: none;
    }

    .form-select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 50px;
        cursor: pointer;
    }

    .floating-elements {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
    }

    .floating-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .floating-circle:nth-child(1) {
        width: 80px;
        height: 80px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-circle:nth-child(2) {
        width: 60px;
        height: 60px;
        top: 20%;
        right: 10%;
        animation-delay: 2s;
    }

    .floating-circle:nth-child(3) {
        width: 100px;
        height: 100px;
        bottom: 10%;
        left: 20%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 1rem;
            padding: 24px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .form-header h2 {
            font-size: 24px;
        }
    }
</style>

<div class="floating-elements">
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
    <div class="floating-circle"></div>
</div>

<div class="container">
    <div class="form-container">
        <div class="form-header">
            <h2>Publier une annonce de matériel</h2>
            <p class="form-subtitle">Remplissez les informations ci-dessous pour publier votre annonce</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('publier.annonce.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nom" class="form-label">Nom du matériel</label>
                <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
                @error('nom') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="marque" class="form-label">Marque</label>
                <input type="text" name="marque" class="form-control" value="{{ old('marque') }}" required>
                @error('marque') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                @error('description') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="disponibilite" class="form-label">Disponibilité</label>
                    <div class="select-wrapper">
                        <select name="disponibilite" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="disponible" {{ old('disponibilite') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                            <option value="loue" {{ old('disponibilite') == 'loue' ? 'selected' : '' }}>Loué</option>
                            <option value="en_maintenance" {{ old('disponibilite') == 'en_maintenance' ? 'selected' : '' }}>En maintenance</option>
                        </select>
                    </div>
                    @error('disponibilite') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="etat" class="form-label">État</label>
                    <div class="select-wrapper">
                        <select name="etat" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            <option value="neuf" {{ old('etat') == 'neuf' ? 'selected' : '' }}>Neuf</option>
                            <option value="occasion" {{ old('etat') == 'occasion' ? 'selected' : '' }}>Occasion</option>
                            <option value="bon_etat" {{ old('etat') == 'bon_etat' ? 'selected' : '' }}>Bon état</option>
                        </select>
                    </div>
                    @error('etat') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="prix_location" class="form-label">Prix de location</label>
                    <input type="text" name="prix_location" class="form-control" value="{{ old('prix_location') }}" required>
                    @error('prix_location') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="caution" class="form-label">Caution</label>
                    <input type="text" name="caution" class="form-control" value="{{ old('caution') }}" required>
                    @error('caution') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Image (optionnelle)</label>
                <div class="file-input-wrapper">
                    <input type="file" name="image" class="form-control" id="image">
                    <label for="image" class="file-input-label">
                        📁 Cliquez pour sélectionner une image
                    </label>
                </div>
                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Publier l'annonce</button>
        </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const label = document.querySelector('.file-input-label');
    const fileName = e.target.files[0]?.name || 'Cliquez pour sélectionner une image';
    label.textContent = fileName;
});
</script>
@endsection