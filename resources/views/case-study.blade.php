@extends('layouts.app')

@section('title', $caseStudy['title'] . ' — Case Study | Waveron Technologies')
@section('meta_description', 'Case study of ' . $caseStudy['title'] . ': ' . $caseStudy['subtitle'] . '. Learn about the operational challenges, Waveron\'s solution, and measurable results.')
@section('og_title', $caseStudy['title'] . ' — Case Study | Waveron Technologies')
@section('og_description', $caseStudy['subtitle'] . '. Discover how Waveron Technologies solved ' . strtolower($caseStudy['category']) . ' challenges with measurable, high-impact results.')
@section('og_url', 'https://waverontechnologies.co.ke/portfolio')
@section('og_type', 'article')

@section('content')
<!-- Case Study Hero Section -->
<div class="case-study-hero py-5 text-white">
    <div class="container position-relative py-4">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portfolio') }}" class="text-white-50 text-decoration-none">Portfolio</a></li>
                <li class="breadcrumb-item active text-white" aria-current="page">{{ $caseStudy['title'] }}</li>
            </ol>
        </nav>
        
        <div class="row align-items-center">
            <!-- Left Side Details -->
            <div class="col-lg-7 mb-4 mb-lg-0">
                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 mb-3 px-3 py-2 font-monospace" style="font-size: 0.8rem; letter-spacing: 1px;">
                    {{ $caseStudy['category'] }}
                </span>
                <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', Georgia, serif;">{{ $caseStudy['title'] }}</h1>
                <p class="lead mb-4 text-white-50">{{ $caseStudy['subtitle'] }}</p>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($caseStudy['badges'] as $badge)
                        <span class="badge-tag">{{ $badge }}</span>
                    @endforeach
                </div>
            </div>
            
            <!-- Right Side Cover Mockup (Banner Mode) -->
            <div class="col-lg-5">
                <div class="jwg-image-block {{ $caseStudy['visual_class'] }} rounded-4 p-4 shadow-lg position-relative overflow-hidden" style="min-height: 220px; border: 1px solid rgba(255, 255, 255, 0.1);">
                    {!! $caseStudy['visual_html'] !!}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <!-- Left Column: The Problem & The Solution -->
        <div class="col-lg-8">
            <!-- Problem Section -->
            <div class="card border-0 bg-light rounded-4 p-4 p-md-5 mb-5 shadow-sm">
                <h3 class="fw-bold mb-4 d-flex align-items-center text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-3"></i> The Challenge (Problem)
                </h3>
                <p class="lead-text mb-0">{{ $caseStudy['problem'] }}</p>
            </div>

            <!-- Solution Section -->
            <div class="card border-0 bg-light rounded-4 p-4 p-md-5 mb-0 shadow-sm">
                <h3 class="fw-bold mb-4 d-flex align-items-center text-primary">
                    <i class="bi bi-cpu-fill me-3"></i> Waveron's Approach (Solution)
                </h3>
                <p class="lead-text mb-0">{{ $caseStudy['solution'] }}</p>
            </div>
        </div>

        <!-- Right Column: Results Sidebar & CTA -->
        <div class="col-lg-4">
            <!-- Outcomes/Metrics Box -->
            <div class="card border-0 bg-light rounded-4 p-4 mb-4 shadow-sm border-start border-success border-5">
                <h4 class="fw-bold mb-4 text-success d-flex align-items-center">
                    <i class="bi bi-bar-chart-fill me-2"></i> Measurable Results
                </h4>
                
                @foreach($caseStudy['metrics'] as $metric)
                    <div class="metric-item py-3">
                        <div class="metric-value fw-bold mb-1">{{ $metric['value'] }}</div>
                        <div class="metric-label text-muted small">{{ $metric['label'] }}</div>
                    </div>
                    @if(!$loop->last)
                        <hr class="my-2 opacity-10">
                    @endif
                @endforeach

                <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex align-items-center gap-2">
                    <i class="bi bi-shield-check text-success fs-5"></i>
                    <span class="text-success fw-semibold small">Fully verified & live</span>
                </div>
            </div>

            <!-- Context CTA Box -->
            <div class="card border-0 text-white rounded-4 p-4 shadow-lg position-relative overflow-hidden bg-dark">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-gradient opacity-10" style="background: linear-gradient(135deg, var(--waveron-green), transparent);"></div>
                <div class="position-relative z-index-1">
                    <h4 class="fw-bold mb-3" style="font-family: 'Playfair Display', Georgia, serif;">Build a similar solution</h4>
                    <p class="small text-white-50 mb-4">Are you facing synchronization issues, operational bottlenecks, or security overheads? Our engineers can design and develop high-performance software customized for your enterprise needs.</p>
                    <a href="{{ route('contact') }}" class="btn btn-success w-100 rounded-pill py-3 fw-bold shadow-sm hover-up">
                        Discuss Your Project <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            
            <!-- Back to Portfolio -->
            <div class="text-center mt-4">
                <a href="{{ route('portfolio') }}" class="btn btn-link text-decoration-none text-muted font-monospace small">
                    <i class="bi bi-arrow-left me-1"></i> Back to Portfolio
                </a>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
@endsection

@push('styles')
<style>
    body {
        background-color: #ffffff;
    }

    /* Hero Styling */
    .case-study-hero {
        background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        position: relative;
    }

    /* Breadcrumbs */
    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255, 255, 255, 0.3) !important;
    }

    /* Badges */
    .badge-tag {
        background-color: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-family: 'Inter', sans-serif;
    }

    /* Lead & Content Typography */
    .lead-text {
        font-size: 1.05rem;
        line-height: 1.7;
        color: #4b5563;
    }

    /* Metrics Styles */
    .metric-value {
        font-family: 'Inter', sans-serif;
        color: var(--waveron-green) !important;
        font-size: 2.2rem;
        letter-spacing: -1px;
    }

    .metric-label {
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.75rem;
    }

    /* Mockup/Visual blocks */
    .jwg-image-block {
        min-height: 220px;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .dark-block {
        background-color: #111827;
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .light-block {
        background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        border: 1px solid #e5e7eb;
        color: #1f2937;
    }

    /* Interactive visuals elements styles and animations */
    .jwg-chart {
        display: flex;
        gap: 4px;
        align-items: flex-end;
    }
    
    /* Animation Keyframes */
    @keyframes pulseChart {
        0%, 100% { transform: scaleY(0.7); }
        50% { transform: scaleY(1.3); }
    }
    @keyframes pulseAudio {
        0%, 100% { transform: scaleY(0.4); }
        50% { transform: scaleY(1.3); }
    }
    @keyframes pulseDot {
        0%, 100% { opacity: 0.5; transform: scale(0.85); box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        50% { opacity: 1; transform: scale(1.15); box-shadow: 0 0 8px 3px rgba(40, 167, 69, 0.5); }
    }
    @keyframes pulseSparkline {
        0%, 100% { transform: scaleY(0.6); }
        50% { transform: scaleY(1.2); }
    }
    @keyframes threatPulse {
        0%, 100% { opacity: 0.85; }
        50% { opacity: 0.45; }
    }

    /* Assign Animations */
    .jwg-chart .bar {
        animation: pulseChart 1.5s ease-in-out infinite alternate;
        transform-origin: bottom;
    }
    .jwg-chart .bar:nth-child(2) { animation-delay: 0.3s; }
    .jwg-chart .bar:nth-child(3) { animation-delay: 0.6s; }
    .jwg-chart .bar:nth-child(4) { animation-delay: 0.9s; }

    .audio-waves .wave {
        animation: pulseAudio 1.2s ease-in-out infinite alternate;
        transform-origin: center;
    }
    .audio-waves .wave:nth-child(2) { animation-delay: 0.25s; }
    .audio-waves .wave:nth-child(3) { animation-delay: 0.5s; }
    .audio-waves .wave:nth-child(4) { animation-delay: 0.15s; }
    .audio-waves .wave:nth-child(5) { animation-delay: 0.35s; }

    .pulse-dot {
        animation: pulseDot 2s infinite ease-in-out;
        display: inline-block;
    }

    .sparkline > div {
        animation: pulseSparkline 1.2s ease-in-out infinite alternate;
        transform-origin: bottom;
    }
    .sparkline > div:nth-child(2) { animation-delay: 0.2s; }
    .sparkline > div:nth-child(3) { animation-delay: 0.4s; }
    .sparkline > div:nth-child(4) { animation-delay: 0.6s; }

    .threat-pulse {
        animation: threatPulse 1.2s infinite ease-in-out;
    }

    .hover-up {
        transition: all 0.3s ease;
    }
    .hover-up:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(32, 201, 151, 0.3) !important;
    }
</style>
@endpush
