@extends('layouts.app')

@section('title', 'Our Services - Waveron Technologies')

@section('content')
<!-- Hero Section -->
<div class="container-fluid bg-primary text-white py-5">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Our Services</h1>
                <p class="lead mb-4">Comprehensive digital solutions to help your business thrive in the modern world.</p>
            </div>
        </div>
    </div>
</div>

<!-- Services Grid -->
<div class="container py-5">
    <div class="row g-4">
        <!-- Software Development -->
        <div class="col-lg-6">
            <div class="service-card h-100 position-relative overflow-hidden">
                <div class="card border-0 h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('images/software-development.svg') }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Software Development">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title h4 text-primary">Software Development</h3>
                                <p class="card-text">Custom software solutions tailored to your business needs. From web applications to enterprise systems.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('services.software') }}" class="btn btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Graphic Design -->
        <div class="col-lg-6">
            <div class="service-card h-100 position-relative overflow-hidden">
                <div class="card border-0 h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('images/graphic-design.svg') }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Graphic Design">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title h4 text-primary">Graphic Design</h3>
                                <p class="card-text">Professional design services that bring your brand to life through stunning visuals and creative concepts.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('services.design') }}" class="btn btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branding -->
        <div class="col-lg-6">
            <div class="service-card h-100 position-relative overflow-hidden">
                <div class="card border-0 h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('images/branding.svg') }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Branding">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title h4 text-primary">Branding</h3>
                                <p class="card-text">Build a strong, memorable brand identity that resonates with your target audience and stands out in the market.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('services.branding') }}" class="btn btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Digital Marketing -->
        <div class="col-lg-6">
            <div class="service-card h-100 position-relative overflow-hidden">
                <div class="card border-0 h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('images/digital-marketing.svg') }}" class="img-fluid rounded-start h-100 object-fit-cover" alt="Digital Marketing">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body d-flex flex-column h-100">
                                <h3 class="card-title h4 text-primary">Digital Marketing</h3>
                                <p class="card-text">Strategic digital marketing solutions to increase your online presence and drive business growth.</p>
                                <div class="mt-auto">
                                    <a href="{{ route('services.marketing') }}" class="btn btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us -->
<div class="container-fluid bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-4">Why Choose Waveron Technologies?</h2>
                <p class="lead mb-5">We combine expertise, innovation, and dedication to deliver exceptional results for our clients.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center">
                    <div class="text-primary mb-3">
                        <i class="bi bi-people-fill fs-1"></i>
                    </div>
                    <h3 class="h5">Expert Team</h3>
                    <p>Our skilled professionals bring years of experience and expertise to every project.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <div class="text-primary mb-3">
                        <i class="bi bi-gear-fill fs-1"></i>
                    </div>
                    <h3 class="h5">Custom Solutions</h3>
                    <p>Tailored solutions designed to meet your specific business requirements and goals.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <div class="text-primary mb-3">
                        <i class="bi bi-graph-up-arrow fs-1"></i>
                    </div>
                    <h3 class="h5">Proven Results</h3>
                    <p>Track record of delivering successful projects and driving business growth.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
            <h2 class="mb-4">Ready to Get Started?</h2>
            <p class="lead mb-4">Contact us today to discuss your project and discover how we can help your business succeed.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Contact Us</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .service-card {
        transition: transform 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-5px);
    }

    .service-card .card {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.08);
    }

    .object-fit-cover {
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        .service-card .row {
            flex-direction: column;
        }

        .service-card .col-md-6:first-child {
            height: 200px;
        }
    }
</style>
@endpush
