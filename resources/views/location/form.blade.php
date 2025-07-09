<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location de Matériel Agricole</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 40px;
            width: 100%;
            max-width: 500px;
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
            margin-bottom: 32px;
        }

        .form-title {
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
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .form-input, .form-select {
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

        .form-input:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-input:hover, .form-select:hover {
            border-color: #d1d5db;
            transform: translateY(-1px);
        }

        .form-select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 20px;
            padding-right: 50px;
            cursor: pointer;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .submit-btn {
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

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -12px rgba(102, 126, 234, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .icon {
            width: 20px;
            height: 20px;
            margin-right: 8px;
            vertical-align: middle;
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

        @media (max-width: 640px) {
            .form-container {
                padding: 24px;
                margin: 10px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            
            .form-title {
                font-size: 24px;
            }
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

        .materiel-selector {
            margin-top: 8px;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-bottom: 16px;
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 8px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .radio-label::before {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            margin-right: 8px;
            transition: all 0.3s ease;
        }

        .radio-group input[type="radio"]:checked + .radio-label {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .radio-group input[type="radio"]:checked + .radio-label::before {
            border-color: #667eea;
            background: #667eea;
            box-shadow: inset 0 0 0 3px white;
        }

        .materiel-field {
            opacity: 0;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            transform: translateY(-10px);
        }

        .materiel-field.active {
            opacity: 1;
            max-height: 100px;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="floating-elements">
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
        <div class="floating-circle"></div>
    </div>

    <div class="form-container">
        <div class="form-header">
            <h1 class="form-title">Location de Matériel</h1>
            <p class="form-subtitle">Réservez votre équipement agricole</p>
        </div>

        <form method="POST" action="{{ route('location.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="materiel_option" class="form-label">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Matériel
                </label>
                <div class="materiel-selector">
                    <div class="radio-group">
                        <input type="radio" id="existing_materiel" name="materiel_option" value="existing" checked>
                        <label for="existing_materiel" class="radio-label">Choisir dans la liste</label>
                        
                        <input type="radio" id="new_materiel" name="materiel_option" value="new">
                        <label for="new_materiel" class="radio-label">Saisir manuellement</label>
                    </div>
                    
                    <div id="existing_materiel_field" class="materiel-field active">
                        <select name="idmateriel" class="form-select">
                            <option value="">Sélectionner un matériel...</option>
                            @foreach($materiels as $materiel)
                                <option value="{{ $materiel->id }}">{{ $materiel->nom_complet }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div id="new_materiel_field" class="materiel-field">
                        <input type="text" name="nouveau_materiel" class="form-input" placeholder="Nom du nouveau matériel...">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="idagriculteur" class="form-label">
                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Agriculteur
                </label>
                <select name="idagriculteur" class="form-select" required>
                    @foreach($agriculteurs as $agriculteur)
                        <option value="{{ $agriculteur->id }}">{{ $agriculteur->nom_complet }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date_debut" class="form-label">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Date de début
                    </label>
                    <input type="date" name="date_debut" class="form-input" required>
                </div>

                <div class="form-group">
                    <label for="date_fin" class="form-label">
                        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Date de fin
                    </label>
                    <input type="date" name="date_fin" class="form-input" required>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Valider la location
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="materiel_option"]');
            const existingField = document.getElementById('existing_materiel_field');
            const newField = document.getElementById('new_materiel_field');
            const selectField = document.querySelector('select[name="idmateriel"]');
            const inputField = document.querySelector('input[name="nouveau_materiel"]');

            function toggleFields() {
                const selectedValue = document.querySelector('input[name="materiel_option"]:checked').value;
                
                if (selectedValue === 'existing') {
                    existingField.classList.add('active');
                    newField.classList.remove('active');
                    selectField.required = true;
                    inputField.required = false;
                    inputField.value = '';
                } else {
                    existingField.classList.remove('active');
                    newField.classList.add('active');
                    selectField.required = false;
                    inputField.required = true;
                    selectField.value = '';
                }
            }

            radios.forEach(radio => {
                radio.addEventListener('change', toggleFields);
            });

            // Initialiser l'état
            toggleFields();
        });
    </script>
</body>
</html>