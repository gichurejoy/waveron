@extends('layouts.app')

@section('title', 'Portfolio - Waveron Technologies')

@section('content')
<!-- Abstract Hero Section -->
<div class="portfolio-hero py-5">
    <canvas id="portfolio-canvas" class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 1; pointer-events: none; opacity: 0.6;"></canvas>
    <div class="container position-relative">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4" style="color: var(--waveron-green);">Our Portfolio</h1>
                <p class="lead mb-4">Discover the digital innovations and proprietary products we've built to transform workflows and accelerate growth.</p>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <!-- Case Studies Row -->
    <div class="row g-5">
        <!-- Item 1: Order Matching Engine (SaaS/CRM Equivalent) -->
        <div class="col-md-6 col-lg-4">
            <div class="jwg-image-block dark-block mb-4">
                <div class="jwg-code-header d-flex justify-content-between flex-wrap gap-1">
                    <span class="text-muted small font-monospace">MATCHING_ENGINE_V2.LOG</span>
                    <span class="jwg-green font-monospace small">LIVE: PROCESSING</span>
                </div>
                <div class="jwg-code-body font-monospace mt-3">
                    <div class="text-success opacity-75">> Initializing matching protocol...</div>
                    <div class="text-success opacity-75">> Sorting bids [Price-Time Priority]</div>
                    <div class="jwg-chart mt-3">
                        <div class="bar" style="height: 30px;"></div>
                        <div class="bar" style="height: 50px;"></div>
                        <div class="bar" style="height: 20px;"></div>
                        <div class="bar" style="height: 40px;"></div>
                    </div>
                    <div class="text-white mt-3 fw-bold">> Throughput: 10,000 matches/sec</div>
                    <div class="progress mt-2 bg-dark" style="height: 4px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 100%;"></div>
                    </div>
                </div>
            </div>
            
            <div class="jwg-category mb-2">&bull; PROPRIETARY SAAS</div>
            <h2 class="jwg-title mb-3">Waveron CRM</h2>
            <p class="jwg-desc">Our powerful, custom-built Customer Relationship Management tool designed for dynamic sales teams. Built a production-grade pipeline engine optimized for low-latency update execution and real-time synchronization.</p>
            
            <div class="jwg-badges mt-4">
                <span>REACT</span>
                <span>PYTHON</span>
                <span>DOCKER</span>
                <span>POSTGRESQL</span>
            </div>
            <div class="mt-4">
                <a href="{{ route('portfolio.case-study', 'waveron-crm') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-semibold view-case-study-btn">
                    <i class="bi bi-journal-text me-1"></i> View Case Study
                </a>
            </div>
        </div>

        <!-- Item 2: Pharma Automation (Brand Book Equivalent) -->
        <div class="col-md-6 col-lg-4">
            <div class="jwg-image-block light-block mb-4 d-flex flex-column align-items-center justify-content-center position-relative">
                <div class="mic-circle shadow-sm mb-3 animate-pulse">
                    <i class="bi bi-mic-fill text-success fs-3"></i>
                </div>
                <div class="audio-waves mb-4">
                    <div class="wave" style="height:10px"></div>
                    <div class="wave" style="height:20px"></div>
                    <div class="wave" style="height:35px"></div>
                    <div class="wave" style="height:20px"></div>
                    <div class="wave" style="height:10px"></div>
                </div>
                <!-- Pill at bottom -->
                <div class="automation-pill">
                    <span class="jwg-green">&bull;</span> AUTOMATION ACTIVE
                </div>
            </div>

            <div class="jwg-category mb-2">&bull; AI AUTOMATION</div>
            <h2 class="jwg-title mb-3">Brand Book Generator</h2>
            <p class="jwg-desc">Automated comprehensive brand guidelines, color palettes, and typography. Transformed an 8-hour manual design process into a 30-minute automated execution cycle.</p>
            
            <!-- Result Block -->
            <div class="jwg-result-block mt-4 mb-4">
                <div class="result-label">RESULT</div>
                <div class="result-text">Reduced operational overhead by 85%.</div>
            </div>
            <div class="mt-3">
                <a href="{{ route('portfolio.case-study', 'brand-book-generator') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-semibold view-case-study-btn">
                    <i class="bi bi-journal-text me-1"></i> View Case Study
                </a>
            </div>
        </div>

        <!-- Item 3: Contract Dashboard (Scholar Matcher Equivalent) -->
        <div class="col-md-6 col-lg-4">
            <div class="jwg-image-block dark-block mb-4 p-0 overflow-hidden">
                <div class="d-flex">
                    <div class="w-50 p-4 border-end border-secondary border-opacity-25">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <i class="bi bi-shield-check text-success fs-4"></i>
                            <div class="rounded-circle bg-success pulse-dot" style="width:8px; height:8px;"></div>
                        </div>
                        <div class="text-white-50 small mb-1" style="font-size:0.6rem; letter-spacing:1px;">SYSTEM HEALTH</div>
                        <h3 class="text-white m-0">100.0%</h3>
                    </div>
                    <div class="w-50 p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <i class="bi bi-download text-white-50 fs-4"></i>
                            <span class="badge border border-success text-success bg-transparent" style="font-size:0.5rem">AUTO</span>
                        </div>
                        <div class="text-white-50 small mb-1" style="font-size:0.6rem; letter-spacing:1px;">REPORTS GEN</div>
                        <h3 class="text-white m-0">REALTIME</h3>
                    </div>
                </div>
                <div class="p-3 bg-black bg-opacity-50 mx-3 mb-3 rounded-3 font-monospace" style="font-size:0.65rem;">
                    <div class="text-white opacity-50">09:42:01 <span class="text-success">Pull_New_Invoices() - Success</span></div>
                    <div class="text-white opacity-50">09:42:05 <span class="text-white">Sync_Airtable_Database()</span></div>
                    <div class="text-white opacity-50">09:42:08 <span class="text-success">Trigger_Client_Notification()</span></div>
                </div>
            </div>

            <div class="jwg-category mb-2">&bull; ENTERPRISE DASHBOARD</div>
            <h2 class="jwg-title mb-3">Career Matcher</h2>
            <p class="jwg-desc">Centralized enterprise management portal with automated reporting and real-time data synchronization. Features complex algorithm workflows and talent matching engines.</p>
            
            <div class="jwg-badges mt-4">
                <span>PYTHON</span>
                <span>MYSQL</span>
            </div>
            <div class="mt-4">
                <a href="{{ route('portfolio.case-study', 'career-matcher') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-semibold view-case-study-btn">
                    <i class="bi bi-journal-text me-1"></i> View Case Study
                </a>
            </div>
        </div>

        <!-- Item 4: Lead Generator -->
        <div class="col-md-6 col-lg-4">
            <div class="jwg-image-block light-block mb-4 p-0 overflow-hidden d-flex flex-column">
                <div class="p-3 border-bottom border-secondary border-opacity-10 d-flex justify-content-between flex-wrap gap-1 align-items-center bg-white">
                    <span class="text-muted small font-monospace"><i class="bi bi-funnel-fill text-success"></i> PIPELINE_ACTIVE</span>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill" style="font-size:0.6rem;">+240 LEADS</span>
                </div>
                <div class="p-3 font-monospace flex-grow-1" style="font-size:0.7rem; background-color: #fafafa;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Targeting:</span> <span class="fw-bold">Enterprise Tech</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Enrichment:</span> <span class="jwg-green">100% Complete</span>
                    </div>
                    <div class="progress mt-3 mb-1" style="height: 6px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" style="width: 85%;"></div>
                    </div>
                    <div class="text-end text-muted" style="font-size:0.6rem;">Conversion Prob: 85%</div>
                </div>
            </div>

            <div class="jwg-category mb-2">&bull; SALES INTELLIGENCE</div>
            <h2 class="jwg-title mb-3">Lead Generator</h2>
            <p class="jwg-desc">Automated prospect identification and enrichment engine. Scrapes, verifies, and scores leads in real-time to continuously feed high-converting pipelines.</p>
            
            <div class="jwg-badges mt-4">
                <span>PRISMA</span>
                <span>BULLMQ</span>
                <span>PYTHON</span>
            </div>
            <div class="mt-4">
                <a href="{{ route('portfolio.case-study', 'lead-generator') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-semibold view-case-study-btn">
                    <i class="bi bi-journal-text me-1"></i> View Case Study
                </a>
            </div>
        </div>

        <!-- Item 5: Ecommerce -->
        <div class="col-md-6 col-lg-4">
            <div class="jwg-image-block dark-block mb-4 d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-white-50 font-monospace small">STOREFRONT_API</span>
                    <i class="bi bi-cart-check text-success fs-5"></i>
                </div>
                <div class="text-center mt-2">
                    <div class="text-white-50 small mb-1" style="letter-spacing:1px; font-size:0.65rem;">REVENUE / MIN</div>
                    <h2 class="text-white mb-0 display-6 fw-bold">$4,250<span class="text-success fs-6">.00</span></h2>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-3">
                    <div class="sparkline d-flex align-items-end gap-1" style="height: 30px;">
                        <div class="bg-success opacity-50" style="width: 8px; height: 40%;"></div>
                        <div class="bg-success opacity-50" style="width: 8px; height: 60%;"></div>
                        <div class="bg-success opacity-75" style="width: 8px; height: 80%;"></div>
                        <div class="bg-success" style="width: 8px; height: 100%;"></div>
                    </div>
                    <span class="jwg-green font-monospace small bg-success bg-opacity-10 px-2 py-1 rounded">+12.4%</span>
                </div>
            </div>

            <div class="jwg-category mb-2">&bull; DIGITAL COMMERCE</div>
            <h2 class="jwg-title mb-3">E-Commerce Core</h2>
            <p class="jwg-desc">High-performance e-commerce architecture designed for immense scale. Features sub-second page loads, real-time inventory synchronization, and frictionless checkout flows.</p>
            
            <div class="jwg-badges mt-4">
                <span>NEXTJS</span>
                <span>MPESA</span>
                <span>REDIS</span>
            </div>
            <div class="mt-4">
                <a href="{{ route('portfolio.case-study', 'ecommerce-core') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-semibold view-case-study-btn">
                    <i class="bi bi-journal-text me-1"></i> View Case Study
                </a>
            </div>
        </div>

        <!-- Item 6: Security Agent -->
        <div class="col-md-6 col-lg-4">
            <div class="jwg-image-block dark-block mb-4 p-0 overflow-hidden position-relative">
                <div class="position-absolute w-100 h-100 d-flex align-items-center justify-content-center" style="opacity: 0.1;">
                    <i class="bi bi-shield-lock-fill" style="font-size: 8rem;"></i>
                </div>
                <div class="p-3 h-100 d-flex flex-column justify-content-between position-relative z-index-1">
                    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary border-opacity-50 pb-2">
                        <span class="text-danger font-monospace small"><i class="bi bi-shield-lock-fill"></i> SEC_AGENT_v1</span>
                        <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                            <span class="visually-hidden">Scanning...</span>
                        </div>
                    </div>
                    <div class="font-monospace mt-3" style="font-size:0.65rem;">
                        <div class="text-white-50">> Scanning net_protocols... <span class="text-success">CLEAN</span></div>
                        <div class="text-white-50">> Analyzing payload_sig... <span class="text-success">CLEAN</span></div>
                        <div class="text-white-50">> Checking auth_tokens...</div>
                        <div class="text-danger fw-bold mt-2 bg-danger bg-opacity-10 p-1 rounded border border-danger border-opacity-25 threat-pulse">> THREAT MITIGATED: IP 192.168.*</div>
                    </div>
                </div>
            </div>

            <div class="jwg-category mb-2">&bull; CYBERSECURITY</div>
            <h2 class="jwg-title mb-3">Security Agent</h2>
            <p class="jwg-desc">Autonomous threat detection system that continuously monitors enterprise networks, identifies zero-day vulnerabilities, and actively mitigates risks without human intervention.</p>
            
            <div class="jwg-badges mt-4">
                <span>NESTJS</span>
                <span>FASTAPI</span>
            </div>
            <div class="mt-4">
                <a href="{{ route('portfolio.case-study', 'security-agent') }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-semibold view-case-study-btn">
                    <i class="bi bi-journal-text me-1"></i> View Case Study
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

    .portfolio-hero {
        position: relative;
        padding: 8rem 0 4rem;
        overflow: hidden;
        background: rgba(248, 249, 250, 0.97);
    }

    .portfolio-hero .container {
        position: relative;
        z-index: 2;
    }

    /* Common Tokens */
    :root {
        --jwg-green: #20c997;
        --jwg-dark: #121212;
        --jwg-text: #4b5563;
    }

    .jwg-green {
        color: var(--jwg-green);
    }

    .jwg-category {
        color: var(--jwg-green);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-top: 1rem;
    }

    .jwg-title {
        font-family: "Playfair Display", ui-serif, Georgia, serif;
        font-weight: 700;
        font-size: 2rem;
        color: #111827;
        letter-spacing: -0.5px;
    }

    .jwg-desc {
        color: var(--jwg-text);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Mockup Blocks */
    .jwg-image-block {
        min-height: 220px;
        border-radius: 12px;
        padding: 1.5rem;
        position: relative;
    }

    .dark-block {
        background-color: var(--jwg-dark);
        color: white;
    }

    .light-block {
        background: linear-gradient(135deg, #ffffff 0%, #f3f4f6 100%);
        border: 1px solid #f3f4f6;
    }

    /* Block Details: Item 1 */
    .jwg-chart {
        display: flex;
        gap: 4px;
        align-items: flex-end;
    }
    .jwg-chart .bar {
        width: 6px;
        background-color: var(--jwg-green);
        border-radius: 2px 2px 0 0;
    }

    /* Block Details: Item 2 (Mic) */
    .mic-circle {
        width: 60px;
        height: 60px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
    }
    .audio-waves {
        display: flex;
        gap: 6px;
        align-items: center;
        height: 40px;
    }
    .wave {
        width: 6px;
        background-color: var(--jwg-green);
        border-radius: 4px;
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
    .automation-pill {
        position: absolute;
        bottom: 12px;
        background-color: white;
        border-radius: 50px;
        padding: 4px 16px;
        font-size: 0.65rem;
        font-weight: 700;
        color: #6b7280;
        letter-spacing: 1px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    /* Result Box */
    .jwg-result-block {
        background-color: #ebfbf3;
        border-left: 3px solid var(--jwg-green);
        padding: 1rem 1.25rem;
        border-radius: 0 8px 8px 0;
    }
    .result-label {
        font-size: 0.7rem;
        color: var(--jwg-green);
        font-weight: 700;
        letter-spacing: 1px;
        margin-bottom: 0.25rem;
    }
    .result-text {
        font-size: 0.9rem;
        color: #1f2937;
        font-weight: 500;
    }

    /* Tags */
    .jwg-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .jwg-badges span {
        border: 1px solid #e5e7eb;
        color: #6b7280;
        font-weight: 500;
        padding: 0.3rem 1rem;
        border-radius: 50px;
        font-size: 0.65rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        background: transparent;
    }

    /* Case Study Modal Styles */
    .case-study-modal .modal-content {
        border-radius: 20px;
        overflow: hidden;
    }
    .case-study-modal .modal-header {
        background-color: #111827 !important;
    }
    .case-study-modal .btn-close-white {
        filter: invert(1) grayscale(1) brightness(2);
    }
    .case-study-modal .metric-value {
        font-family: 'Inter', sans-serif;
        color: var(--waveron-green) !important;
        font-size: 1.75rem;
    }
    .case-study-modal .case-section p {
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .view-case-study-btn {
        transition: all 0.3s ease;
        border-color: var(--waveron-green);
        color: var(--waveron-green);
    }
    .view-case-study-btn:hover {
        background-color: var(--waveron-green);
        border-color: var(--waveron-green);
        color: #fff !important;
        transform: translateY(-2px);
    }
</style>
@endpush

@push('scripts')
<script>
// Abstract Particle Network Animation
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('portfolio-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    
    let width, height;
    function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = canvas.parentElement.offsetHeight;
    }
    window.addEventListener('resize', resize);
    resize();

    const particles = [];
    const properties = {
        bgColor: 'transparent',
        particleColor: 'rgba(0, 100, 0, 0.4)', // waveron green
        particleRadius: 3,
        particleCount: 50,
        particleMaxVelocity: 0.8,
        lineLength: 150,
        particleLife: 6
    };

    class Particle {
        constructor() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.velocityX = Math.random() * (properties.particleMaxVelocity * 2) - properties.particleMaxVelocity;
            this.velocityY = Math.random() * (properties.particleMaxVelocity * 2) - properties.particleMaxVelocity;
            this.life = Math.random() * properties.particleLife * 60;
        }
        position() {
            this.x + this.velocityX > width && this.velocityX > 0 || this.x + this.velocityX < 0 && this.velocityX < 0 ? this.velocityX *= -1 : this.velocityX;
            this.y + this.velocityY > height && this.velocityY > 0 || this.y + this.velocityY < 0 && this.velocityY < 0 ? this.velocityY *= -1 : this.velocityY;
            this.x += this.velocityX;
            this.y += this.velocityY;
        }
        reDraw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, properties.particleRadius, 0, Math.PI * 2);
            ctx.closePath();
            ctx.fillStyle = properties.particleColor;
            ctx.fill();
        }
    }

    function reDrawBackground() {
        ctx.clearRect(0, 0, width, height);
    }

    function drawLines() {
        let x1, y1, x2, y2, length, opacity;
        for (let i in particles) {
            for (let j in particles) {
                x1 = particles[i].x;
                y1 = particles[i].y;
                x2 = particles[j].x;
                y2 = particles[j].y;
                length = Math.sqrt(Math.pow(x2 - x1, 2) + Math.pow(y2 - y1, 2));
                if (length < properties.lineLength) {
                    opacity = 1 - length / properties.lineLength;
                    ctx.lineWidth = '0.5';
                    ctx.strokeStyle = `rgba(0, 100, 0, ${opacity * 0.4})`;
                    ctx.beginPath();
                    ctx.moveTo(x1, y1);
                    ctx.lineTo(x2, y2);
                    ctx.closePath();
                    ctx.stroke();
                }
            }
        }
    }

    function reDrawParticles() {
        for (let i in particles) {
            particles[i].position();
            particles[i].reDraw();
        }
    }

    function loop() {
        reDrawBackground();
        reDrawParticles();
        drawLines();
        requestAnimationFrame(loop);
    }

    function init() {
        for (let i = 0 ; i < properties.particleCount ; i++) {
            particles.push(new Particle);
        }
        loop();
    }
    
    init();
});
</script>

@endpush
