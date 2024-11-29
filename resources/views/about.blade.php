@extends('layouts.app')

@section('title', 'About Us - Waveron Technologies')

@section('content')
<!-- Hero Section -->
<div class="about-hero py-5">
    <div class="animated-background"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Innovating for Tomorrow</h1>
                <p class="lead mb-4">At Waveron Technologies, we're dedicated to transforming ideas into cutting-edge solutions that drive the future of technology.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">Get Started</a>
            </div>
        </div>
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
    :root {
        --waveron-green: #006400;
        --waveron-dark-green: #004d00;
    }

    .about-hero {
        position: relative;
        padding: 8rem 0 4rem;
        overflow: hidden;
        background: rgba(248, 249, 250, 0.97);
        perspective: 1000px;
    }

    .animated-background {
        position: absolute;
        top: -50%;
        left: -50%;
        right: -50%;
        bottom: -50%;
        transform-style: preserve-3d;
        animation: rotate3d 30s linear infinite;
    }

    .tech-grid {
        position: absolute;
        width: 200%;
        height: 200%;
        transform: rotateX(60deg) translateZ(-100px);
    }

    /* 3D Grid Planes */
    .grid-plane {
        position: absolute;
        width: 100%;
        height: 100%;
        background: 
            linear-gradient(90deg, transparent 49.5%, rgba(0, 100, 0, 0.1) 49.5%, rgba(0, 100, 0, 0.1) 50.5%, transparent 50.5%) 0 0/50px 100%,
            linear-gradient(0deg, transparent 49.5%, rgba(0, 100, 0, 0.1) 49.5%, rgba(0, 100, 0, 0.1) 50.5%, transparent 50.5%) 0 0/100% 50px;
        transform-style: preserve-3d;
    }

    .grid-plane:nth-child(1) { transform: translateZ(0); }
    .grid-plane:nth-child(2) { transform: translateZ(-50px); opacity: 0.7; }
    .grid-plane:nth-child(3) { transform: translateZ(-100px); opacity: 0.5; }

    /* 3D Circuit Lines */
    .circuit-lines {
        position: absolute;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
    }

    .circuit-line {
        position: absolute;
        background: var(--waveron-green);
        opacity: 0.2;
        transform-style: preserve-3d;
        animation: glowPulse 2s ease-in-out infinite;
    }

    /* Floating Tech Elements */
    .tech-element {
        position: absolute;
        width: 20px;
        height: 20px;
        background: var(--waveron-green);
        transform-style: preserve-3d;
        opacity: 0.3;
        animation: float 4s ease-in-out infinite;
    }

    /* 3D Data Flow */
    .data-stream {
        position: absolute;
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom, transparent, var(--waveron-green), transparent);
        opacity: 0.2;
        transform-style: preserve-3d;
        animation: dataFlow 3s linear infinite;
    }

    @keyframes rotate3d {
        0% {
            transform: rotateX(60deg) rotateZ(0);
        }
        100% {
            transform: rotateX(60deg) rotateZ(360deg);
        }
    }

    @keyframes glowPulse {
        0%, 100% { opacity: 0.2; box-shadow: 0 0 10px var(--waveron-green); }
        50% { opacity: 0.4; box-shadow: 0 0 20px var(--waveron-green); }
    }

    @keyframes float {
        0%, 100% { transform: translateZ(0); }
        50% { transform: translateZ(50px); }
    }

    @keyframes dataFlow {
        0% { transform: translateY(-100%) translateZ(0); opacity: 0; }
        50% { opacity: 0.4; }
        100% { transform: translateY(100%) translateZ(100px); opacity: 0; }
    }

    .about-hero .container {
        position: relative;
        z-index: 2;
    }

    .btn-primary {
        background-color: var(--waveron-green);
        border-color: var(--waveron-green);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--waveron-dark-green);
        border-color: var(--waveron-dark-green);
    }

    .text-primary {
        color: var(--waveron-green) !important;
    }

    .bg-primary {
        background-color: var(--waveron-green) !important;
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        background: var(--waveron-green) !important;
        color: white;
    }
    
    .value-icon {
        transition: transform 0.3s ease;
        color: var(--waveron-green) !important;
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
        color: var(--waveron-green) !important;
    }
    
    .card {
        transition: transform 0.3s ease;
        border: 1px solid #eee;
    }
    
    .card:hover {
        transform: translateY(-5px);
        border-color: var(--waveron-green);
    }

    .cta {
        background: var(--waveron-green) !important;
    }

    .btn-light {
        background: white;
        color: var(--waveron-green);
        border: 2px solid var(--waveron-green);
    }

    .btn-light:hover {
        background: var(--waveron-green);
        color: white;
    }
</style>
@endpush

<script>
document.addEventListener('DOMContentLoaded', function() {
    const background = document.querySelector('.animated-background');
    
    // Create 3D Grid
    const techGrid = document.createElement('div');
    techGrid.className = 'tech-grid';
    for (let i = 0; i < 3; i++) {
        const plane = document.createElement('div');
        plane.className = 'grid-plane';
        techGrid.appendChild(plane);
    }
    background.appendChild(techGrid);

    // Create Circuit Lines
    const circuitLines = document.createElement('div');
    circuitLines.className = 'circuit-lines';
    for (let i = 0; i < 20; i++) {
        const line = document.createElement('div');
        line.className = 'circuit-line';
        const isVertical = Math.random() > 0.5;
        const size = 50 + Math.random() * 150;
        const position = Math.random() * 100;
        const depth = Math.random() * 100;
        
        line.style.cssText = `
            ${isVertical ? 'width: 2px; height: ${size}px; left: ${position}%;' 
                        : 'height: 2px; width: ${size}px; top: ${position}%;'}
            transform: translateZ(${depth}px);
            animation-delay: ${Math.random() * 2}s;
        `;
        circuitLines.appendChild(line);
    }
    background.appendChild(circuitLines);

    // Create Floating Tech Elements
    for (let i = 0; i < 15; i++) {
        const element = document.createElement('div');
        element.className = 'tech-element';
        element.style.cssText = `
            left: ${Math.random() * 100}%;
            top: ${Math.random() * 100}%;
            transform: translateZ(${Math.random() * 100}px);
            animation-delay: ${Math.random() * 4}s;
        `;
        background.appendChild(element);
    }

    // Create Data Streams
    for (let i = 0; i < 30; i++) {
        const stream = document.createElement('div');
        stream.className = 'data-stream';
        stream.style.cssText = `
            left: ${Math.random() * 100}%;
            animation-delay: ${Math.random() * 3}s;
            transform: translateZ(${Math.random() * 100}px);
        `;
        background.appendChild(stream);
    }
});
</script>

@endsection
