@extends('layouts.app')

@section('title', 'Digital Marketing - Waveron Technologies')

@push('styles')
<style>
    .marketing-hero {
        position: relative;
        padding: 8rem 0 4rem;
        overflow: hidden;
        background: rgba(248, 249, 250, 0.97);
        perspective: 1000px;
    }

    .animated-waves {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.7;
        transform-style: preserve-3d;
    }

    .wave {
        position: absolute;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, 
            rgba(0, 100, 0, 0.1),
            rgba(0, 77, 0, 0.1),
            rgba(0, 100, 0, 0.1)
        );
        animation: waveFlow 20s infinite linear;
    }

    .wave:nth-child(1) {
        top: -50%;
        left: -50%;
        transform: rotate(0deg);
    }

    .wave:nth-child(2) {
        top: -50%;
        left: -50%;
        transform: rotate(60deg);
        animation-delay: -5s;
    }

    .wave:nth-child(3) {
        top: -50%;
        left: -50%;
        transform: rotate(120deg);
        animation-delay: -10s;
    }

    .digital-network {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    .network-node {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(0, 100, 0, 0.3);
        border-radius: 50%;
        animation: nodeFloat 10s infinite ease-in-out;
    }

    .network-line {
        position: absolute;
        height: 1px;
        background: linear-gradient(90deg, 
            transparent,
            rgba(0, 100, 0, 0.2),
            transparent
        );
        animation: lineFlow 8s infinite ease-in-out;
        transform-origin: left center;
    }

    @keyframes waveFlow {
        0% {
            transform: rotate(0deg) translateY(0);
        }
        100% {
            transform: rotate(360deg) translateY(-100px);
        }
    }

    @keyframes nodeFloat {
        0%, 100% {
            transform: translate(0, 0);
        }
        50% {
            transform: translate(20px, -20px);
        }
    }

    @keyframes lineFlow {
        0%, 100% {
            opacity: 0;
            transform: scaleX(0);
        }
        50% {
            opacity: 1;
            transform: scaleX(1);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .value-icon i {
        font-size: 2.5rem;
    }

    .stats-box {
        border-radius: 10px;
        padding: 2rem;
        text-align: center;
        background: white;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--bs-primary);
        margin-bottom: 0.5rem;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="marketing-hero">
    <div class="animated-waves">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <div class="digital-network">
        <div class="network-node" style="top: 20%; left: 20%"></div>
        <div class="network-node" style="top: 60%; left: 40%"></div>
        <div class="network-node" style="top: 40%; left: 60%"></div>
        <div class="network-node" style="top: 80%; left: 80%"></div>
        <div class="network-line" style="top: 20%; left: 20%; width: 100px; transform: rotate(45deg)"></div>
        <div class="network-line" style="top: 60%; left: 40%; width: 150px; transform: rotate(-30deg)"></div>
        <div class="network-line" style="top: 40%; left: 60%; width: 120px; transform: rotate(15deg)"></div>
    </div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="hero-content">
                    <h1 class="display-4 fw-bold mb-4">Digital Marketing Excellence</h1>
                    <p class="lead mb-4">Drive growth and engagement with data-driven digital marketing strategies</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<section class="services py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Marketing Services</h2>
                <p class="lead text-muted mb-5">Comprehensive digital marketing solutions to boost your online presence</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-search"></i>
                        </div>
                        <h3 class="h4 mb-3">SEO Optimization</h3>
                        <p class="text-muted">Improve your search rankings and drive organic traffic through strategic SEO.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h3 class="h4 mb-3">Social Media</h3>
                        <p class="text-muted">Build strong social presence and engage with your audience effectively.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h3 class="h4 mb-3">Email Marketing</h3>
                        <p class="text-muted">Create targeted email campaigns that convert and retain customers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stats-box">
                    <div class="stats-number">95%</div>
                    <p class="text-muted mb-0">Client Satisfaction</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-box">
                    <div class="stats-number">500+</div>
                    <p class="text-muted mb-0">Campaigns Launched</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-box">
                    <div class="stats-number">200%</div>
                    <p class="text-muted mb-0">Average ROI</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-box">
                    <div class="stats-number">24/7</div>
                    <p class="text-muted mb-0">Support Available</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process py-5">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Our Marketing Process</h2>
                <p class="lead text-muted">A data-driven approach to digital success</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-clipboard-data text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Research</h3>
                    <p class="text-muted">Market analysis and competitor research</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-bullseye text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Strategy</h3>
                    <p class="text-muted">Custom marketing plan development</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-rocket text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Execute</h3>
                    <p class="text-muted">Campaign implementation and monitoring</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-graph-up-arrow text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Optimize</h3>
                    <p class="text-muted">Performance analysis and improvements</p>
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
                <h2 class="h1 mb-4">Ready to Grow Your Digital Presence?</h2>
                <p class="lead mb-4">Let's create a winning digital marketing strategy for your business.</p>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add dynamic network connections
    const digitalNetwork = document.querySelector('.digital-network');
    
    function createConnection(x1, y1, x2, y2) {
        const length = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
        const angle = Math.atan2(y2 - y1, x2 - x1) * 180 / Math.PI;
        
        const line = document.createElement('div');
        line.className = 'network-line';
        line.style.width = length + 'px';
        line.style.left = x1 + 'px';
        line.style.top = y1 + 'px';
        line.style.transform = `rotate(${angle}deg)`;
        
        digitalNetwork.appendChild(line);
    }

    // Create additional dynamic connections
    const nodes = document.querySelectorAll('.network-node');
    nodes.forEach((node, i) => {
        if (i < nodes.length - 1) {
            const rect1 = node.getBoundingClientRect();
            const rect2 = nodes[i + 1].getBoundingClientRect();
            createConnection(
                rect1.left - digitalNetwork.getBoundingClientRect().left,
                rect1.top - digitalNetwork.getBoundingClientRect().top,
                rect2.left - digitalNetwork.getBoundingClientRect().left,
                rect2.top - digitalNetwork.getBoundingClientRect().top
            );
        }
    });
});
</script>
@endpush