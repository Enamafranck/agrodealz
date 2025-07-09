@extends('layouts.app')

@section('content')
<div class="home-container">
    <!-- Navigation moderne -->
    <nav class="modern-nav fixed-top bg-white shadow-sm">
        <div class="container">
            <div class="nav-content d-flex justify-content-between align-items-center py-3">
                <div class="logo d-flex align-items-center">
                    <div class="logo-icon bg-gradient-primary rounded-circle p-2 me-3">
                        <i class="fas fa-leaf text-white"></i>
                    </div>
                    <h4 class="mb-0 fw-bold text-primary">AgroDealz</h4>
                </div>
                <div class="nav-links d-none d-lg-flex">
                    <a href="#" class="nav-link active">Accueil</a>
                    <a href="{{ route('catalogue') }}" class="nav-link">Catalogue</a>
                    <a href="{{ route('apropos') }}" class="nav-link">À propos</a>
                    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                    <a href="{{ route('publier.annonce') }}" class="nav-link">publier.annonce</a>
                    @auth
    @if(auth()->user()->hasRole('administrateur'))
        <a href="{{ route('Utilisateurs') }}" class="nav-link dashboard-link">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
    @endif
@endauth
                </div>
                <button class="mobile-menu-btn d-lg-none btn btn-outline-primary">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section Moderne -->
    <section class="hero-modern position-relative overflow-hidden">
        <div class="hero-bg-gradient"></div>
        <div class="hero-particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>
        
        <div class="container position-relative z-3">
            <div class="row align-items-center min-vh-100 py-5">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="hero-badge mb-4">
                            <span class="badge bg-light text-primary px-3 py-2 rounded-pill">
                                <i class="fas fa-award me-2"></i>
                                N°1 en équipements agricoles
                            </span>
                        </div>
                        <h1 class="hero-title display-3 fw-bold mb-4 text-white">
                            L'agriculture du 
                            <span class="text-gradient">futur</span>
                            commence ici
                        </h1>
                        <p class="hero-subtitle lead text-white-50 mb-5">
                            Découvrez notre collection exceptionnelle de matériel agricole moderne, 
                            conçue pour maximiser vos rendements et révolutionner votre exploitation.
                        </p>
                        <div class="hero-actions d-flex gap-3 flex-wrap">
                            <a href="{{ route('catalogue') }}" class="btn btn-primary btn-lg px-4 py-3 rounded-pill">
                                <i class="fas fa-search me-2"></i>
                                Explorer le catalogue
                            </a>
                            <a href="#" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                                <i class="fas fa-play me-2"></i>
                                Voir la démo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-visual">
                       <div class="floating-cards">
                            <div class="floating-card card-1">
                                <img src="{{ asset('image/tracteur-traverse-champ-recoltes_118124-284473.avif') }}" alt="Tracteur moderne">
                                <div class="card-content">
                                    <h5>Tracteurs High-Tech</h5>
                                    <p>Dernière génération</p>
                                </div>
                            </div>
                            <div class="floating-card card-2">
                                <img src="{{ asset('image/téléchargement.jpeg') }}" alt="Moissonneuse">
                                <div class="card-content">
                                    <h5>Moissonneuses</h5>
                                    <p>Efficacité maximale</p>
                                </div>
                            </div>
                            <div class="floating-card card-3">
    <img src="{{ asset('image/Vantage_pulverisateur_traine-1.jpg') }}" alt="Pulvérisateur">
    <div class="card-content">
        <h5>Pulvérisateurs</h5>
        <p>Précision parfaite</p>
    </div>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Statistiques -->
    <section class="stats-section py-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon bg-primary bg-opacity-10 rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-tractor text-primary fa-2x"></i>
                        </div>
                        <h3 class="stat-number fw-bold text-primary">{{ $materiels ? $materiels->count() : 0 }}+</h3>
                        <p class="stat-label text-muted">Équipements disponibles</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon bg-success bg-opacity-10 rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-users text-success fa-2x"></i>
                        </div>
                        <h3 class="stat-number fw-bold text-success">1200+</h3>
                        <p class="stat-label text-muted">Clients satisfaits</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon bg-warning bg-opacity-10 rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-medal text-warning fa-2x"></i>
                        </div>
                        <h3 class="stat-number fw-bold text-warning">15+</h3>
                        <p class="stat-label text-muted">Années d'expérience</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="stat-card text-center">
                        <div class="stat-icon bg-info bg-opacity-10 rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-headset text-info fa-2x"></i>
                        </div>
                        <h3 class="stat-number fw-bold text-info">24/7</h3>
                        <p class="stat-label text-muted">Support technique</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Catalogue Aperçu -->
    <section id="catalog" class="catalog-preview py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title fw-bold text-dark mb-3">
                    Notre Catalogue Premium
                </h2>
                <p class="section-subtitle text-muted">
                    Découvrez notre sélection d'équipements agricoles de dernière génération
                </p>
            </div>
            
            <div class="row g-4">
                @foreach($materiels->take(6) as $index => $materiel)
                <div class="col-lg-4 col-md-6">
                    <div class="equipment-card modern-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="card-image-container">
                            @php
                                $imageUrls = [
                                     asset('image/Vantage_pulverisateur_traine-1.jpg') ,
                                     asset('image/EL20511201_1-1000x562.jpg'),
                                     asset('image/4404.jpg'),
                                     asset('image/images.jpeg'),
                                    
                                ];
                                $randomImage = $imageUrls[array_rand($imageUrls)];
                            @endphp
                            <img src="{{ $randomImage }}" alt="{{ $materiel->nom }}" class="card-img">
                            <div class="card-overlay">
                                <div class="overlay-content">
                                    <button class="btn btn-light rounded-circle">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-light rounded-circle">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="status-badge">
                                <span class="badge bg-success">Disponible</span>
                            </div>
                        </div>
                        
                        <div class="card-content">
                            <h5 class="card-title fw-bold mb-2">{{ $materiel->nom }}</h5>
                            <p class="card-description text-muted mb-3">{{ Str::limit($materiel->description, 80) }}</p>
                            
                            <div class="card-features mb-3">
                                <div class="feature-item">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <span>2023</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-cogs text-success me-2"></i>
                                    <span>Automatique</span>
                                </div>
                            </div>
                            
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="price">
                                    <span class="price-amount fw-bold text-primary">
                                        {{ number_format(rand(50000, 200000), 0, ',', ' ') }} FCFA
                                    </span>
                                    <small class="text-muted">/jour</small>
                                </div>
                                <button class="btn btn-primary btn-sm rounded-pill">
                                    <i class="fas fa-shopping-cart me-1"></i>
                                    Louer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5">
                <a href="{{ route('catalogue') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                    <i class="fas fa-th-large me-2"></i>
                    Voir tout le catalogue
                </a>
            </div>
        </div>
    </section>

    <!-- Section Services -->
    <section class="services-section py-5 bg-white">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="section-title fw-bold text-dark mb-3">
                    Pourquoi nous choisir ?
                </h2>
                <p class="section-subtitle text-muted">
                    Des services exceptionnels pour votre réussite agricole
                </p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon bg-primary bg-opacity-10 rounded-circle p-4 mx-auto mb-4">
                            <i class="fas fa-shield-alt text-primary fa-3x"></i>
                        </div>
                        <h4 class="service-title fw-bold mb-3">Équipements Certifiés</h4>
                        <p class="service-description text-muted">
                            Tous nos matériels sont certifiés et régulièrement entretenus pour garantir 
                            des performances optimales.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon bg-success bg-opacity-10 rounded-circle p-4 mx-auto mb-4">
                            <i class="fas fa-tools text-success fa-3x"></i>
                        </div>
                        <h4 class="service-title fw-bold mb-3">Maintenance Incluse</h4>
                        <p class="service-description text-muted">
                            Service de maintenance complet inclus dans toutes nos offres de location 
                            pour votre tranquillité d'esprit.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card text-center">
                        <div class="service-icon bg-warning bg-opacity-10 rounded-circle p-4 mx-auto mb-4">
                            <i class="fas fa-clock text-warning fa-3x"></i>
                        </div>
                        <h4 class="service-title fw-bold mb-3">Flexibilité Totale</h4>
                        <p class="service-description text-muted">
                            Locations flexibles adaptées à vos besoins : courte durée, longue durée, 
                            ou saisonnière.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section CTA -->
    <section class="cta-section py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h2 class="cta-title fw-bold mb-3">
                        Prêt à révolutionner votre agriculture ?
                    </h2>
                    <p class="cta-subtitle mb-4">
                        Contactez nos experts dès aujourd'hui pour une consultation gratuite 
                        et découvrez comment nos équipements peuvent transformer votre exploitation.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('contact') }}" class="btn btn-light btn-lg rounded-pill px-4">
                        <i class="fas fa-phone me-2"></i>
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="footer-brand">
                        <div class="logo d-flex align-items-center mb-3">
                            <div class="logo-icon bg-primary rounded-circle p-2 me-3">
                                <i class="fas fa-leaf text-white"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">AgroDealz</h4>
                        </div>
                        <p class="text-muted">
                            Votre partenaire de confiance pour tous vos besoins en équipements agricoles.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title fw-bold mb-3">Navigation</h5>
                    <ul class="footer-links">
                        <li><a href="#" class="text-muted">Accueil</a></li>
                        <li><a href="#" class="text-muted">Catalogue</a></li>
                        <li><a href="#" class="text-muted">À propos</a></li>
                        <li><a href="#" class="text-muted">Contact</a></li>
                        <li><a href="#" class="text-muted">dasboard</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title fw-bold mb-3">Services</h5>
                    <ul class="footer-links">
                        <li><a href="#" class="text-muted">Location</a></li>
                        <li><a href="#" class="text-muted">Maintenance</a></li>
                        <li><a href="#" class="text-muted">Formation</a></li>
                        <li><a href="#" class="text-muted">Support</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h5 class="footer-title fw-bold mb-3">Contact</h5>
                    <div class="footer-contact">
                        <p class="text-muted">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            123 Rue de l'Agriculture, Yaoundé, Cameroun
                        </p>
                        <p class="text-muted">
                            <i class="fas fa-phone me-2"></i>
                            +237 657 456 789
                        </p>
                        <p class="text-muted">
                            <i class="fas fa-envelope me-2"></i>
                            contact@agrodealz.cm
                        </p>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0">© 2024 AgroDealz. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links">
                        <a href="#" class="text-muted me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-muted me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-muted me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Styles CSS -->
<style>
/* Variables CSS */
:root {
    --primary-color: #2563eb;
    --secondary-color: #10b981;
    --accent-color: #f59e0b;
    --dark-color: #1f2937;
    --light-color: #f8fafc;
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Reset et base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.6;
    color: var(--dark-color);
}

/* Navigation moderne */
.modern-nav {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95) !important;
    transition: all 0.3s ease;
}

.nav-links {
    gap: 2rem;
}

.nav-link {
    color: var(--dark-color);
    text-decoration: none;
    font-weight: 500;
    position: relative;
    transition: color 0.3s ease;
}

.nav-link:hover,
.nav-link.active {
    color: var(--primary-color);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--primary-color);
    transition: width 0.3s ease;
}

.nav-link:hover::after,
.nav-link.active::after {
    width: 100%;
}

.dashboard-link {
    background: var(--gradient-primary);
    color: white !important;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.dashboard-link:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Hero Section */
.hero-modern {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    overflow: hidden;
}

.hero-bg-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    z-index: 1;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 2;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.particle:nth-child(1) {
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.particle:nth-child(2) {
    top: 40%;
    right: 20%;
    animation-delay: 2s;
}

.particle:nth-child(3) {
    bottom: 30%;
    left: 20%;
    animation-delay: 4s;
}

.particle:nth-child(4) {
    top: 60%;
    right: 10%;
    animation-delay: 1s;
}

.particle:nth-child(5) {
    bottom: 10%;
    left: 50%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.text-gradient {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-badge {
    animation: fadeInUp 1s ease-out;
}

.hero-title {
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hero-subtitle {
    animation: fadeInUp 1s ease-out 0.4s both;
}

.hero-actions {
    animation: fadeInUp 1s ease-out 0.6s both;
}

/* Cartes flottantes */
.floating-cards {
    position: relative;
    width: 100%;
    height: 500px;
}

.floating-card {
    position: absolute;
    width: 200px;
    height: 250px;
    background: white;
    border-radius: 20px;
    box-shadow: var(--shadow-xl);
    overflow: hidden;
    transition: transform 0.3s ease;
    animation: floatCard 6s ease-in-out infinite;
}

.floating-card:hover {
    transform: translateY(-10px) scale(1.05);
}

.floating-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.card-content {
    padding: 1rem;
}

.card-content h5 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.card-content p {
    font-size: 0.8rem;
    color: #6b7280;
    margin: 0;
}

.card-1 {
    top: 10%;
    right: 20%;
    animation-delay: 0s;
}

.card-2 {
    top: 40%;
    right: 5%;
    animation-delay: 2s;
}

.card-3 {
    bottom: 15%;
    right: 25%;
    animation-delay: 4s;
}

@keyframes floatCard {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(2deg); }
}

/* Section Statistiques */
.stat-card {
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.5rem;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Cards d'équipement */
.equipment-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.equipment-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.card-image-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.equipment-card:hover .card-img {
    transform: scale(1.1);
}

.card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.equipment-card:hover .card-overlay {
    opacity: 1;
}

.overlay-content {
    display: flex;
    gap: 1rem;
}

.overlay-content .btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.status-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    z-index: 10;
}

.card-content {
    padding: 1.5rem;
}

.card-features {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.feature-item {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: #6b7280;
}

.price-amount {
    font-size: 1.2rem;
}

/* Service Cards */
.service-card {
    padding: 2rem;
    transition: transform 0.3s ease;
}

.service-card:hover {
    transform: translateY(-5px);
}

.service-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.service-card:hover .service-icon {
    transform: scale(1.1);
}

/* Section CTA */
.cta-section {
    background: var(--gradient-primary);
}

.cta-title {
    font-size: 2.5rem;
}

/* Footer */
.footer {
    background: #0f172a !important;
}

.footer-links {
    list-style: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 0.5rem;
}

.footer-links a {
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: var(--primary-color) !important;
}

.social-links a {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: var(--primary-color);
    color: white !important;
    transform: translateY(-2px);
}

/* Gradients */
.bg-gradient-primary {
    background: var(--gradient-primary);
}

.bg-gradient-secondary {
    background: var(--gradient-secondary);
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-modern {
        min-height: 80vh;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .floating-cards {
        display: none;
    }
    
    .hero-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .hero-actions .btn {
        width: 100%;
        max-width: 300px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .card-features {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .equipment-card .card-content {
        padding: 1rem;
    }
    
    .service-card {
        padding: 1.5rem;
    }
    
    .nav-links {
        display: none;
    }
    
    .mobile-menu-btn {
        display: block;
    }
}

@media (max-width: 576px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .stat-number {
        font-size: 1.5rem;
    }
    
    .equipment-card .card-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .equipment-card .card-footer .btn {
        width: 100%;
    }
}

/* Smooth scrolling */
html {
    scroll-behavior: smooth;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: #1d4ed8;
}

/* Loading animation */
.loading {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    transition: opacity 0.3s ease;
}

.loading.hide {
    opacity: 0;
    pointer-events: none;
}

.spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #f3f4f6;
    border-top: 4px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Utility classes */
.text-shadow {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.backdrop-blur {
    backdrop-filter: blur(10px);
}

.glass-effect {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.hover-lift {
    transition: transform 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
}

.z-index-1 { z-index: 1; }
.z-index-2 { z-index: 2; }
.z-index-3 { z-index: 3; }
.z-index-4 { z-index: 4; }
.z-index-5 { z-index: 5; }

/* Button animations */
.btn {
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.btn:hover::before {
    left: 100%;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

/* Pulse animation for important elements */
.pulse {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}
</style>

<!-- Scripts JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation au scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observer tous les éléments à animer
    document.querySelectorAll('.equipment-card, .service-card, .stat-card').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });

    // Animation des nombres
    function animateNumbers() {
        const numbers = document.querySelectorAll('.stat-number');
        numbers.forEach(number => {
            const finalValue = parseInt(number.textContent.replace(/\D/g, ''));
            const duration = 2000;
            const increment = finalValue / (duration / 16);
            let currentValue = 0;
            
            const counter = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    currentValue = finalValue;
                    clearInterval(counter);
                }
                
                if (number.textContent.includes('+')) {
                    number.textContent = Math.floor(currentValue) + '+';
                } else if (number.textContent.includes('/')) {
                    number.textContent = Math.floor(currentValue) + '/7';
                } else if (number.textContent.includes('%')) {
                    number.textContent = Math.floor(currentValue) + '%';
                } else {
                    number.textContent = Math.floor(currentValue);
                }
            }, 16);
        });
    }

    // Démarrer l'animation des nombres quand la section est visible
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
                statsObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.stats-section');
    if (statsSection) {
        statsObserver.observe(statsSection);
    }

    // Gestion du menu mobile
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const navLinks = document.querySelector('.nav-links');
    
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.classList.toggle('show');
        });
    }

    // Smooth scroll pour les liens d'ancrage
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Effet parallax sur le hero
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero-modern');
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Gestion des favoris
    document.querySelectorAll('.fa-heart').forEach(heart => {
        heart.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            this.classList.toggle('fas');
            this.classList.toggle('far');
            
            if (this.classList.contains('fas')) {
                this.style.color = '#ef4444';
                this.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 150);
            } else {
                this.style.color = '';
            }
        });
    });

    // Effet de typing pour le titre
    function typeWriter(element, text, speed = 100) {
        let i = 0;
        element.innerHTML = '';
        
        function type() {
            if (i < text.length) {
                element.innerHTML += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }

    // Préloader
    window.addEventListener('load', function() {
        const loading = document.querySelector('.loading');
        if (loading) {
            loading.classList.add('hide');
            setTimeout(() => {
                loading.style.display = 'none';
            }, 300);
        }
    });

    // Gestion des tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Effet de glitch sur le logo au survol
    const logo = document.querySelector('.logo');
    if (logo) {
        logo.addEventListener('mouseenter', function() {
            this.style.animation = 'glitch 0.3s ease-in-out';
        });
        
        logo.addEventListener('animationend', function() {
            this.style.animation = '';
        });
    }

    // Gestion du scroll pour la navbar
    let lastScrollTop = 0;
    const navbar = document.querySelector('.modern-nav');
    
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        if (scrollTop > lastScrollTop && scrollTop > 100) {
            // Scroll vers le bas
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scroll vers le haut
            navbar.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    });
});

// Animation CSS additionnelle
const style = document.createElement('style');
style.textContent = `
    @keyframes glitch {
        0% { transform: translate(0); }
        20% { transform: translate(-2px, 2px); }
        40% { transform: translate(-2px, -2px); }
        60% { transform: translate(2px, 2px); }
        80% { transform: translate(2px, -2px); }
        100% { transform: translate(0); }
    }
`;
document.head.appendChild(style);
</script>

<!-- Liens CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

<script>
// Initialisation AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
});
</script>

@endsection