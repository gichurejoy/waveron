@extends('layouts.app')

@section('title', 'Branding - Waveron Technologies')

@push('styles')
<style>
    .branding-hero {
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
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, rgba(0, 100, 0, 0.1) 0%, transparent 50%);
        transform-origin: center;
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
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
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="branding-hero">
    <div class="animated-background"></div>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Strategic Brand Development</h1>
                <p class="lead mb-4">Transform your business identity into a powerful brand story that resonates with your audience.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">Get Started</a>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<section class="services py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Branding Services</h2>
                <p class="lead text-muted mb-5">Comprehensive branding solutions to establish your unique identity</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-palette"></i>
                        </div>
                        <h3 class="h4 mb-3">Brand Identity</h3>
                        <p class="text-muted">Create a distinct visual identity that reflects your brand's values and personality.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <h3 class="h4 mb-3">Brand Strategy</h3>
                        <p class="text-muted">Develop comprehensive strategies to position your brand effectively in the market.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <h3 class="h4 mb-3">Brand Guidelines</h3>
                        <p class="text-muted">Create detailed guidelines to maintain brand consistency across all platforms.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="h1 fw-bold mb-4">Our Branding Process</h2>
                <p class="lead text-muted">A strategic approach to building powerful brands</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-search text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Discovery</h3>
                    <p class="text-muted">Understanding your vision, values, and market position</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-gear text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Strategy</h3>
                    <p class="text-muted">Developing a comprehensive brand strategy</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-brush text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Design</h3>
                    <p class="text-muted">Creating visual elements that tell your story</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="value-icon mb-3">
                        <i class="bi bi-rocket text-primary"></i>
                    </div>
                    <h3 class="h5 mb-3">Implementation</h3>
                    <p class="text-muted">Launching and maintaining your brand identity</p>
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
                <h2 class="h1 mb-4">Ready to Build Your Brand?</h2>
                <p class="lead mb-4">Let's create a brand that makes a lasting impression.</p>
                <a href="{{ route('contact') }}" class="btn btn-light btn-lg px-5">Get in Touch</a>
            </div>
        </div>
    </div>
</section>
@endsection