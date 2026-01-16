@extends('layouts.app')

@section('title', 'Waveron Technologies - Innovation\'s Crest, Tomorrow\'s Best')

@section('content')
<!-- Hero Section -->
<div class="hero min-vh-100 d-flex align-items-center position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4 text-primary">Innovation's Crest,<br>Tomorrow's Best</h1>
                <p class="lead mb-4">A pioneering technology firm dedicated to creating cutting-edge solutions that
                    propel businesses into the future. We harness the power of advanced technology to transform
                    industries and elevate the human experience.</p>
                <div class="d-flex gap-3">
                    <a href="#services" class="btn btn-primary btn-lg">Explore Services</a>
                    <a href="#contact" class="btn btn-outline-primary btn-lg">Get Started</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="position-relative">
                    <div class="shape-blob"></div>
                    <div class="shape-blob2"></div>
                    <img src="{{ asset('images/hero-illustration.svg') }}" alt="Innovation Illustration"
                        class="img-fluid position-relative">
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
                    <a href="#work" class="btn btn-dark rounded-pill">
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
                                    <h5 class="mb-0">Arcadia OS</h5>
                                </div>
                            </div>
                        </div>
                        <div class="project-card" style="height: 300px;">
                            <div class="position-relative h-100 rounded-3 overflow-hidden" style="background: url('https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/9b13123e-ec51-4d3a-b994-c64aab4555ba_800w.jpg') center/cover;">
                                <span class="badge bg-light text-dark position-absolute top-0 start-0 m-3">
                                    <i class="bi bi-activity"></i>
                                </span>
                                <span class="badge bg-light bg-opacity-25 text-white position-absolute top-0 end-0 m-3 backdrop-blur">Health</span>
                                <div class="position-absolute bottom-0 start-0 p-3 text-white">
                                    <h5 class="mb-0">Helix Care</h5>
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
                                    <h5 class="mb-0">Nimbus Finance</h5>
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
                                    <h5 class="mb-0">Lumen AI</h5>
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
                                <div class="bg-primary bg-opacity-10 rounded-3 p-4" style="height: 180px;">
                                    <div class="d-flex gap-2 mb-3">
                                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/184099c3-3f6c-4f6f-a05a-830150bf75c1_320w.jpg" class="rounded-circle" width="32" height="32" alt="Team">
                                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/292b814a-2c70-4f95-a74d-5a101fc0b698_320w.jpg" class="rounded-circle" width="32" height="32" alt="Team">
                                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/9e675575-668c-4087-8408-fa06dd33c5f0_320w.jpg" class="rounded-circle" width="32" height="32" alt="Team">
                                    </div>
                                    <span class="badge bg-white text-primary small">
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

                        <div class="bg-light rounded-3 p-3 mb-3">
                            <canvas id="workChart" height="120"></canvas>
                        </div>

                        <span class="badge bg-primary bg-opacity-10 text-primary">
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
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h4 class="fw-bold">Enterprise-Grade Security</h4>
                            <div class="d-flex gap-2 align-items-center">
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
                                <div class="text-center bg-primary bg-opacity-10 rounded-3 p-4">
                                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 48px; height: 48px;">
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
                    <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/8eb65de1-5616-4a1b-a6cb-f2a48d70bcb7_1600w.jpg" class="card-img-top" alt="Sprint workshop" style="height: 400px; object-fit: cover;">
                    <div class="card-body p-4">
                        <div class="d-flex gap-2 mb-3">
                            <span class="badge bg-success rounded-pill px-3 py-2">ENGINEERING</span>
                            <span class="text-muted small align-self-center">End-to-end product</span>
                        </div>
                        <h3 class="h2 fw-bold mb-3">Full-Cycle Product Development</h3>
                        <p class="text-muted mb-4">From initial concept to production deployment, we build scalable software solutions tailored to your business needs using modern tech stacks and agile methodologies.</p>
                        <div class="d-flex gap-3">
                            <a href="#services" class="btn btn-outline-dark rounded-pill">
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
                            <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/97aab9d9-1ab5-4a9b-a254-33095a9fadf2_800w.jpg" class="img-fluid rounded-3" alt="Design system">
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
                            <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/452fb7c8-d2af-414b-9dd0-99ba9a76cc5a_800w.jpg" class="img-fluid rounded-3" alt="Website performance">
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
                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/3499908d-d502-44d2-9721-9b471b0460bb_800w.jpg" class="img-fluid rounded-3" alt="Research">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Digital Marketing & Content</h5>
                        <p class="text-muted small mb-3">Compelling content strategies and targeted campaigns to grow your audience and boost ROI.</p>
                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/f03d228e-5eab-4149-af94-7d6c5c2eb5c5_800w.jpg" class="img-fluid rounded-3" alt="Motion">
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Strategic Partnerships</h5>
                        <p class="text-muted small mb-3">We work as an extension of your team, providing ongoing support and strategic guidance.</p>
                        <img src="https://hoirqrkdgbmvpwutwuwj.supabase.co/storage/v1/object/public/assets/assets/0153dbec-e119-4666-b642-3f8e0284fb69_800w.jpg" class="img-fluid rounded-3" alt="Partnership">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8">
                <p class="text-muted mb-2">Transparent pricing</p>
                <h2 class="display-5 fw-bold mb-3">Plans that match how you ship</h2>
                <p class="lead text-muted">Clear scopes, fixed sprints, and embedded options. No surprises—just momentum.</p>
            </div>
            <div class="col-lg-4 text-lg-end d-flex align-items-center justify-content-lg-end">
                <a href="#contact" class="btn btn-dark rounded-pill">
                    Get a tailored quote
                    <i class="bi bi-arrow-up-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="row g-4 mb-5 justify-content-center">
            <!-- Popular / Student -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-2 rounded-4 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0">Popular</h4>
                            <span class="badge bg-success rounded-pill px-3 py-2">Students & Portfolio</span>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-baseline gap-2 mb-2">
                                <h2 class="display-6 fw-bold mb-0">$500</h2>
                                <span class="text-muted">starting price</span>
                            </div>
                            <p class="text-muted small">Perfect for personal brands, students, and creative portfolios.</p>
                        </div>

                        <ul class="list-unstyled mb-4">
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Professional Portfolio Website</span>
                            </li>
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Mobile Responsive Design</span>
                            </li>
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Basic SEO Setup</span>
                            </li>
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>1 Month Support</span>
                            </li>
                        </ul>

                        <a href="{{ route('contact') }}" class="btn btn-outline-dark w-100 rounded-pill">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>

            <!-- Custom / Quote -->
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-success border-2 rounded-4 shadow-lg position-relative hover-lift">
                    <div class="card-body p-4 bg-success bg-opacity-10">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="fw-bold mb-0">Custom</h4>
                            <span class="badge bg-success bg-opacity-25 text-success border border-success rounded-pill">Enterprise & Agency</span>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex align-items-baseline gap-2 mb-2">
                                <h2 class="display-6 fw-bold mb-0">Custom</h2>
                                <span class="text-muted">tailored to you</span>
                            </div>
                            <p class="text-muted small">For businesses needing scalable, high-performance solutions.</p>
                        </div>

                        <ul class="list-unstyled mb-4">
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Full-Stack Development</span>
                            </li>
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Advanced Design Systems</span>
                            </li>
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>API Integrations & Security</span>
                            </li>
                            <li class="d-flex gap-3 mb-3">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span>Dedicated Project Manager</span>
                            </li>
                        </ul>

                        <a href="{{ route('quote') }}" class="btn btn-success w-100 rounded-pill">
                            Request a Quote
                            <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Footer Info -->
        <div class="row g-4 text-muted small">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span class="badge bg-light text-dark border">What's included</span>
                </div>
                <p>Every plan includes weekly demos, shared roadmaps, async updates, and access to source files or repos.</p>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span class="badge bg-light text-dark border">Flexible scope</span>
                </div>
                <p>Pause between sprints. Scale pods up or down as priorities shift.</p>
            </div>
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                    <span class="badge bg-light text-dark border">Custom engagements</span>
                </div>
                <p>Have a unique scope? We'll tailor a plan and price to your goals.</p>
            </div>
        </div>
    </div>
</section>


@include('partials.footer')
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

    .btn {
        padding: 0.8rem 2rem;
        border-radius: 50px;
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-lg {
        padding: 1rem 2.5rem;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .hero-image {
        filter: hue-rotate(85deg) saturate(120%) brightness(85%);
    }
</style>
@endpush

@endsection