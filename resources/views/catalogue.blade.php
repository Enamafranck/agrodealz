
        <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue - Location Matériel Agricole</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #667eea;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-links a:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .nav-links a.active {
            background: #667eea;
            color: white;
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Hero Section */
        .hero-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 4rem 2rem;
            text-align: center;
            margin-bottom: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-section h1 {
            font-size: 3rem;
            color: white;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        /* Filter Section */
        .filter-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-group label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .filter-group select,
        .filter-group input {
            padding: 0.8rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-left: 3rem;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }

        /* Catalogue Grid */
        .catalogue-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        .material-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .material-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .material-image {
            height: 200px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            position: relative;
            overflow: hidden;
        }

        .material-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .material-card:hover .material-image::before {
            opacity: 1;
        }

        .availability-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: white;
        }

        .available {
            background: #4CAF50;
        }

        .unavailable {
            background: #f44336;
        }

        .material-info {
            padding: 1.5rem;
        }

        .material-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .material-description {
            color: #666;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .material-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .feature-tag {
            background: #f0f0f0;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.8rem;
            color: #667eea;
            font-weight: 500;
        }

        .material-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .material-image {
    position: relative;
    width: 100%;
    height: 200px; /* Ajustez selon vos besoins */
    overflow: hidden;
    border-radius: 12px; /* Optionnel pour des coins arrondis */
}

.material-image img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Maintient les proportions et remplit tout l'espace */
    object-position: center; /* Centre l'image */
    display: block; /* Évite les espaces en bas */
}

.availability-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: rgba(76, 175, 80, 0.9);
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    backdrop-filter: blur(10px);
    z-index: 2;
}

.availability-badge.available {
    background: rgba(76, 175, 80, 0.9);
}

.availability-badge.unavailable {
    background: rgba(244, 67, 54, 0.9);
}

/* Effet hover optionnel */
.material-image:hover img {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

/* Pour éviter le débordement lors du zoom */
.material-image {
    overflow: hidden;
}

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
        }

        .price-unit {
            font-size: 0.9rem;
            color: #666;
        }

        .location-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            width: 100%;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: white;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.7;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .catalogue-grid {
                grid-template-columns: 1fr;
            }

            .material-details {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
        }
        

        /* Loading Animation */
        .loading {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            color: white;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo">
              <div class="logo d-flex align-items-center">
                    <div class="logo-icon bg-gradient-primary rounded-circle p-2 me-3">
                        <i class="fas fa-leaf text-white"></i>
                    </div>
                    <h4 class="mb-0 fw-bold text-primary">AgroDealz</h4>
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="{{ route('acceuil') }}"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="{{ route('catalogue') }}" class="active"><i class="fas fa-list"></i> Catalogue</a></li>
                <li><a href="{{ route('apropos') }}"><i class="fas fa-info-circle"></i> À propos</a></li>
                <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></li>
                   @auth
    @if(auth()->user()->hasRole('administrateur'))
        <a href="{{ route('Utilisateurs') }}" class="nav-link dashboard-link">
            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
        </a>
    @endif
@endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Hero Section -->
            <section class="hero-section">
                <h1><i class="fas fa-tools"></i> Notre Catalogue</h1>
                <p>Découvrez notre large gamme de matériel agricole moderne et performant. Trouvez l'équipement parfait pour vos besoins et louez-le en quelques clics.</p>
            </section>

            <!-- Filter Section -->
            <section class="filter-section">
                <div class="filter-grid">
                    <div class="filter-group">
                        <label for="search">Rechercher</label>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="search" placeholder="Nom du matériel...">
                        </div>
                    </div>
                    <div class="filter-group">
                        <label for="category">Catégorie</label>
                        <select id="category">
                            <option value="">Toutes les catégories</option>
                            <option value="tracteur">Tracteurs</option>
                            <option value="moissonneuse">Moissonneuses</option>
                            <option value="charrue">Charrues</option>
                            <option value="semoir">Semoirs</option>
                            <option value="pulverisateur">Pulvérisateurs</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="price">Prix max (Fcfa/jour)</label>
                        <input type="number" id="price" placeholder="Ex: 15000">
                    </div>
                    <div class="filter-group">
                        <label for="location">Localisation</label>
                        <select id="location">
                            <option value="">Toutes les régions</option>
                            <option value="centre">Centre</option>
                            <option value="littoral">Littoral</option>
                            <option value="ouest">Ouest</option>
                            <option value="nord">Nord</option>
                        </select>
                    </div>
                </div>
            </section>

            <!-- Catalogue Grid -->
            <section class="catalogue-grid" id="catalogueGrid">
                <!-- Tracteur John Deere -->
                <div class="material-card">
                    <div class="material-image">
                        <i class=""></i>
                        <img src="image/téléchargement (1).jpeg" alt="">
                        <div class="availability-badge available">Disponible</div>
                    </div>
                    <div class="material-info">
                        <h3 class="material-title">Tracteur John Deere 6155R</h3>
                        <p class="material-description">Tracteur polyvalent 155 CV, parfait pour les travaux de labour, semis et récolte. Cabine climatisée et GPS intégré.</p>
                        <div class="material-features">
                            <span class="feature-tag">155 CV</span>
                            <span class="feature-tag">GPS</span>
                            <span class="feature-tag">Climatisé</span>
                        </div>
                        <div class="material-details">
                            <div class="price">
                                78000Fcfa <span class="price-unit">/jour</span>
                            </div>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Yaoundé, Centre</span>
                            </div>
                        </div>
                        <a href="{{ route('reservations.create') }}" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i> Réserver maintenant
                        </a>
                    </div>
                </div>

                <!-- Moissonneuse-batteuse -->
                <div class="material-card">
                    <div class="material-image">
                        
                         <img src="image/téléchargement.jpeg" alt="">
                        <div class="availability-badge available">Disponible</div>
                    </div>
                    <div class="material-info">
                        <h3 class="material-title">Moissonneuse-batteuse Claas Lexion</h3>
                        <p class="material-description">Moissonneuse haute performance pour céréales. Débit optimal et système de nettoyage avancé.</p>
                        <div class="material-features">
                            <span class="feature-tag">6m de coupe</span>
                            <span class="feature-tag">Auto-guidage</span>
                            <span class="feature-tag">Turbo</span>
                        </div>
                        <div class="material-details">
                            <div class="price">
                                163000Fcfa <span class="price-unit">/jour</span>
                            </div>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Douala, Littoral</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i> Réserver maintenant
                        </a>
                    </div>
                </div>

                <!-- Pulvérisateur -->
                <div class="material-card">
                    <div class="material-image">
                        
                         <img src="image/images (1).jpeg" alt="">
                        <div class="availability-badge available">Disponible</div>
                    </div>
                    <div class="material-info">
                        <h3 class="material-title">Pulvérisateur Amazone UX 3200</h3>
                        <p class="material-description">Pulvérisateur traîné 3200L avec rampe 18m. Contrôle de débit automatique et GPS.</p>
                        <div class="material-features">
                            <span class="feature-tag">3200L</span>
                            <span class="feature-tag">18m rampe</span>
                            <span class="feature-tag">GPS</span>
                        </div>
                        <div class="material-details">
                            <div class="price">
                                52000Fcfa <span class="price-unit">/jour</span>
                            </div>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Bafoussam, Ouest</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i> Réserver maintenant
                        </a>
                    </div>
                </div>

                <!-- Charrue -->
                <div class="material-card">
                    <div class="material-image">
                         <img src="image/images (2).jpeg" alt="">
                        <i class=""></i>
                        <div class="availability-badge unavailable">Indisponible</div>
                    </div>
                    <div class="material-info">
                        <h3 class="material-title">Charrue Kverneland PX100</h3>
                        <p class="material-description">Charrue réversible 5 corps, parfaite pour le labour profond. Réglage hydraulique des socs.</p>
                        <div class="material-features">
                            <span class="feature-tag">5 corps</span>
                            <span class="feature-tag">Réversible</span>
                            <span class="feature-tag">Hydraulique</span>
                        </div>
                        <div class="material-details">
                            <div class="price">
                                30000Fcfa <span class="price-unit">/jour</span>
                            </div>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Garoua, Nord</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-secondary">
                            <i class="fas fa-clock"></i> Bientôt disponible
                        </a>
                    </div>
                </div>

                <!-- Semoir -->
                <div class="material-card">
                    <div class="material-image">
                        <i class=""></i>
                         <img src="image/_thulit12-480x270.jpg" alt="">
                        <div class="availability-badge available">Disponible</div>
                    </div>
                    <div class="material-info">
                        <h3 class="material-title">Semoir Lemken Solitair 12</h3>
                        <p class="material-description">Semoir pneumatique combiné 6m avec distribution précise. Idéal pour tous types de graines.</p>
                        <div class="material-features">
                            <span class="feature-tag">6m largeur</span>
                            <span class="feature-tag">Pneumatique</span>
                            <span class="feature-tag">Multi-graines</span>
                        </div>
                        <div class="material-details">
                            <div class="price">
                                62500fcfa <span class="price-unit">/jour</span>
                            </div>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Bertoua, Est</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i> Réserver maintenant
                        </a>
                    </div>
                </div>

                <!-- Faucheuse -->
                <div class="material-card">
                    <div class="material-image">
                        <i class=""></i>
                         <img src="image/images (3).jpeg" alt="">
                        <div class="availability-badge available">Disponible</div>
                    </div>
                    <div class="material-info">
                        <h3 class="material-title">Faucheuse Kuhn GMD 3150</h3>
                        <p class="material-description">Faucheuse conditionneuse 3.15m pour foin et fourrage. Système de conditionnement optimal.</p>
                        <div class="material-features">
                            <span class="feature-tag">3.15m</span>
                            <span class="feature-tag">Conditionneuse</span>
                            <span class="feature-tag">Pliable</span>
                        </div>
                        <div class="material-details">
                            <div class="price">
                                42500Fcfa<span class="price-unit">/jour</span>
                            </div>
                            <div class="location-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Bamenda, Nord-Ouest</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">
                            <i class="fas fa-calendar-alt"></i> Réserver maintenant
                        </a>
                    </div>
                </div>
            </section>

            <!-- Empty State (hidden by default) -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <i class="fas fa-search"></i>
                <h3>Aucun matériel trouvé</h3>
                <p>Essayez de modifier vos filtres pour voir plus de résultats.</p>
            </div>
        </div>
    </main>

    <script>
        // Filter functionality
        const searchInput = document.getElementById('search');
        const categorySelect = document.getElementById('category');
        const priceInput = document.getElementById('price');
        const locationSelect = document.getElementById('location');
        const catalogueGrid = document.getElementById('catalogueGrid');
        const emptyState = document.getElementById('emptyState');
        const materialCards = document.querySelectorAll('.material-card');

        function filterMaterials() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categorySelect.value;
            const maxPrice = priceInput.value ? parseFloat(priceInput.value) : Infinity;
            const selectedLocation = locationSelect.value;

            let visibleCount = 0;

            materialCards.forEach(card => {
                const title = card.querySelector('.material-title').textContent.toLowerCase();
                const description = card.querySelector('.material-description').textContent.toLowerCase();
                const priceText = card.querySelector('.price').textContent;
                const price = parseFloat(priceText.replace(/[^\d.]/g, ''));
                const location = card.querySelector('.location-info span').textContent.toLowerCase();

                const matchesSearch = searchTerm === '' || title.includes(searchTerm) || description.includes(searchTerm);
                const matchesCategory = selectedCategory === '' || title.includes(selectedCategory);
                const matchesPrice = price <= maxPrice;
                const matchesLocation = selectedLocation === '' || location.includes(selectedLocation);

                if (matchesSearch && matchesCategory && matchesPrice && matchesLocation) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show/hide empty state
            if (visibleCount === 0) {
                catalogueGrid.style.display = 'none';
                emptyState.style.display = 'block';
            } else {
                catalogueGrid.style.display = 'grid';
                emptyState.style.display = 'none';
            }
        }

        // Add event listeners
        searchInput.addEventListener('input', filterMaterials);
        categorySelect.addEventListener('change', filterMaterials);
        priceInput.addEventListener('input', filterMaterials);
        locationSelect.addEventListener('change', filterMaterials);

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Simulate loading effect on page load
        window.addEventListener('load', function() {
            const cards = document.querySelectorAll('.material-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>
    </div>
