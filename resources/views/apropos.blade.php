<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - Location Matériel Agricole</title>
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
            margin: 0 auto;
        }

        /* Content Sections */
        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .content-card:hover {
            transform: translateY(-5px);
        }

        .content-card h2 {
            color: #667eea;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .content-card h2 i {
            font-size: 1.2rem;
        }

        .content-card p {
            color: #666;
            line-height: 1.8;
        }

        /* Stats Section */
        .stats-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-item {
            color: white;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Team Section */
        .team-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .team-section h2 {
            text-align: center;
            color: #667eea;
            margin-bottom: 2rem;
            font-size: 2rem;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .team-member {
            text-align: center;
            padding: 1.5rem;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .member-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: white;
        }

        .member-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .member-role {
            color: #667eea;
            font-weight: 500;
        }

        /* CTA Section */
        .cta-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 3rem 2rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cta-section h2 {
            color: white;
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border: none;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #667eea;
        }

        .btn-primary:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #667eea;
            transform: translateY(-2px);
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

            .content-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .team-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
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
                <li><a href="{{ route('catalogue') }}"><i class="fas fa-list"></i> Catalogue</a></li>
                <li><a href="{{ route('apropos') }}" class="active"><i class="fas fa-info-circle"></i> À propos</a></li>
                <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></li>
                  <a href="{{ route('publier.annonce') }}" class="nav-link">publier.annonce</a>
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
                <h1><i class="fas fa-seedling"></i> À propos d'AgroDealz</h1>
                <p>Nous révolutionnons l'accès aux équipements agricoles en connectant les agriculteurs avec les propriétaires de matériel, créant un écosystème collaboratif pour une agriculture moderne et efficace.</p>
            </section>

            <!-- Content Grid -->
            <div class="content-grid">
                <div class="content-card">
                    <h2><i class="fas fa-bullseye"></i> Notre Mission</h2>
                    <p>Faciliter l'accès au matériel agricole pour tous les agriculteurs, des petites exploitations aux grandes fermes. Nous croyons que chaque agriculteur devrait avoir accès aux meilleurs équipements pour optimiser ses rendements et réduire ses coûts.</p>
                </div>

                <div class="content-card">
                    <h2><i class="fas fa-eye"></i> Notre Vision</h2>
                    <p>Créer un monde où la technologie agricole est accessible à tous, où les ressources sont partagées de manière intelligente et où l'agriculture devient plus durable et profitable pour tous les acteurs.</p>
                </div>

                <div class="content-card">
                    <h2><i class="fas fa-cogs"></i> Nos Services</h2>
                    <p>Plateforme de location de matériel agricole, gestion des équipements, support technique 24/7, formation sur l'utilisation des machines, et conseils personnalisés pour optimiser vos opérations agricoles.</p>
                </div>

                <div class="content-card">
                    <h2><i class="fas fa-leaf"></i> Nos Valeurs</h2>
                    <p>Durabilité, innovation, collaboration et excellence. Nous nous engageons à promouvoir des pratiques agricoles responsables tout en soutenant la croissance économique des communautés rurales.</p>
                </div>
            </div>

            <!-- Stats Section -->
            <section class="stats-section">
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Équipements disponibles</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">1200+</span>
                        <span class="stat-label">Agriculteurs satisfaits</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">50+</span>
                        <span class="stat-label">Villes couvertes</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">24/7</span>
                        <span class="stat-label">Support technique</span>
                    </div>
                </div>
            </section>

            <!-- Team Section -->
            <section class="team-section">
                <h2><i class="fas fa-users"></i> Notre Équipe</h2>
                <div class="team-grid">
                    <div class="team-member">
                        <div class="member-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="member-name">Jean Dupont</div>
                        <div class="member-role">Directeur Général</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="member-name">Marie Martin</div>
                        <div class="member-role">Responsable Technique</div>
                    </div>
                    <div class="team-member">
                        <div class="member-avatar">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <div class="member-name">Pierre Durand</div>
                        <div class="member-role">Service Client</div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <h2><i class="fas fa-rocket"></i> Prêt à commencer ?</h2>
                <p>Rejoignez notre communauté d'agriculteurs et découvrez comment notre plateforme peut transformer votre activité agricole.</p>
                <div class="cta-buttons">
                    <a href="{#" class="btn btn-primary">
                        <i class="fas fa-search"></i> Voir le catalogue
                    </a>
                    <a href="#" class="btn btn-secondary">
                        <i class="fas fa-phone"></i> Nous contacter
                    </a>
                </div>
            </section>
        </div>
    </main>

    <script>
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
    </script>
</body>
</html>