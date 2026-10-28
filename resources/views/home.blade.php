@extends('layouts.app')

@section('title', 'Waveron Technologies | Software & Design Agency, Nairobi')
@section('meta_description', 'Waveron Technologies is Kenya\'s leading custom software development agency, specializing in bespoke mobile & web apps, brand design, and growth marketing solutions.')
@section('og_title', 'Waveron Technologies — Innovation\'s Crest, Tomorrow\'s Best')
@section('og_description', 'Kenya\'s leading custom software development agency. We build bespoke mobile & web apps, brand identities, and growth marketing campaigns that transform businesses.')
@section('og_url', 'https://waverontechnologies.co.ke/')
@section('og_type', 'website')

@section('content')
<!-- Hero Section -->
<div class="hero min-vh-100 d-flex align-items-center position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content-col">
                <h1 class="display-4 fw-bold mb-4 text-primary">Innovation's Crest,<br>Tomorrow's Best</h1>
                <p class="lead mb-4">A pioneering technology firm dedicated to creating cutting-edge solutions that
                    propel businesses into the future. We harness the power of advanced technology to transform
                    industries and elevate the human experience.</p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="{{ route('services') }}" class="btn btn-primary btn-lg">Explore Services</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg">Get Started</a>
                </div>
            </div>
            <div class="col-lg-6 hero-illustration-col">
                <div class="position-relative">
                    <div class="shape-blob"></div>
                    <div class="shape-blob2"></div>
                    <img src="{{ asset('images/hero-illustration.svg') }}" alt="Innovation Illustration"
                        class="img-fluid position-relative" style="max-width: 480px; width: 100%;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Portfolio Showcase Section -->
<section class="portfolio-showcase py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5">
                <span class="badge bg-secondary mb-3">Portfolio showcase</span>
                <h2 class="display-4 fw-bold text-dark mb-4">Projects that define categories and drive growth.</h2>

                <div class="my-4 py-4 border-top border-bottom">
                    <div class="row text-muted">
                        <div class="col-4 d-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg"></i>
                            <span class="small">Brand Identity</span>
                        </div>
                        <div class="col-4 d-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg"></i>
                            <span class="small">Product Design</span>
                        </div>
                        <div class="col-4 d-flex align-items-center gap-2">
                            <i class="bi bi-plus-lg"></i>
                            <span class="small">Web Development</span>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="fw-bold mb-2">Impactful results across industries</h6>
                    <p class="text-muted mb-4">From startup MVPs to enterprise transformations, our projects consistently deliver measurable outcomes and user engagement that drives business growth.</p>
                    <a href="{{ route('portfolio') }}" class="btn btn-dark rounded-pill">
                        View all projects
                        <i class="bi bi-circle-fill ms-2" style="font-size: 0.5rem;"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="project-card mb-3" style="height: 400px;">
                            <div class="position-relative h-100 rounded-3 overflow-hidden" style="background: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/c6bb21d7-3ce2-44b4-abbf-2b0d092cd7fc_800w.jpg') center/cover;">
                                <span class="badge bg-light text-dark position-absolute top-0 start-0 m-3">
                                    <i class="bi bi-sparkles"></i>
                                </span>
                                <span class="badge bg-light bg-opacity-25 text-white position-absolute top-0 end-0 m-3 backdrop-blur">Branding</span>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h5 class="mb-0">Waveron CRM</h5>
                                </div>
                            </div>
                        </div>
                        <div class="project-card" style="height: 300px;">
                            <div class="position-relative h-100 rounded-3 overflow-hidden" style="background: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/9b13123e-ec51-4d3a-b994-c64aab4555ba_800w.jpg') center/cover;">
                                <span class="badge bg-light text-dark position-absolute top-0 start-0 m-3">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                                <span class="badge bg-light bg-opacity-25 text-white position-absolute top-0 end-0 m-3 backdrop-blur">Action Tracker</span>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h5 class="mb-0">Waveron Opportunities</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="project-card mb-3" style="height: 300px;">
                            <div class="position-relative h-100 rounded-3 overflow-hidden" style="background: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/6dc04406-de49-4988-8d82-e1d9fe1d83c1_800w.jpg') center/cover;">
                                <span class="badge bg-light text-dark position-absolute top-0 start-0 m-3">
                                    <i class="bi bi-grid"></i>
                                </span>
                                <span class="badge bg-light bg-opacity-25 text-white position-absolute top-0 end-0 m-3 backdrop-blur">Product</span>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h5 class="mb-0">E-Commerce Core</h5>
                                </div>
                            </div>
                        </div>
                        <div class="project-card" style="height: 400px;">
                            <div class="position-relative h-100 rounded-3 overflow-hidden" style="background: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/5ee0a38a-b5d3-4531-8793-98beed4af162_800w.jpg') center/cover;">
                                <span class="badge bg-light text-dark position-absolute top-0 start-0 m-3">
                                    <i class="bi bi-film"></i>
                                </span>
                                <span class="badge bg-light bg-opacity-25 text-white position-absolute top-0 end-0 m-3 backdrop-blur">Motion</span>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h5 class="mb-0">Security Agent</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Case Study Section (Innovation with Quantum Labs) -->
<section class="case-study py-5">
    <div class="container">
        <div class="bg-white rounded-4 shadow-sm p-4 p-md-5">
            <div class="row mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <p class="text-uppercase text-muted small mb-2">(01) Innovation</p>
                    <h2 class="display-5 fw-bold mb-0">Accelerating Growth with Waveron</h2>
                </div>
                <div class="col-lg-6">
                    <p class="lead text-muted">Waveron empowers startups and enterprises with scalable digital solutions to accelerate growth, optimize operations, and engage users—delivering innovation, reliability, and measurable results.</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Large Feature Card -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100 p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4 class="fw-bold">Data-Driven Digital Strategy</h4>
                            <span class="badge bg-success fs-6">ROI Focused</span>
                        </div>
                        <p class="text-muted mb-4">Monitor campaign performance, user engagement, and business growth with our comprehensive analytics approach.</p>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="bg-success bg-opacity-10 rounded-3 p-4" style="height: 180px;">
                                    <div class="d-flex gap-2 mb-3">
                                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/184099c3-3f6c-4f6f-a05a-830150bf75c1_320w.jpg" class="rounded-circle" width="32" height="32" alt="Team">
                                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/292b814a-2c70-4f95-a74d-5a101fc0b698_320w.jpg" class="rounded-circle" width="32" height="32" alt="Team">
                                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/9e675575-668c-4087-8408-fa06dd33c5f0_320w.jpg" class="rounded-circle" width="32" height="32" alt="Team">
                                    </div>
                                    <span class="badge bg-white text-success small">
                                        <i class="bi bi-graph-up me-1"></i> Market Analysis
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2">
                                    <div class="bg-success bg-opacity-10 rounded-3 p-3 d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-success rounded-circle" style="width: 12px; height: 12px;"></div>
                                            <span class="small fw-medium">User Behavior</span>
                                        </div>
                                        <span class="badge bg-success-subtle text-success">Tracking</span>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 rounded-3 p-3 d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-warning rounded-circle" style="width: 12px; height: 12px;"></div>
                                            <span class="small fw-medium">Conversion Optimization</span>
                                        </div>
                                        <span class="badge bg-warning-subtle text-warning">Improving</span>
                                    </div>
                                    <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <div class="d-flex align-items-center gap-2 mb-1">
                                                    <div class="bg-info rounded-circle" style="width: 12px; height: 12px;"></div>
                                                    <span class="small fw-medium">Growth Metrics</span>
                                                </div>
                                                <p class="text-muted mb-0" style="font-size: 0.7rem;">Real-time dashboard reporting</p>
                                            </div>
                                            <span class="badge bg-info-subtle text-info">Live</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-lightning-fill me-1"></i> Impact Driven
                            </span>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-shield-check me-1"></i> Scalable Solutions
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Small Feature Card -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100 p-4">
                        <h5 class="fw-bold mb-3">Agile Development Cycles</h5>
                        <p class="text-muted small mb-4">Streamline product delivery with our iterative sprint methodology and continuous feedback loops.</p>

                        <div class="bg-light rounded-3 mb-3 overflow-hidden" style="height: 120px;">
                            <img src="{{ asset('images/services/short-sprints.webp') }}" class="img-fluid w-100 h-100" style="object-fit: cover;" alt="Short development sprints" loading="lazy">
                        </div>

                        <span class="badge bg-success bg-opacity-10 text-success">
                            <i class="bi bi-cpu me-1"></i> Rapid Deployment
                        </span>
                    </div>
                </div>

                <!-- Integration Card -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm h-100 p-4">
                        <h5 class="fw-bold mb-3">Seamless Ecosystem Integration</h5>
                        <p class="text-muted small mb-4">Connect your custom software with your existing tech stack and third-party services.</p>

                        <div class="d-flex flex-column gap-2">
                            <div class="border rounded-3 p-3 d-flex justify-content-between align-items-center">
                                <span class="small">01 API Development</span>
                                <i class="bi bi-check-circle-fill text-success"></i>
                            </div>
                            <div class="border rounded-3 p-3 d-flex justify-content-between align-items-center">
                                <span class="small">02 CRM Synchronization</span>
                                <i class="bi bi-check-circle-fill text-success"></i>
                            </div>
                            <div class="border border-warning rounded-3 p-3 d-flex justify-content-between align-items-center bg-warning bg-opacity-10">
                                <span class="small">03 Cloud Infrastructure</span>
                                <i class="bi bi-clock-fill text-warning"></i>
                            </div>
                            <div class="border rounded-3 p-3 d-flex justify-content-between align-items-center">
                                <span class="small">04 Legacy Migration</span>
                                <i class="bi bi-clock text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Card -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm h-100 p-4">
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2 mb-3">
                            <h4 class="fw-bold mb-0">Enterprise-Grade Security</h4>
                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                <span class="badge bg-success-subtle text-success">
                                    <i class="bi bi-shield-check me-1"></i> Best Practices
                                </span>
                                <span class="fs-5 fw-bold">Data Protection</span>
                            </div>
                        </div>
                        <p class="text-muted mb-4">Protect your digital assets and maintain trust with industry-leading security measures and automated compliance checks.</p>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="text-center bg-danger bg-opacity-10 rounded-3 p-4">
                                    <div class="bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-lock-fill"></i>
                                    </div>
                                    <h6 class="fw-bold">Encryption</h6>
                                    <p class="small text-muted mb-0">SSL & Data Encryption</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center bg-success bg-opacity-10 rounded-3 p-4">
                                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-eye-fill"></i>
                                    </div>
                                    <h6 class="fw-bold">Monitoring</h6>
                                    <p class="small text-muted mb-0">24/7 Uptime Checks</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center bg-success bg-opacity-10 rounded-3 p-4">
                                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
                                        <i class="bi bi-file-check-fill"></i>
                                    </div>
                                    <h6 class="fw-bold">Compliance</h6>
                                    <p class="small text-muted mb-0">GDPR & Standards</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Progress Timeline -->
            <div class="mt-5">
                <hr class="mb-4">
                <div class="row text-center small text-muted">
                    <div class="col">
                        <div class="d-inline-flex align-items-center gap-2">
                            <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                            DISCOVERY
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-inline-flex align-items-center gap-2">
                            <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                            PLANNING
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-inline-flex align-items-center gap-2">
                            <div class="bg-warning rounded-circle" style="width: 8px; height: 8px;"></div>
                            DEVELOPMENT
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-inline-flex align-items-center gap-2">
                            <div class="bg-secondary rounded-circle" style="width: 8px; height: 8px;"></div>
                            TESTING
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-inline-flex align-items-center gap-2">
                            <div class="bg-secondary rounded-circle" style="width: 8px; height: 8px;"></div>
                            DEPLOYMENT
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services/Differentiators Section -->
<section class="differentiators py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8">
                <p class="text-muted mb-2">What we do best</p>
                <h2 class="display-5 fw-bold mb-3">Strategy, design, and engineering—tightly integrated</h2>
                <p class="lead text-muted">We deliver end-to-end: from brand platforms and design systems to production-ready interfaces and high-performance marketing sites.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Main Feature - Product Development -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <img src="{{ asset('images/services/custom-software-web-apps.webp') }}" class="card-img-top" alt="Custom software and web app development" style="height: 400px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-success rounded-pill px-3 py-2">ENGINEERING</span>
                            <span class="text-muted small align-self-center">End-to-end product</span>
                        </div>
                        <h3 class="h2 fw-bold mb-3">Full-Cycle Product Development</h3>
                        <p class="text-muted mb-4">From initial concept to production deployment, we build scalable software solutions tailored to your business needs using modern tech stacks and agile methodologies.</p>
                        <div class="d-flex flex-column flex-sm-row gap-3">
                            <a href="{{ route('services') }}" class="btn btn-outline-dark rounded-pill">
                                <i class="bi bi-list-check me-2"></i> See process
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-success rounded-pill">
                                <i class="bi bi-calendar-plus me-2"></i> Book an intro call
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column Stack -->
            <div class="col-lg-4">
                <div class="d-flex flex-column gap-4 h-100">
                    <!-- Brand Identity -->
                    <div class="card border-0 shadow-sm flex-grow-1">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Brand Identity & Design</h5>
                                <span class="badge bg-light text-dark border rounded-pill">BRANDING</span>
                            </div>
                            <p class="text-muted small mb-3">Cohesive visual identities and component libraries that ensure consistency across all your digital touchpoints.</p>
                            <img src="{{ asset('images/services/brand-identity-design.webp') }}" class="img-fluid rounded-3" style="object-fit: cover;" alt="Brand identity and design" loading="lazy">
                        </div>
                    </div>

                    <!-- Web Platforms -->
                    <div class="card border-0 shadow-sm flex-grow-1">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">High-Performance Web Platforms</h5>
                                <span class="badge bg-light text-dark border rounded-pill">WEB DEV</span>
                            </div>
                            <p class="text-muted small mb-3">Fast, SEO-optimized websites built on modern frameworks to drive engagement and conversions.</p>
                            <img src="{{ asset('images/services/websites-online-stores.webp') }}" class="img-fluid rounded-3" style="object-fit: cover;" alt="Websites and online stores" loading="lazy">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Row -->
        <div class="row g-4 mt-2">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h5 class="fw-bold mb-0">Market Research & Validation</h5>
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill">STRATEGY</span>
                        </div>
                        <p class="text-muted small mb-3">Data-driven insights to validate your product ideas and identify key market opportunities.</p>
                        <img src="{{ asset('images/services/business-systems-integrations.webp') }}" class="img-fluid rounded-3" style="object-fit: cover;" alt="Business systems and integrations" loading="lazy">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Digital Marketing & Content</h5>
                        <p class="text-muted small mb-3">Compelling content strategies and targeted campaigns to grow your audience and boost ROI.</p>
                        <img src="{{ asset('images/services/seo-digital-marketing.webp') }}" class="img-fluid rounded-3" style="object-fit: cover;" alt="SEO and digital marketing growth" loading="lazy">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Strategic Partnerships</h5>
                        <p class="text-muted small mb-3">We work as an extension of your team, providing ongoing support and strategic guidance.</p>
                        <img src="{{ asset('images/services/ongoing-support-care.webp') }}" class="img-fluid rounded-3" style="object-fit: cover;" alt="Ongoing website support and security" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-5">
    <div class="container">
        <div class="row mb-4 align-items-end">
            <div class="col-lg-8">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-2 fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">PRICING</span>
                <h2 class="display-5 fw-bold mb-3">Clear pricing. No surprises.</h2>
                <p class="lead text-muted mb-0">Fixed quotes before we start. Pay in milestones. Prices are starting points and depend on your scope.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <!-- Currency Toggle -->
                <div class="d-inline-flex align-items-center p-1 bg-light border rounded-pill shadow-sm" id="currency-toggle-wrapper">
                    <button type="button" class="btn btn-sm rounded-pill px-3 fw-bold active-currency-btn" id="currency-kes-btn" onclick="setPricingCurrency('KES')">KES (Ksh)</button>
                    <button type="button" class="btn btn-sm rounded-pill px-3 fw-bold text-muted" id="currency-usd-btn" onclick="setPricingCurrency('USD')">USD ($)</button>
                </div>
            </div>
        </div>

        <!-- 4-Card Pricing Grid -->
        <div class="row g-4 mb-4">
            <!-- Card 1: Launch -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-2 rounded-4 shadow-sm hover-lift d-flex flex-column">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">Launch</h4>
                            <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1 small">Starter</span>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-baseline gap-1 mb-1">
                                <h3 class="display-6 fw-bold mb-0 price-launch">KES 45,000</h3>
                            </div>
                            <span class="text-muted small price-sub-launch">starting price (≈ $350)</span>
                            <p class="text-muted small mt-2 mb-0" style="min-height: 40px;">Personal brands, freelancers, students and portfolios.</p>
                        </div>

                        <hr class="my-3">

                        <ul class="list-unstyled mb-4 small flex-grow-1">
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Up to 5 pages</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Mobile responsive design</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Contact form + WhatsApp button</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Basic SEO setup</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>1 month free support</span>
                            </li>
                        </ul>

                        <a href="https://wa.me/254798717800?text=Hi%20Waveron%2C%20I%27m%20interested%20in%20the%20Launch%20plan.%20Can%20we%20talk%3F" 
                           target="_blank" 
                           rel="noopener" 
                           aria-label="Chat with Waveron on WhatsApp" 
                           class="btn btn-outline-dark w-100 rounded-pill d-inline-flex align-items-center justify-content-center gap-2 mt-auto">
                            <i class="bi bi-whatsapp"></i> Get Started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Business [Popular badge] -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-success border-2 rounded-4 shadow-lg position-relative hover-lift d-flex flex-column" style="background-color: #f6fdf8;">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0 text-success">Business</h4>
                            <span class="badge bg-success rounded-pill px-3 py-1.5 shadow-sm">Popular</span>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-baseline gap-1 mb-1">
                                <h3 class="display-6 fw-bold mb-0 price-business">KES 120,000</h3>
                            </div>
                            <span class="text-muted small price-sub-business">starting price (≈ $950)</span>
                            <p class="text-muted small mt-2 mb-0" style="min-height: 40px;">Small and growing businesses that need a site that brings in customers.</p>
                        </div>

                        <hr class="my-3">

                        <ul class="list-unstyled mb-4 small flex-grow-1">
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Up to 12 pages</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Custom design to your brand</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Blog or news section</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>SEO setup + Google Business Profile</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Google Analytics</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>3 months free support</span>
                            </li>
                        </ul>

                        <a href="https://wa.me/254798717800?text=Hi%20Waveron%2C%20I%27m%20interested%20in%20the%20Business%20plan.%20Can%20we%20talk%3F" 
                           target="_blank" 
                           rel="noopener" 
                           aria-label="Chat with Waveron on WhatsApp" 
                           class="btn btn-success w-100 rounded-pill d-inline-flex align-items-center justify-content-center gap-2 mt-auto shadow-sm">
                            <i class="bi bi-whatsapp"></i> Get Started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Growth -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-2 rounded-4 shadow-sm hover-lift d-flex flex-column">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">Growth</h4>
                            <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1 small">E-commerce</span>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-baseline gap-1 mb-1">
                                <h3 class="display-6 fw-bold mb-0 price-growth">KES 280,000</h3>
                            </div>
                            <span class="text-muted small price-sub-growth">starting price (≈ $2,200)</span>
                            <p class="text-muted small mt-2 mb-0" style="min-height: 40px;">E-commerce stores and businesses that need custom features.</p>
                        </div>

                        <hr class="my-3">

                        <ul class="list-unstyled mb-4 small flex-grow-1">
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Online store or custom web app</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Payment integration (M-Pesa, card, PayPal)</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Customer accounts + admin dashboard</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Third-party integrations</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>3 months free support</span>
                            </li>
                        </ul>

                        <a href="https://wa.me/254798717800?text=Hi%20Waveron%2C%20I%27m%20interested%20in%20the%20Growth%20plan.%20Can%20we%20talk%3F" 
                           target="_blank" 
                           rel="noopener" 
                           aria-label="Chat with Waveron on WhatsApp" 
                           class="btn btn-outline-dark w-100 rounded-pill d-inline-flex align-items-center justify-content-center gap-2 mt-auto">
                            <i class="bi bi-whatsapp"></i> Get Started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 4: Enterprise -->
            <div class="col-lg-3 col-md-6">
                <div class="card h-100 border-2 rounded-4 shadow-sm hover-lift d-flex flex-column">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="fw-bold mb-0">Enterprise</h4>
                            <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1 small">Custom Build</span>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex align-items-baseline gap-1 mb-1">
                                <h3 class="display-6 fw-bold mb-0">Custom</h3>
                            </div>
                            <span class="text-muted small">tailored to your scope</span>
                            <p class="text-muted small mt-2 mb-0" style="min-height: 40px;">Organisations that need custom software, business systems or long-term development.</p>
                        </div>

                        <hr class="my-3">

                        <ul class="list-unstyled mb-4 small flex-grow-1">
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Custom software &amp; business systems</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>ERP, CRM and API integrations</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Advanced security</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Dedicated project manager</span>
                            </li>
                            <li class="d-flex gap-2 mb-2.5">
                                <i class="bi bi-check-circle-fill text-success flex-shrink-0"></i>
                                <span>Flexible team that scales with you</span>
                            </li>
                        </ul>

                        <a href="{{ route('quote') }}" class="btn btn-dark w-100 rounded-pill d-inline-flex align-items-center justify-content-center gap-2 mt-auto">
                            Request a Quote <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Care Plan Add-On Row -->
        <div class="p-3 p-md-4 rounded-4 bg-light border d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-5">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px;">
                    <i class="bi bi-shield-check fs-5"></i>
                </div>
                <div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2.5 py-1 mb-1 small fw-bold">CARE PLAN ADD-ON</span>
                    <p class="mb-0 text-dark small fw-medium">Keep your site fast, secure and updated. <strong id="care-plan-text">From KES 8,000 / $65 per month.</strong> Includes updates, backups, security monitoring and small changes.</p>
                </div>
            </div>
            <a href="https://wa.me/254798717800?text=Hi%20Waveron%2C%20I%27d%20like%20to%20discuss%20the%20Care%20Plan." target="_blank" rel="noopener" aria-label="Chat with Waveron on WhatsApp" class="btn btn-outline-dark btn-sm rounded-pill px-3 whitespace-nowrap">
                Add Care Plan
            </a>
        </div>

        <!-- Pricing Footer Info -->
        <div class="row g-4 text-muted small">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span class="badge bg-light text-dark border">What's included</span>
                </div>
                <p>Every plan includes weekly updates, a shared roadmap and full ownership of your source code.</p>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span class="badge bg-light text-dark border">Flexible scope</span>
                </div>
                <p>Start small and add features as you grow. Pause between phases anytime.</p>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span class="badge bg-light text-dark border">Custom engagements</span>
                </div>
                <p>Not sure which plan fits? Message us and we'll recommend one in plain language.</p>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    :root {
        --primary-color: #006400;
        --secondary-color: #004d00;
    }

    .hero {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        overflow: hidden;
    }

    /* Mobile: don't stretch to full viewport height; wrap content with padding instead */
    @media (max-width: 991.98px) {
        .hero {
            min-height: auto !important;
            padding-top: 3rem;
            padding-bottom: 3rem;
        }
    }

    @media (min-width: 992px) {
        .hero {
            padding-top: 0;
        }
    }

    /* On mobile: slide illustration behind text as decorative layer */
    @media (max-width: 991.98px) {
        .hero-illustration-col {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            width: 100%;
            max-width: 100%;
            opacity: 0.1;
            pointer-events: none;
            z-index: 0;
        }
        .hero-content-col {
            position: relative;
            z-index: 1;
        }
    }

    .shape-blob {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 300px;
        height: 300px;
        background: linear-gradient(45deg, #006400, #004d00);
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        opacity: 0.1;
        animation: blob-animation 8s infinite;
    }

    .shape-blob2 {
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 250px;
        height: 250px;
        background: linear-gradient(45deg, #004d00, #003300);
        border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        opacity: 0.1;
        animation: blob-animation 8s infinite reverse;
    }

    @keyframes blob-animation {
        0% {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }

        50% {
            border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        }

        100% {
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        }
    }

    .feature-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    .service-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
    }

    .hero .btn,
    .portfolio-showcase .btn,
    .case-study .btn,
    #pricing .btn {
        padding: 0.8rem 1.8rem;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.25s ease;
    }

    .hero .btn-lg,
    .portfolio-showcase .btn-lg,
    .case-study .btn-lg,
    #pricing .btn-lg {
        padding: 0.9rem 2.2rem;
    }

    .hero .btn:hover,
    .portfolio-showcase .btn:hover,
    .case-study .btn:hover,
    #pricing .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .hover-lift {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .hover-lift:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08) !important;
    }

    /* Currency toggle styling */
    .active-currency-btn {
        background-color: var(--waveron-green, #006400) !important;
        color: #ffffff !important;
        box-shadow: 0 2px 6px rgba(0, 100, 0, 0.25);
    }
</style>
@endpush

<script>
    function setPricingCurrency(currency) {
        const kesBtn = document.getElementById('currency-kes-btn');
        const usdBtn = document.getElementById('currency-usd-btn');
        const priceLaunch = document.querySelector('.price-launch');
        const priceSubLaunch = document.querySelector('.price-sub-launch');
        const priceBusiness = document.querySelector('.price-business');
        const priceSubBusiness = document.querySelector('.price-sub-business');
        const priceGrowth = document.querySelector('.price-growth');
        const priceSubGrowth = document.querySelector('.price-sub-growth');
        const carePlanText = document.getElementById('care-plan-text');

        if (currency === 'USD') {
            usdBtn.classList.add('active-currency-btn');
            usdBtn.classList.remove('text-muted');
            kesBtn.classList.remove('active-currency-btn');
            kesBtn.classList.add('text-muted');

            if (priceLaunch) priceLaunch.textContent = '$350';
            if (priceSubLaunch) priceSubLaunch.textContent = 'starting price (≈ KES 45,000)';
            if (priceBusiness) priceBusiness.textContent = '$950';
            if (priceSubBusiness) priceSubBusiness.textContent = 'starting price (≈ KES 120,000)';
            if (priceGrowth) priceGrowth.textContent = '$2,200';
            if (priceSubGrowth) priceSubGrowth.textContent = 'starting price (≈ KES 280,000)';
            if (carePlanText) carePlanText.textContent = 'From $65 / KES 8,000 per month.';
        } else {
            kesBtn.classList.add('active-currency-btn');
            kesBtn.classList.remove('text-muted');
            usdBtn.classList.remove('active-currency-btn');
            usdBtn.classList.add('text-muted');

            if (priceLaunch) priceLaunch.textContent = 'KES 45,000';
            if (priceSubLaunch) priceSubLaunch.textContent = 'starting price (≈ $350)';
            if (priceBusiness) priceBusiness.textContent = 'KES 120,000';
            if (priceSubBusiness) priceSubBusiness.textContent = 'starting price (≈ $950)';
            if (priceGrowth) priceGrowth.textContent = 'KES 280,000';
            if (priceSubGrowth) priceSubGrowth.textContent = 'starting price (≈ $2,200)';
            if (carePlanText) carePlanText.textContent = 'From KES 8,000 / $65 per month.';
        }
    }
</script>
@endsection