@extends('layouts.app')

@section('title', 'Free Business & Developer Utilities | Waveron Technologies')
@section('meta_description', 'Explore Waveron Technologies\' free online utility tools. Create invoices, calculate Kenyan PAYE salary tax, and more to simplify your operations.')

@section('content')
<!-- Tools Hero Section -->
<div class="tools-hero py-5 text-white position-relative">
    <!-- Animated Business Abstract Overlay on the Right -->
    <div class="position-absolute end-0 top-0 bottom-0 d-none d-md-flex align-items-center pe-5" style="pointer-events: none; width: 450px; height: 100%; z-index: 1; opacity: 0.35;">
        <svg viewBox="0 0 200 100" class="w-100 h-100" fill="none">
            <!-- Subtly Animated Rising Trend Line -->
            <path d="M20,80 C60,85 80,40 120,45 C150,48 160,20 180,15" class="trend-line-anim" stroke="var(--waveron-green)" stroke-width="1.5" stroke-linecap="round" />
            
            <!-- Glowing Data Points (Pulsing nodes on the chart) -->
            <circle cx="20" cy="80" r="2" fill="var(--waveron-green)" class="node-pulse" style="animation-delay: 0s;" />
            <circle cx="120" cy="45" r="2.5" fill="var(--waveron-green)" class="node-pulse" style="animation-delay: 1s;" />
            <circle cx="180" cy="15" r="3" fill="#22c55e" class="node-pulse" style="animation-delay: 2s;" />
            
            <!-- Connected Network Nodes (Business network abstraction) -->
            <g stroke="rgba(255,255,255,0.12)" stroke-width="0.5">
                <!-- Node links -->
                <line x1="40" y1="30" x2="80" y2="60" />
                <line x1="80" y1="60" x2="150" y2="70" />
                <line x1="150" y1="70" x2="160" y2="35" />
                <line x1="40" y1="30" x2="120" y2="25" />
                <line x1="120" y1="25" x2="160" y2="35" />
            </g>
            
            <!-- Network Circles -->
            <circle cx="40" cy="30" r="1.5" fill="rgba(255,255,255,0.25)" />
            <circle cx="80" cy="60" r="1.5" fill="rgba(255,255,255,0.25)" />
            <circle cx="150" cy="70" r="1.5" fill="rgba(255,255,255,0.25)" />
            <circle cx="160" cy="35" r="1.5" fill="rgba(255,255,255,0.25)" />
            <circle cx="120" cy="25" r="1.5" fill="rgba(255,255,255,0.25)" />

            <!-- Floating Data Bars at the bottom (Subtle financial charts) -->
            <g fill="rgba(0,100,0,0.15)">
                <rect x="35" y="85" width="6" height="15" class="bar-grow-anim" style="animation-delay: 0.1s;" />
                <rect x="55" y="75" width="6" height="25" class="bar-grow-anim" style="animation-delay: 0.3s;" />
                <rect x="75" y="80" width="6" height="20" class="bar-grow-anim" style="animation-delay: 0.5s;" />
                <rect x="95" y="65" width="6" height="35" class="bar-grow-anim" style="animation-delay: 0.2s;" />
                <rect x="115" y="70" width="6" height="30" class="bar-grow-anim" style="animation-delay: 0.4s;" />
                <rect x="135" y="55" width="6" height="45" class="bar-grow-anim" style="animation-delay: 0.7s;" />
                <rect x="155" y="60" width="6" height="40" class="bar-grow-anim" style="animation-delay: 0.6s;" />
            </g>
        </svg>
    </div>
    
    <div class="container position-relative py-5 text-center" style="z-index: 2;">
        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 mb-3 px-3 py-2 font-monospace" style="font-size: 0.8rem; letter-spacing: 1px;">
            ENGINEERING AS MARKETING
        </span>
        <h1 class="display-4 fw-bold mb-3" style="font-family: 'Playfair Display', Georgia, serif;">Free Business & Developer Utilities</h1>
        <p class="lead max-w-2xl mx-auto text-white-50">High-performance, localized toolkits designed to automate calculations, simplify paperwork, and boost daily productivity.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4 justify-content-center">
        <!-- Tool 1: Invoice & Quotation Generator -->
        <div class="col-md-6 col-lg-5">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tool-card">
                <div class="p-4 bg-light border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="tool-icon bg-success bg-opacity-10 text-success rounded-3 p-3">
                            <i class="bi bi-file-earmark-spreadsheet fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Invoice Generator</h4>
                            <small class="text-muted">Business Invoicing</small>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size:0.7rem;">FREE</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <p class="text-muted">Create clean, professional PDF invoices and quotations in seconds. Features dynamic row addition, tax settings, client info caching, and custom colors.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Custom Currency & Tax settings</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Live printable preview layout</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Client details storage</li>
                    </ul>
                    <a href="{{ route('tools.invoice-generator') }}" class="btn btn-success w-100 rounded-pill py-2 fw-semibold">
                        Launch Invoice Tool <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tool 2: Kenyan PAYE & Salary Calculator -->
        <div class="col-md-6 col-lg-5">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tool-card">
                <div class="p-4 bg-light border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="tool-icon bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                            <i class="bi bi-calculator fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">PAYE Calculator</h4>
                            <small class="text-muted">Kenyan Tax Compliance</small>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size:0.7rem;">UPDATED</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <p class="text-muted">Calculate salary deductions and net pay using current KRA tax rates. Computes exact PAYE tax bands, NSSF contributions, and SHIF health insurance rules.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Updated SHIF / NSSF deductions</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Gross-to-Net detailed breakdown</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Printable Payslip generation</li>
                    </ul>
                    <a href="{{ route('tools.salary-calculator') }}" class="btn btn-primary w-100 rounded-pill py-2 fw-semibold">
                        Launch Calculator <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tool 3: Professional CV Builder -->
        <div class="col-md-6 col-lg-5">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tool-card">
                <div class="p-4 bg-light border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="tool-icon bg-info bg-opacity-10 text-info rounded-3 p-3">
                            <i class="bi bi-file-earmark-person fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">CV Builder</h4>
                            <small class="text-muted">Career Growth</small>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size:0.7rem;">NEW</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <p class="text-muted">Build a modern, job-winning professional CV. Custom colors, dynamic experience and education fields, profile picture support, and instant print layout sizing.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Dynamic Work & Study list fields</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Photo upload & Accent colors</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Standard A4 bottom watermark printing</li>
                    </ul>
                    <a href="{{ route('tools.cv-builder') }}" class="btn btn-info w-100 rounded-pill py-2 fw-semibold text-white">
                        Launch CV Builder <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tool 4: Cover Letter Generator -->
        <div class="col-md-6 col-lg-5">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tool-card">
                <div class="p-4 bg-light border-bottom d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="tool-icon bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                            <i class="bi bi-envelope-paper fs-3"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Cover Letter Gen</h4>
                            <small class="text-muted">Job Applications</small>
                        </div>
                    </div>
                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1" style="font-size:0.7rem;">NEW</span>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <p class="text-muted">Instantly draft highly personalized cover letters. Choose from professional, enthusiastic, or creative templates and edit body text in real-time before export.</p>
                    <ul class="list-unstyled mb-4">
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Tone presets (Professional, Creative)</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Custom letterhead styles</li>
                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Live A4-scaled print formatting</li>
                    </ul>
                    <a href="{{ route('tools.cover-letter-generator') }}" class="btn btn-warning w-100 rounded-pill py-2 fw-semibold text-white">
                        Launch Generator <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')
@endsection

@push('styles')
<style>
    body {
        background-color: #fafafa;
    }

    /* Hero Styling */
    .tools-hero {
        background: linear-gradient(135deg, #0b0f19 0%, #111827 100%);
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        overflow: hidden;
    }

    .tools-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 24px 24px;
        background-position: center;
        mask-image: radial-gradient(circle, black 30%, transparent 85%);
        -webkit-mask-image: radial-gradient(circle, black 30%, transparent 85%);
        pointer-events: none;
    }

    .tools-hero::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 10px;
        background-image: 
            repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.15) 0px, rgba(255, 255, 255, 0.15) 1px, transparent 1px, transparent 8px),
            repeating-linear-gradient(90deg, rgba(255, 255, 255, 0.25) 0px, rgba(255, 255, 255, 0.25) 1.5px, transparent 1.5px, transparent 40px);
        pointer-events: none;
    }

    /* Motion Business Abstract Animations */
    @keyframes lineFlow {
        0% { stroke-dashoffset: 24; }
        100% { stroke-dashoffset: 0; }
    }
    .trend-line-anim {
        stroke-dasharray: 8, 4;
        animation: lineFlow 1.5s linear infinite;
    }

    @keyframes pulseDot {
        0%, 100% { opacity: 0.3; transform: scale(0.9); }
        50% { opacity: 1; transform: scale(1.2); }
    }
    .node-pulse {
        transform-origin: center;
        transform-box: fill-box;
        animation: pulseDot 2s infinite ease-in-out;
    }

    @keyframes barGrow {
        0%, 100% { transform: scaleY(1); }
        50% { transform: scaleY(0.6); }
    }
    .bar-grow-anim {
        transform-origin: bottom;
        transform-box: fill-box;
        animation: barGrow 3.5s ease-in-out infinite;
    }

    /* Cards */
    .tool-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .tool-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05) !important;
    }

    .tool-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
    }
</style>
@endpush
