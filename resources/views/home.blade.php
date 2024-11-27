@extends('layouts.app')

@section('title', 'Waveron Technologies - Innovation\'s Crest, Tomorrow\'s Best')

@section('content')
<!-- Hero Section -->
<div class="hero min-vh-100 d-flex align-items-center position-relative">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4 text-primary">Innovation's Crest,<br>Tomorrow's Best</h1>
                <p class="lead mb-4">A pioneering technology firm dedicated to creating cutting-edge solutions that propel businesses into the future. We harness the power of advanced technology to transform industries and elevate the human experience.</p>
                <div class="d-flex gap-3">
                    <a href="#services" class="btn btn-primary btn-lg">Explore Services</a>
                    <a href="#contact" class="btn btn-outline-primary btn-lg">Get Started</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="position-relative">
                    <div class="shape-blob"></div>
                    <div class="shape-blob2"></div>
                    <img src="{{ asset('images/hero-illustration.svg') }}" alt="Innovation Illustration" class="img-fluid position-relative">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold text-primary mb-4">Our Vision</h2>
                <p class="lead mb-4">At Waveron Technologies, we believe in the boundless potential of technology. Our team of visionary engineers, designers, and strategists work collaboratively to push the boundaries of what's possible.</p>
                <p class="text-muted">We are more than just a tech company; we are a catalyst for change. Our mission is to lead the wave of technological advancement, empowering businesses to thrive in the digital age and beyond.</p>
            </div>
            <div class="col-lg-6">
                <div class="row g-4">
                    <div class="col-6">
                        <div class="p-4 bg-white rounded-3 shadow-sm text-center">
                            <i class="bi bi-lightbulb text-primary display-4"></i>
                            <h3 class="h5 mt-3">Innovation</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 bg-white rounded-3 shadow-sm text-center">
                            <i class="bi bi-gear text-primary display-4"></i>
                            <h3 class="h5 mt-3">Technology</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 bg-white rounded-3 shadow-sm text-center">
                            <i class="bi bi-people text-primary display-4"></i>
                            <h3 class="h5 mt-3">Collaboration</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-4 bg-white rounded-3 shadow-sm text-center">
                            <i class="bi bi-graph-up-arrow text-primary display-4"></i>
                            <h3 class="h5 mt-3">Growth</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary">Our Core Services</h2>
            <p class="lead text-muted">Comprehensive solutions for tomorrow's challenges</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-code-square"></i>
                        </div>
                        <h3 class="h4 mb-3">Software Development</h3>
                        <p class="text-muted mb-0">Crafting tailored software solutions that drive efficiency and innovation for businesses of all sizes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-palette"></i>
                        </div>
                        <h3 class="h4 mb-3">Graphic Design</h3>
                        <p class="text-muted mb-0">Creating visually stunning and impactful designs that communicate your brand's message effectively.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3 class="h4 mb-3">Digital Marketing</h3>
                        <p class="text-muted mb-0">Utilizing data-driven strategies to enhance online presence, engage audiences, and drive growth.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm service-card">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-3 mb-3">
                            <i class="bi bi-stars"></i>
                        </div>
                        <h3 class="h4 mb-3">Branding</h3>
                        <p class="text-muted mb-0">Building strong, cohesive brands that resonate with target audiences and stand out in competitive markets.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section id="contact" class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="display-5 fw-bold mb-4">Shape the Future Together</h2>
                <p class="lead mb-5">Join us on our journey as we navigate the infinite possibilities of technology and create tomorrow's solutions today.</p>
                <div class="d-flex justify-content-center gap-4">
                    <a href="mailto:contact@waveron.com" class="btn btn-light btn-lg">
                        <i class="bi bi-envelope me-2"></i>Contact Us
                    </a>
                    <a href="#" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-arrow-right me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    :root {
        --primary-color: #0056b3;
        --secondary-color: #00a0e4;
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
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
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
        background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
        border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        opacity: 0.1;
        animation: blob-animation 8s infinite reverse;
    }

    @keyframes blob-animation {
        0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
        100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
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
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
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
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>
@endpush
@endsection
