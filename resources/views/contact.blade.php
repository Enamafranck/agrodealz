<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Location Matériel Agricole</title>
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

        /* Contact Grid */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-bottom: 3rem;
        }

        /* Contact Form */
        .contact-form-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-form-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-form-section h2 i {
            color: #667eea;
        }

        .contact-form-section p {
            color: #666;
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            text-align: center;
            font-size: 1.1rem;
        }

        .btn-primary {
            background: #667eea;
            color: white;
            width: 100%;
        }

        .btn-primary:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }

        /* Contact Info */
        .contact-info-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .contact-info-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-info-section h2 i {
            color: #667eea;
        }

        .contact-info-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background: rgba(102, 126, 234, 0.1);
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .contact-info-item:hover {
            transform: translateY(-5px);
        }

        .contact-info-item i {
            font-size: 1.5rem;
            color: #667eea;
            width: 30px;
            text-align: center;
        }

        .contact-info-content h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .contact-info-content p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Map Section */
        .map-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 3rem;
        }

        .map-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-align: center;
            justify-content: center;
        }

        .map-section h2 i {
            color: #667eea;
        }

        .map-placeholder {
            height: 400px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .map-placeholder::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.2);
        }

        .map-placeholder-content {
            position: relative;
            z-index: 1;
        }

        .map-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* FAQ Section */
        .faq-section {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .faq-section h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            text-align: center;
            justify-content: center;
        }

        .faq-section h2 i {
            color: #667eea;
        }

        .faq-item {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .faq-question {
            padding: 1.5rem;
            background: rgba(102, 126, 234, 0.05);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: 600;
            color: #333;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: rgba(102, 126, 234, 0.1);
        }

        .faq-question i {
            color: #667eea;
            transition: transform 0.3s ease;
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            color: #666;
        }

        .faq-answer.active {
            padding: 1.5rem;
            max-height: 200px;
        }

        /* Success Message */
        .success-message {
            background: #4CAF50;
            color: white;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: none;
            align-items: center;
            gap: 1rem;
        }

        .success-message.show {
            display: flex;
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

            .contact-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .contact-form-section,
            .contact-info-section,
            .map-section,
            .faq-section {
                padding: 2rem;
            }
        }

        /* Animation */
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

        .animate-on-scroll {
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
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
                <li><a href="{{ route('apropos') }}"><i class="fas fa-info-circle"></i> À propos</a></li>
                <li><a href="{{ route('contact') }}" class="active"><i class="fas fa-envelope"></i> Contact</a></li>
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
            <section class="hero-section animate-on-scroll">
                <h1><i class="fas fa-envelope"></i> Contactez-nous</h1>
                <p>Vous avez une question, une demande particulière ou besoin d'informations ? Notre équipe est à votre disposition pour vous accompagner dans vos projets agricoles.</p>
            </section>

            <!-- Contact Grid -->
            <div class="contact-grid">
                <!-- Contact Form -->
                <section class="contact-form-section animate-on-scroll">
                    <h2><i class="fas fa-paper-plane"></i> Envoyez-nous un message</h2>
                    <p>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.</p>
                    
                    <div class="success-message" id="successMessage">
                        <i class="fas fa-check-circle"></i>
                        <span>Votre message a été envoyé avec succès ! Nous vous répondrons bientôt.</span>
                    </div>

                    <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="prenom">Prénom *</label>
                                <input type="text" id="prenom" name="prenom" required>
                            </div>
                            <div class="form-group">
                                <label for="nom">Nom *</label>
                                <input type="text" id="nom" name="nom" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input type="tel" id="telephone" name="telephone">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sujet">Sujet *</label>
                            <select id="sujet" name="sujet" required>
                                <option value="">Choisissez un sujet</option>
                                <option value="reservation">Réservation de matériel</option>
                                <option value="information">Demande d'information</option>
                                <option value="tarif">Question sur les tarifs</option>
                                <option value="partenariat">Partenariat</option>
                                <option value="support">Support technique</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" placeholder="Décrivez votre demande en détail..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Envoyer le message
                        </button>
                    </form>
                </section>

                <!-- Contact Info -->
                <section class="contact-info-section animate-on-scroll">
                    <h2><i class="fas fa-info-circle"></i> Nos coordonnées</h2>

                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="contact-info-content">
                            <h3>Adresse</h3>
                            <p>123 Avenue de l'Agriculture<br>Yaoundé, Cameroun</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <i class="fas fa-phone"></i>
                        <div class="contact-info-content">
                            <h3>Téléphone</h3>
                            <p>+237 6XX XX XX XX<br>+237 6XX XX XX XX</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div class="contact-info-content">
                            <h3>Email</h3>
                            <p>contact@agrodealz.cm<br>info@agrodealz.cm</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <i class="fas fa-clock"></i>
                        <div class="contact-info-content">
                            <h3>Horaires d'ouverture</h3>
                            <p>Lun - Ven: 8h00 - 18h00<br>Sam: 8h00 - 13h00</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <i class="fas fa-globe"></i>
                        <div class="contact-info-content">
                            <h3>Réseaux sociaux</h3>
                            <p>Suivez-nous sur nos réseaux<br>pour les dernières actualités</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Map Section -->
            <section class="map-section animate-on-scroll">
                <h2><i class="fas fa-map"></i> Notre localisation</h2>
                <div class="map-placeholder">
                    <div class="map-placeholder-content">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Carte interactive disponible bientôt<br>Yaoundé, Cameroun</p>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section class="faq-section animate-on-scroll">
                <h2><i class="fas fa-question-circle"></i> Questions fréquentes</h2>
                
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Comment puis-je réserver du matériel agricole ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Vous pouvez réserver directement depuis notre catalogue en ligne ou nous contacter par téléphone. Notre équipe vous guidera dans le processus de réservation.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Quels sont les délais de livraison ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Les délais de livraison varient selon votre localisation et le matériel demandé. Généralement, nous livrons dans les 24-48h pour la région de Yaoundé.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Proposez-vous une formation pour l'utilisation du matériel ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Oui, nous proposons une formation gratuite pour l'utilisation de nos équipements. Un technicien peut vous accompagner lors de la première utilisation.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Que faire en cas de panne du matériel loué ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Notre service technique est disponible 24h/24. En cas de panne, contactez-nous immédiatement. Nous interviendrons rapidement pour résoudre le problème.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <script>
        // Form submission
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simulate form submission
            setTimeout(() => {
                document.getElementById('successMessage').classList.add('show');
                this.reset();
                
                // Hide success message after 5 seconds
                setTimeout(() => {
                    document.getElementById('successMessage').classList.remove('show');
                }, 5000);
            }, 500);
        });

        // FAQ toggle
        function toggleFaq(element) {
            const answer = element.nextElementSibling;
            const icon = element.querySelector('i');
            
            // Close all other FAQs
            document.querySelectorAll('.faq-answer').forEach(faq => {
                if (faq !== answer) {
                    faq.classList.remove('active');
                    faq.previousElementSibling.querySelector('i').style.transform = 'rotate(0deg)';
                }
            });
            
            // Toggle current FAQ
            answer.classList.toggle('active');
            if (answer.classList.contains('active')) {
                icon.style.transform = 'rotate(180deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // Scroll animations
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    element.style.animation = 'fadeInUp 0.6s ease forwards';
                }
            });
        }

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
            
            animateOnScroll();
        });

        // Initial animation check
        window.addEventListener('load', function() {
            animateOnScroll();
        });

        // Form validation
        document.getElementById('contactForm').addEventListener('input', function(e) {
            const input = e.target;
            if (input.checkValidity()) {
                input.style.borderColor = '#4CAF50';
            } else {
                input.style.borderColor = '#e0e0e0';
            }
        });
    </script>
</body>
</html>