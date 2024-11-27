@extends('layouts.app')

@section('title', 'About Us - Waveron Technologies')

@section('content')
<!-- Hero Section -->
<div class="about-hero bg-primary text-white py-5">
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Innovating for Tomorrow</h1>
                <p class="lead mb-4">At Waveron Technologies, we're dedicated to transforming ideas into cutting-edge solutions that drive the future of technology.</p>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">Get Started</a>
            </div>
        </div>
        <div class="hero-pattern"></div>
    </div>
</div>

<!-- Our Story Section -->
<section class="our-story py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Our Story</h2>
                <p class="lead text-muted mb-5">Founded with a vision to revolutionize the technological landscape, Waveron Technologies has grown from a small startup to a leading innovator in the industry.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-lightbulb"></i>
                        </div>
                        <h3 class="h4 mb-3">Innovation First</h3>
                        <p class="text-muted">We constantly push the boundaries of what's possible, turning innovative ideas into reality.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3 class="h4 mb-3">Client-Centric</h3>
                        <p class="text-muted">Your success is our priority. We work closely with our clients to deliver solutions that exceed expectations.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3 class="h4 mb-3">Sustainable Growth</h3>
                        <p class="text-muted">We believe in sustainable development and creating long-term value for our stakeholders.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section class="our-values py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Our Values</h2>
                <p class="lead text-muted">The principles that guide everything we do</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-star text-primary display-4"></i>
                    </div>
                    <h3 class="h5 mb-3">Excellence</h3>
                    <p class="text-muted">Striving for excellence in every project we undertake</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-shield-check text-primary display-4"></i>
                    </div>
                    <h3 class="h5 mb-3">Integrity</h3>
                    <p class="text-muted">Maintaining the highest standards of integrity and ethics</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-lightning text-primary display-4"></i>
                    </div>
                    <h3 class="h5 mb-3">Innovation</h3>
                    <p class="text-muted">Embracing new ideas and cutting-edge technologies</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-heart text-primary display-4"></i>
                    </div>
                    <h3 class="h5 mb-3">Passion</h3>
                    <p class="text-muted">Passionate about creating impactful solutions</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="our-team py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Our Leadership Team</h2>
                <p class="lead text-muted">Meet the people driving innovation at Waveron Technologies</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('images/team/ceo.jpg') }}" class="card-img-top" alt="CEO">
                    <div class="card-body text-center p-4">
                        <h3 class="h4 mb-2">John Smith</h3>
                        <p class="text-muted mb-3">Chief Executive Officer</p>
                        <div class="social-links">
                            <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-muted me-2"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('images/team/cto.jpg') }}" class="card-img-top" alt="CTO">
                    <div class="card-body text-center p-4">
                        <h3 class="h4 mb-2">Sarah Johnson</h3>
                        <p class="text-muted mb-3">Chief Technology Officer</p>
                        <div class="social-links">
                            <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-muted me-2"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <img src="{{ asset('images/team/coo.jpg') }}" class="card-img-top" alt="COO">
                    <div class="card-body text-center p-4">
                        <h3 class="h4 mb-2">Michael Chen</h3>
                        <p class="text-muted mb-3">Chief Operations Officer</p>
                        <div class="social-links">
                            <a href="#" class="text-muted me-2"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="text-muted me-2"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta bg-primary text-white py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="h1 mb-4">Ready to Transform Your Ideas into Reality?</h2>
                <p class="lead mb-4">Join us in shaping the future of technology.</p>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .about-hero {
        background: linear-gradient(45deg, var(--bs-primary) 0%, #00a0e4 100%);
        position: relative;
        overflow: hidden;
        padding: 6rem 0;
    }
    
    .hero-pattern {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 50%;
        background: 
            radial-gradient(circle at 0 0, rgba(255,255,255,0.1) 0, rgba(255,255,255,0.1) 5px, transparent 5px) 0 0/20px 20px,
            radial-gradient(circle at 10px 10px, rgba(255,255,255,0.1) 0, rgba(255,255,255,0.1) 5px, transparent 5px) 0 0/20px 20px;
        transform: skewX(-15deg) translateX(10%);
        animation: patternMove 30s linear infinite;
    }
    
    @keyframes patternMove {
        0% {
            background-position: 0 0;
        }
        100% {
            background-position: 50px 50px;
        }
    }
    
    .about-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        transform: rotate(-15deg);
    }
    
    .feature-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .value-icon {
        transition: transform 0.3s ease;
    }
    
    .value-icon:hover {
        transform: translateY(-5px);
    }
    
    .social-links a {
        text-decoration: none;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }
    
    .social-links a:hover {
        color: var(--bs-primary) !important;
    }
    
    .card {
        transition: transform 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
@endsection
