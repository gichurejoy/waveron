@extends('layouts.app')

@section('title', isset($service) ? $service->title . ' - Waveron Technologies' : 'Service Details - Waveron Technologies')
@section('meta_description', isset($service) ? $service->description : 'Premium professional services from Waveron Technologies, Nairobi, Kenya.')

@section('content')
<div class="service-hero position-relative overflow-hidden bg-light py-5">
    <div class="shape-blob" style="position: absolute; top: -50px; left: -50px; width: 300px; height: 300px; background: rgba(0, 100, 0, 0.05); border-radius: 50%; filter: blur(50px);"></div>
    <div class="shape-blob2" style="position: absolute; bottom: -50px; right: -50px; width: 300px; height: 300px; background: rgba(0, 100, 0, 0.05); border-radius: 50%; filter: blur(50px);"></div>
    
    <div class="container py-5">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-7">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('services') }}" class="text-muted text-decoration-none">Services</a></li>
                        <li class="breadcrumb-item active text-success fw-bold" aria-current="page">{{ $service->title ?? 'Service Detail' }}</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="bg-success bg-opacity-10 text-success p-3 rounded-circle" style="font-size: 2rem; line-height: 1;">
                        <i class="bi {{ $service->icon ?? 'bi-cpu' }}"></i>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-semibold">Premium Service Class</span>
                </div>
                <h1 class="display-4 fw-bold mb-4 text-dark">{{ $service->title ?? 'Professional Service' }}</h1>
                <p class="lead text-muted mb-4">{{ $service->description ?? 'We provide elite-tier technical and creative solutions designed to scale your operations, elevate your brand, and maximize market efficiency.' }}</p>
                <div class="d-flex flex-column flex-sm-row gap-3">
                    <a href="{{ route('contact') }}" class="btn btn-success btn-lg rounded-pill px-4">
                        <i class="bi bi-calendar-event me-2"></i>Book Free Consultation
                    </a>
                    <a href="{{ route('quote') }}" class="btn btn-outline-dark btn-lg rounded-pill px-4">
                        <i class="bi bi-calculator me-2"></i>Calculate Cost Estimate
                    </a>
                </div>
            </div>
            <div class="col-lg-5 mt-5 mt-lg-0">
                <div class="card border-0 shadow-sm p-4 bg-white rounded-4 border-start border-success border-4">
                    <h5 class="fw-bold mb-3 text-dark">Why Choose Waveron?</h5>
                    <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
                        <li class="d-flex gap-2">
                            <i class="bi bi-shield-check text-success fs-5"></i>
                            <div>
                                <strong class="text-dark d-block">Senior-Only Talent</strong>
                                <span class="text-muted small">Experienced professionals dedicated to your product execution.</span>
                            </div>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-activity text-success fs-5"></i>
                            <div>
                                <strong class="text-dark d-block">Agile Delivery Cycles</strong>
                                <span class="text-muted small">Continuous integration, weekly demos, and transparent roadmaps.</span>
                            </div>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-headset text-success fs-5"></i>
                            <div>
                                <strong class="text-dark d-block">Comprehensive SLA Guarantees</strong>
                                <span class="text-muted small">Guaranteed support response, post-launch scaling, and training.</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Service Details & Features Grid -->
    <div class="row g-5">
        <div class="col-lg-8">
            <h3 class="fw-bold text-dark mb-4">Core Feature Coverage</h3>
            <p class="text-muted mb-4">Our delivery maps directly to your target objectives. Each engagement includes full integration verification, source repositories transfer, and administrative training sessions.</p>
            
            <div class="row g-4">
                @if(isset($service->features) && count($service->features) > 0)
                    @foreach($service->features as $feature)
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100 p-4 bg-light rounded-3">
                                <h5 class="fw-bold text-dark mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>{{ $feature['title'] ?? $feature }}
                                </h5>
                                <p class="text-muted small mb-0">{{ $feature['description'] ?? 'High-performance standard execution mapped to client requirements.' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback default features -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 p-4 bg-light rounded-3">
                            <h5 class="fw-bold text-dark mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Customized Architecture</h5>
                            <p class="text-muted small mb-0">Engineered to scale, ensuring system parameters adjust to concurrent traffic volume without page lag.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 p-4 bg-light rounded-3">
                            <h5 class="fw-bold text-dark mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Secure Deployments</h5>
                            <p class="text-muted small mb-0">Impenetrable host servers setup with active patches, custom SSL routing, and security headers validation.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 p-4 bg-light rounded-3">
                            <h5 class="fw-bold text-dark mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Interactive Prototype</h5>
                            <p class="text-muted small mb-0">Figma screen layout flows providing clean visual paths before developers begin coding tasks.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 p-4 bg-light rounded-3">
                            <h5 class="fw-bold text-dark mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Analytics Tracking</h5>
                            <p class="text-muted small mb-0">Conversion funnel configurations keeping trace of user behavior tags to optimize overall performance.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Tech Stack Showcase -->
            @if(isset($service->tech_stack) && count($service->tech_stack) > 0)
                <div class="mt-5 pt-4">
                    <h4 class="fw-bold text-dark mb-3">Technology Stack & Frameworks</h4>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($service->tech_stack as $tech)
                            <span class="badge bg-secondary rounded-pill px-3 py-2 fw-semibold" style="font-size: 0.85rem; letter-spacing: 0.3px;">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Sidebar Cost Calculator Callout -->
            <div class="card border-0 bg-dark text-white rounded-4 p-4 p-lg-5 shadow-sm sticky-top" style="top: 100px; z-index: 1;">
                <span class="badge bg-success bg-opacity-20 text-success rounded-pill px-3 py-2 mb-3 align-self-start fw-semibold">Interactive Calculator</span>
                <h4 class="fw-bold mb-3 text-white">Estimate Project Cost</h4>
                <p class="text-white-50 small mb-4">Use our instant service configuration quote calculator to estimate base costs, select optional add-ons, and download a custom PDF guide.</p>
                <div class="d-grid gap-3">
                    <a href="{{ route('quote') }}" class="btn btn-success rounded-pill py-2.5 fw-bold">
                        <i class="bi bi-calculator me-2"></i>Start Calculating
                    </a>
                    <a href="{{ route('quote.guide') }}" class="btn btn-outline-light rounded-pill py-2.5">
                        <i class="bi bi-book me-2"></i>View Pricing Guide
                    </a>
                </div>
                <hr class="border-secondary my-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-secondary bg-opacity-25 rounded-circle p-2.5">
                        <i class="bi bi-telephone text-success fs-5"></i>
                    </div>
                    <div>
                        <span class="text-white-50 d-block small">Need custom pricing?</span>
                        <a href="{{ route('contact') }}" class="text-success fw-bold text-decoration-none small">Schedule a callback</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
