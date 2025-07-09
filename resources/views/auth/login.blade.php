@extends('layouts.auth')

@section('styles')
<style>
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
}

.login-page {
    background: linear-gradient(135deg, #2c5530 0%, #88b04b 50%, #a8d060 100%);
    min-height: 100vh;
    position: relative;
    overflow: hidden;
}

/* Fond avec image de champs */
.background-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><pattern id="field" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse"><rect width="80" height="80" fill="%23334d33"/><rect x="0" y="0" width="40" height="80" fill="%23445544"/><rect x="40" y="0" width="40" height="80" fill="%23556655"/></pattern></defs><rect width="1200" height="800" fill="url(%23field)" opacity="0.3"/></svg>') center/cover;
    z-index: 1;
}

/* Motif agricole animé */
.agricultural-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 60px 60px;
    animation: fieldMove 30s linear infinite;
    z-index: 2;
}

@keyframes fieldMove {
    0% { transform: translateX(0) translateY(0); }
    100% { transform: translateX(60px) translateY(60px); }
}

/* Section héros à gauche */
.hero-section {
    position: absolute;
    top: 50%;
    left: 8%;
    transform: translateY(-50%);
    color: white;
    z-index: 10;
    max-width: 500px;
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
    color: #ffffff;
    line-height: 1;
}

.hero-subtitle {
    font-size: 1.4rem;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    color: rgba(255,255,255,0.95);
    font-weight: 300;
}

.features-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin: 2rem 0;
}

.feature-item {
    display: flex;
    align-items: center;
    color: rgba(255,255,255,0.9);
    font-size: 1rem;
    padding: 0.5rem;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    backdrop-filter: blur(5px);
}

.feature-icon {
    font-size: 1.5rem;
    margin-right: 10px;
    color: #a8d060;
}

/* Éléments flottants */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    pointer-events: none;
}

.floating-icon {
    position: absolute;
    font-size: 2.5rem;
    color: rgba(255,255,255,0.15);
    animation: float 8s ease-in-out infinite;
}

.drone-icon {
    top: 15%;
    right: 25%;
    animation-delay: 0s;
}

.tractor-icon {
    bottom: 25%;
    left: 15%;
    animation-delay: 3s;
}

.plant-icon {
    top: 65%;
    right: 15%;
    animation-delay: 6s;
}

.tools-icon {
    top: 40%;
    left: 5%;
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.15; }
    25% { transform: translateY(-15px) rotate(2deg); opacity: 0.25; }
    50% { transform: translateY(-30px) rotate(-2deg); opacity: 0.15; }
    75% { transform: translateY(-15px) rotate(1deg); opacity: 0.25; }
}

/* Container de connexion à droite */
.login-container {
    position: relative;
    z-index: 10;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    min-height: 100vh;
    padding-right: 8%;
}

.login-box {
    width: 420px;
    backdrop-filter: blur(15px);
    background: rgba(255, 255, 255, 0.95);
    border-radius: 25px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    border: 1px solid rgba(255,255,255,0.3);
    overflow: hidden;
}

.login-header {
    background: linear-gradient(135deg, #88b04b, #a8d060);
    padding: 2rem;
    text-align: center;
    color: white;
}

.brand-name {
    font-size: 2.2em;
    font-weight: 800;
    letter-spacing: 2px;
    margin-bottom: 0.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.brand-subtitle {
    font-size: 1em;
    font-weight: 300;
    opacity: 0.9;
    letter-spacing: 1px;
}

.login-body {
    padding: 2.5rem;
    background: rgba(255, 255, 255, 0.98);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border-radius: 12px;
    border: 2px solid #e8e8e8;
    padding: 15px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255,255,255,0.9);
}

.form-control:focus {
    border-color: #88b04b;
    box-shadow: 0 0 0 0.2rem rgba(136, 176, 75, 0.15);
    background: rgba(255,255,255,1);
}

.input-group {
    position: relative;
}

.input-group-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #88b04b;
    font-size: 1.2rem;
    z-index: 5;
}

.btn-login {
    background: linear-gradient(135deg, #88b04b, #a8d060);
    border: none;
    border-radius: 12px;
    padding: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(136, 176, 75, 0.3);
    margin-bottom: 1rem;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(136, 176, 75, 0.4);
    color: white;
}

.btn-login:active {
    transform: translateY(0);
}

.btn-register {
    background: transparent;
    border: 2px solid #88b04b;
    border-radius: 12px;
    padding: 15px;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #88b04b;
    width: 100%;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-register:hover {
    background: #88b04b;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(136, 176, 75, 0.3);
    text-decoration: none;
}

.btn-register:active {
    transform: translateY(0);
}

.form-check {
    margin: 1.5rem 0;
}

.form-check-input {
    margin-top: 0.25rem;
}

.form-check-label {
    color: #666;
    font-size: 0.9rem;
}

.forgot-password {
    text-align: center;
    margin-top: 1.5rem;
}

.forgot-password a {
    color: #88b04b;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.forgot-password a:hover {
    color: #6a8a3a;
    text-decoration: underline;
}

/* Messages d'erreur */
.invalid-feedback {
    display: block;
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

/* Styles pour le formulaire d'inscription */
.register-box {
    width: 520px;
    max-height: 90vh;
    overflow-y: auto;
}

.form-row {
    display: flex;
    gap: 1rem;
}

.form-col {
    flex: 1;
}

.select-group {
    position: relative;
}

.form-select {
    border-radius: 12px;
    border: 2px solid #e8e8e8;
    padding: 15px 20px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: rgba(255,255,255,0.9);
    width: 100%;
    appearance: none;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="%2388b04b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6,9 12,15 18,9"></polyline></svg>');
    background-repeat: no-repeat;
    background-position: right 15px center;
    background-size: 16px;
    padding-right: 45px;
}

.form-select:focus {
    border-color: #88b04b;
    box-shadow: 0 0 0 0.2rem rgba(136, 176, 75, 0.15);
    background-color: rgba(255,255,255,1);
}

/* Responsive */
@media (max-width: 1400px) {
    .hero-section {
        left: 5%;
        max-width: 400px;
    }
    
    .hero-title {
        font-size: 3.2rem;
    }
    
    .login-container {
        padding-right: 5%;
    }
}

@media (max-width: 1024px) {
    .hero-section {
        display: none;
    }
    
    .login-container {
        justify-content: center;
        padding: 20px;
    }
    
    .login-box, .register-box {
        width: 100%;
        max-width: 450px;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}

@media (max-width: 480px) {
    .login-box, .register-box {
        margin: 20px;
        width: calc(100% - 40px);
    }
    
    .login-header {
        padding: 1.5rem;
    }
    
    .login-body {
        padding: 2rem;
    }
    
    .brand-name {
        font-size: 1.8em;
    }
}
</style>
@endsection

@section('container')
<div class="login-page">
    <!-- Fond avec superposition -->
    <div class="background-overlay"></div>
    <div class="agricultural-pattern"></div>
    
    <!-- Éléments flottants -->
    <div class="floating-elements">
        <div class="floating-icon drone-icon">🚁</div>
        <div class="floating-icon tractor-icon">🚜</div>
        <div class="floating-icon plant-icon">🌾</div>
        <div class="floating-icon tools-icon">⚙️</div>
    </div>
    
    <!-- Section héros -->
    <div class="hero-section">
        <h1 class="hero-title">AGRODEALZ</h1>
        <p class="hero-subtitle">Votre partenaire pour l'agriculture moderne et connectée</p>
        
        <div class="features-grid">
            <div class="feature-item">
                <i class="fas fa-tractor feature-icon"></i>
                <span>Matériel agricole</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-helicopter feature-icon"></i>
                <span>Drones intelligents</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-tools feature-icon"></i>
                <span>Technologies avancées</span>
            </div>
            <div class="feature-item">
                <i class="fas fa-headset feature-icon"></i>
                <span>Support 24/7</span>
            </div>
        </div>
    </div>
    
    <!-- Container de connexion -->
    <div class="login-container">
        <!-- Formulaire de connexion -->
        <div class="login-box" id="loginForm">
            <div class="login-header">
                <div class="brand-name">AGRODEALZ</div>
                <div class="brand-subtitle">Corporate v.1</div>
            </div>
            
            <div class="login-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Adresse email"
                                   required 
                                   autocomplete="email" 
                                   autofocus>
                            <div class="input-group-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Mot de passe"
                                   required 
                                   autocomplete="current-password">
                            <div class="input-group-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               id="remember" 
                               name="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Se connecter
                    </button>
                </form>
                
                <a href="#" class="btn-register" onclick="showRegisterForm()">
                    <i class="fas fa-user-plus me-2"></i>
                    Créer un compte
                </a>
                
                @if (Route::has('password.request'))
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}">
                            <i class="fas fa-key me-1"></i>
                            Mot de passe oublié ?
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Formulaire d'inscription -->
        <div class="register-box" id="registerForm" style="display: none;">
            <div class="login-header">
                <div class="brand-name">AGRODEALZ</div>
                <div class="brand-subtitle">Inscription</div>
            </div>
            
            <div class="login-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control @error('nom_complet') is-invalid @enderror" 
                                   name="nom_complet" 
                                   value="{{ old('nom_complet') }}" 
                                   placeholder="Nom complet"
                                   required>
                            <div class="input-group-icon">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        @error('nom_complet')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="tel" 
                                           class="form-control @error('telephone') is-invalid @enderror" 
                                           name="telephone" 
                                           value="{{ old('telephone') }}" 
                                           placeholder="Téléphone"
                                           required>
                                    <div class="input-group-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                </div>
                                @error('telephone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-col">
                            <div class="form-group">
                                <div class="select-group">
                                    <select class="form-select @error('sexe') is-invalid @enderror" 
                                            name="sexe" 
                                            required>
                                        <option value="">Sexe</option>
                                        <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                                        <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                                    </select>
                                </div>
                                @error('sexe')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control @error('numero_CNI') is-invalid @enderror" 
                                   name="numero_CNI" 
                                   value="{{ old('numero_CNI') }}" 
                                   placeholder="Numéro CNI"
                                   required>
                            <div class="input-group-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                        @error('numero_CNI')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Adresse email"
                                   required>
                            <div class="input-group-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" 
                                           placeholder="Mot de passe"
                                           required>
                                    <div class="input-group-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-col">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control" 
                                           name="password_confirmation" 
                                           placeholder="Confirmer"
                                           required>
                                    <div class="input-group-icon">
                                        <i class="fas fa-lock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-user-plus me-2"></i>
                        Créer le compte
                    </button>
                </form>
                
                <a href="#" class="btn-register" onclick="showLoginForm()">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Déjà inscrit ? Se connecter
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function showRegisterForm() {
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('registerForm').style.display = 'block';
}

function showLoginForm() {
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'block';
}
</script>
@endsection