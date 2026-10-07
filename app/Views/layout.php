<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Puihaha Electric' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
    <style>
        :root {
            --primary-color: #765aae;
            --secondary-color: #d9cbed;
            --accent-color: #a98bd3;
            --dark-color: #403054;
            --light-color: #faf8fc;
            --text-color: #3d3548;
            --border-color: #ece7f3;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background: var(--light-color);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.97) !important;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 18px rgba(62, 46, 84, 0.06) !important;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-size: 1.35rem;
            font-weight: 800;
        }

        .navbar-brand .text-warning {
            color: var(--primary-color) !important;
        }

        .navbar-nav .nav-link {
            margin: 0 0.3rem;
            padding: 0.55rem 0.75rem !important;
            border-radius: 10px;
            color: #62586c;
            font-size: 0.92rem;
            font-weight: 650;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-color) !important;
            background: #f0ebfa;
        }

        .hero-section {
            position: relative;
            overflow: hidden;
            padding: 100px 0;
            color: white;
            background: linear-gradient(135deg, #8569bd 0%, #594277 100%);
        }

        .hero-section::after {
            content: "";
            position: absolute;
            right: -100px;
            bottom: -160px;
            width: 420px;
            height: 420px;
            border: 55px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .hero-section .container {
            position: relative;
            z-index: 1;
        }

        .btn {
            border-radius: 11px;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .btn-primary {
            padding: 12px 24px;
            color: white;
            background: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 6px 14px rgba(118, 90, 174, 0.22);
        }

        .btn-primary:hover {
            color: white;
            background: #5e458f;
            border-color: #5e458f;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--primary-color) !important;
            border-color: #bca9dd !important;
        }

        .btn-outline-primary:hover {
            color: white !important;
            background: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .btn-outline-light {
            padding: 12px 24px;
            border-width: 2px;
        }

        .btn-outline-light:hover {
            color: var(--primary-color);
            background: white;
            transform: translateY(-2px);
        }

        .card {
            border: 1px solid var(--border-color);
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(62, 46, 84, 0.08);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 30px rgba(62, 46, 84, 0.13);
        }

        .feature-icon {
            display: flex;
            width: 76px;
            height: 76px;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border-radius: 22px;
            color: white;
            font-size: 1.8rem;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            box-shadow: 0 8px 18px rgba(118, 90, 174, 0.22);
        }

        .section-padding {
            padding: 80px 0;
        }

        .bg-light-custom {
            background: var(--light-color) !important;
        }

        .text-primary-custom,
        .text-primary,
        .text-info {
            color: var(--primary-color) !important;
        }

        .text-secondary-custom {
            color: #987ac7 !important;
        }

        .text-muted {
            color: #90869e !important;
        }

        .form-control,
        .form-select {
            border-color: #e1dbea;
            border-radius: 11px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #a98bd3;
            box-shadow: 0 0 0 0.2rem rgba(118, 90, 174, 0.14);
        }

        .footer {
            padding: 55px 0 20px;
            color: white;
            background: linear-gradient(135deg, #403054, #30233f);
        }

        .footer h5 {
            color: #dacbf2;
            font-weight: 700;
        }

        .footer a {
            color: #e7e0f0;
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

        .social-icons a {
            display: inline-grid;
            width: 40px;
            height: 40px;
            place-items: center;
            margin-right: 8px;
            border-radius: 12px;
            color: white;
            background: rgba(255, 255, 255, 0.12);
        }

        .social-icons a:hover {
            color: var(--dark-color);
            background: #dacbf2;
            transform: translateY(-2px);
        }

        .alert {
            border: 0;
            border-radius: 13px;
        }

        .alert-success {
            color: #24674f;
            background: #e2f4e9;
        }

        .alert-danger {
            color: #9e365d;
            background: #ffe5ee;
        }

        /* Purple counters, blue sections, and process circles */
        .bg-primary,
        .stats-section,
        .statistics-section {
            background: linear-gradient(135deg, #765aae, #554077) !important;
        }

        .stat-item h2 {
            color: #f3d398 !important;
            background: none !important;
            -webkit-text-fill-color: #f3d398 !important;
        }

        .rounded-circle.bg-primary,
        .team-member .rounded-circle,
        .team-avatar,
        .process-step .rounded-circle,
        .process-number {
            background: #9272c9 !important;
        }

        .bg-info {
            background: #e9e0f8 !important;
        }

        .bg-success {
            background: #dff1e8 !important;
        }

        .bg-warning {
            background: #f7ecfb !important;
        }

        .text-success {
            color: #4f8b6d !important;
        }

        /* Pastel amber emergency sections */
        .bg-danger,
        .emergency-section,
        .emergency-banner {
            color: #4e3518 !important;
            background: linear-gradient(135deg, #f8df9f, #f2b46a) !important;
        }

        .bg-danger h1,
        .bg-danger h2,
        .bg-danger h3,
        .bg-danger h4,
        .bg-danger h5,
        .bg-danger p,
        .bg-danger .text-white,
        .emergency-section h1,
        .emergency-section h2,
        .emergency-section h3,
        .emergency-section h4,
        .emergency-section h5,
        .emergency-section p,
        .emergency-section .text-white,
        .emergency-banner .text-white {
            color: #4e3518 !important;
        }

        .bg-danger .text-warning,
        .emergency-section .text-warning,
        .emergency-banner .text-warning {
            color: #b65b23 !important;
        }

        .bg-danger .btn-warning,
        .emergency-section .btn-warning,
        .emergency-banner .btn-warning {
            color: #4e3518 !important;
            background: #fff8e9 !important;
            border-color: #fff8e9 !important;
            box-shadow: 0 5px 12px rgba(130, 81, 30, 0.12);
        }

        .bg-danger .btn-outline-light,
        .emergency-section .btn-outline-light,
        .emergency-banner .btn-outline-light {
            color: #4e3518 !important;
            border-color: #4e3518 !important;
        }

        .bg-danger .btn-outline-light:hover,
        .emergency-section .btn-outline-light:hover,
        .emergency-banner .btn-outline-light:hover {
            color: white !important;
            background: #a85b2a !important;
            border-color: #a85b2a !important;
        }

        .timeline-content,
        .service-card,
        .team-card {
            border-color: #eee8f7 !important;
            box-shadow: 0 10px 25px rgba(72, 49, 105, 0.08) !important;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding: 70px 0;
            }

            .section-padding {
                padding: 55px 0;
            }

            .navbar-nav .nav-link {
                margin: 0.15rem 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">
                <i class="fas fa-bolt text-warning me-2"></i>Puihaha Electric
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bstarget="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($page) && $page == 'home') ? 'active' : '' ?>" href="<?=
                                      base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($page) && $page == 'about') ? 'active' : '' ?>" href="<?=
                                      base_url('about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($page) && $page == 'services') ? 'active' : '' ?>" href="<?=
                                      base_url('services') ?>">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($page) && $page == 'contact') ? 'active' : '' ?>" href="<?=
                                      base_url('contact') ?>">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (isset($page) && $page == 'register') ? 'active' : '' ?>" href="<?=
                                      base_url('register') ?>">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('login') ?>">
                            <i class="fas fa-user-lock me-1"></i>Staff Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><i class="fas fa-bolt text-warning me-2"></i>Puihaha Electric</h5>
                    <p class="mb-3">Providing reliable and sustainable electrical solutions for over 25 years.
                        Your trusted partner for all electrical needs.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><a href="<?= base_url('about') ?>">About</a></li>
                        <li><a href="<?= base_url('services') ?>">Services</a></li>
                        <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Residential Wiring</a></li>
                        <li><a href="#">Commercial Installation</a></li>
                        <li><a href="#">Emergency Repairs</a></li>
                        <li><a href="#">Solar Solutions</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 mb-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i>123 Electric Avenue, Power City, PC
                            12345</li>
                        <li><i class="fas fa-phone me-2"></i>(555) 123-4567</li>
                        <li><i class="fas fa-envelope me-2"></i>info@Puihahaelectric.com</li>
                        <li><i class="fas fa-clock me-2"></i>24/7 Emergency Service</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Puihaha Electric. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Licensed & Insured | License #EL123456</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
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
        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        // Observe all cards and sections
        document.querySelectorAll('.card, .feature-item').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>

</html>