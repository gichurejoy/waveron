@extends('layouts.app')

@section('title', 'Careers & Referrals - Waveron')
@section('meta_description', 'Join the Waveron Technologies team or participate in our referral program. Explore job openings, career development, and contract opportunities.')

@section('content')
<!-- Hero Section -->
<section class="careers-hero py-5 position-relative">
    <div class="animated-background"></div>
    <div class="container py-5 text-center position-relative" style="z-index: 2;">
        <h1 class="display-3 fw-bold mb-4" style="color: var(--waveron-green);">Join the Waveron Team</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">
            We're building the future of digital solutions. Are you ready to make an impact? Discover our open positions below or refer top talent and earn rewards!
        </p>
    </div>
</section>

<!-- Open Positions Section -->
<section class="open-positions py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold">Open Positions</h2>
            <p class="text-muted">Currently looking for passionate individuals to join us.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 hover-lift">
                    <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                        <div class="mb-4">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <h3 class="fw-bold mb-0">Salesperson</h3>
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Full-Time / Contract</span>
                            </div>
                            <p class="text-muted mb-3">
                                <i class="bi bi-geo-alt me-2"></i>Nairobi, Kenya (Hybrid/Remote) &nbsp;&bull;&nbsp;
                                <i class="bi bi-cash me-2"></i>Commission-Based
                            </p>
                            <div class="mb-4 text-start">
                                <h5 class="fw-bold fs-6">Job Description:</h5>
                                <p class="text-muted small mb-2">As a Salesperson at Waveron, you will be responsible for driving business growth. Unique to Waveron, you won't just be selling our custom digital services (Software Development, Branding, Design)—you will also have a powerful suite of our proprietary SaaS software products to pitch, making your closing potential immense!</p>
                                <ul class="text-muted small">
                                    <li>Sell subscriptions and licenses to our proprietary platforms: Waveron CRM, our automated Brand Book Generator, and our Job/Scholarship Matching Platform.</li>
                                    <li>Identify and pursue new B2B clients for custom agency services (Web, Mobile, Enterprise Solutions).</li>
                                    <li>Understand client needs and match them accurately with our SaaS products or custom services.</li>
                                    <li>Negotiate contracts, close enterprise deals, and build lasting relationships to maximize your revenue.</li>
                                </ul>
                                <div class="alert alert-success bg-success bg-opacity-10 border-0 py-2 px-3 mt-3">
                                    <i class="bi bi-info-circle-fill text-success me-2"></i>
                                    <span class="small fw-medium text-success text-dark">Compensation: Commissions are paid out strictly on clients who have successfully paid for their services.</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary rounded-pill px-4 py-2 w-100" data-bs-toggle="modal" data-bs-target="#applyModal">Apply Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Apply Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow rounded-4">
      <div class="modal-header border-bottom border-primary border-opacity-10 bg-light rounded-top-4">
        <h5 class="modal-title fw-bold" id="applyModalLabel">Apply for Salesperson</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var myModal = new bootstrap.Modal(document.getElementById('applyModal'));
                    myModal.show();
                });
            </script>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var myModal = new bootstrap.Modal(document.getElementById('applyModal'));
                    myModal.show();
                });
            </script>
        @endif

        <form action="{{ route('careers.submit') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Full Name</label>
            <input type="text" name="name" class="form-control rounded-3" required placeholder="John Doe">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Email Address / Phone Number</label>
            <input type="text" name="contact" class="form-control rounded-3" required placeholder="john@example.com">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Resume / CV (PDF, DOCX)</label>
            <input type="file" name="resume" class="form-control rounded-3" required accept=".pdf,.doc,.docx">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Why are you a great fit for Waveron?</label>
            <textarea name="why_fit" class="form-control rounded-3" rows="3" required placeholder="Briefly describe your sales experience and why you would excel at pitching our custom services and SaaS products..."></textarea>
          </div>

          <hr class="my-3">
          <p class="fw-bold text-dark mb-3" style="font-size:0.95rem;">Custom Application Questions</p>

          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">1. What is the largest deal you have personally closed?</label>
            <p class="text-muted" style="font-size:0.78rem; margin-top:-4px;">Include the product/service sold, approximate deal value, and your specific role in the sale.</p>
            <textarea name="largest_deal" class="form-control rounded-3" rows="4" required placeholder="E.g. Closed a KSh 2.5M ERP implementation for a logistics company — I prospected the lead, ran all demos, and negotiated the contract..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">2. Describe a sale you are particularly proud of.</label>
            <p class="text-muted" style="font-size:0.78rem; margin-top:-4px;">What was the client's challenge, how did you approach the opportunity, and what was the outcome?</p>
            <textarea name="proud_sale" class="form-control rounded-3" rows="4" required placeholder="The client was struggling with customer churn. I positioned our CRM as a retention tool, ran a 2-week trial, and converted them to a 12-month contract..."></textarea>
          </div>

          <div class="mb-4">
            <label class="form-label text-muted small fw-bold">3. If hired, how would you find your first three potential clients for Waveron Technologies within the first 30 days?</label>
            <p class="text-muted" style="font-size:0.78rem; margin-top:-4px;">Please be as specific as possible.</p>
            <textarea name="first_clients" class="form-control rounded-3" rows="4" required placeholder="Week 1: I would map SMEs in Westlands using Google Maps and LinkedIn, targeting founders with active Facebook/Instagram pages but no professional website. Week 2..."></textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Submit Application</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Referrals Program Section -->
<section class="referrals-section py-5 bg-primary bg-opacity-10 mt-5">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="bg-white rounded-5 shadow p-4 p-md-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6">
                            <span class="badge bg-primary rounded-pill px-3 py-2 mb-3">Client Referral Program</span>
                            <h2 class="display-6 fw-bold mb-3">Refer a client and earn</h2>
                            <p class="text-muted mb-4">
                                Do you know a business, startup, or individual looking for top-tier <strong>Software Development, Branding, Design, or Digital Marketing</strong>? Connect them with us and earn a generous commission for every successful project!
                            </p>
                            
                            <ul class="list-unstyled mb-0 text-muted">
                                <li class="d-flex mb-3 align-items-center gap-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-weight: bold;">1</div>
                                    <span><strong>Submit details:</strong> Use the form to introduce a potential client.</span>
                                </li>
                                <li class="d-flex mb-3 align-items-center gap-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-weight: bold;">2</div>
                                    <span><strong>We close the deal:</strong> Our team will reach out and provide a tailored digital solution.</span>
                                </li>
                                <li class="d-flex align-items-center gap-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-weight: bold;">3</div>
                                    <span><strong>You get paid:</strong> Earn your commission as soon as the client makes their payment.</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm border-top border-primary border-4 rounded-4">
                                <div class="card-body p-4">
                                    <h4 class="fw-bold mb-4 text-center">Referral Form</h4>
                                    <form onsubmit="event.preventDefault(); const code = 'WVRN-' + Math.random().toString(36).substr(2, 6).toUpperCase(); document.getElementById('referralCodeDisplay').textContent = code; const refModal = new bootstrap.Modal(document.getElementById('referralSuccessModal')); refModal.show(); this.reset();">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Your Name</label>
                                            <input type="text" class="form-control" required placeholder="John Doe">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Your Email / Phone</label>
                                            <input type="text" class="form-control" required placeholder="To contact you for payout">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Client / Company Name</label>
                                            <input type="text" class="form-control" required placeholder="Acme Corp">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label text-muted small">What services do they need?</label>
                                            <textarea class="form-control" rows="2" placeholder="E.g. A new e-commerce website and logo design."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold">Submit Client Referral</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Referral Success Modal -->
<div class="modal fade" id="referralSuccessModal" tabindex="-1" aria-labelledby="referralSuccessModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4 text-center">
      <div class="modal-body p-5">
        <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
          <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
        </div>
        <h3 class="fw-bold mb-3 text-dark">Referral Submitted!</h3>
        <p class="text-muted mb-4">Your referral has been successfully logged. Keep this tracking code to claim your commission when the client pays:</p>
        
        <div class="bg-light rounded-3 p-3 mb-4 d-flex align-items-center justify-content-between border">
          <code class="fs-4 fw-bold text-primary" id="referralCodeDisplay">WVRN-XXXXXX</code>
          <button type="button" class="btn btn-outline-primary btn-sm rounded-pill" onclick="navigator.clipboard.writeText(document.getElementById('referralCodeDisplay').textContent); this.innerHTML = '<i class=&quot;bi bi-check2&quot;></i> Copied!'; setTimeout(() => this.innerHTML = '<i class=&quot;bi bi-copy&quot;></i> Copy', 2000);">
            <i class="bi bi-copy"></i> Copy
          </button>
        </div>
        
        <button type="button" class="btn btn-primary rounded-pill px-5 py-2 w-100" data-bs-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

@include('partials.footer')

@endsection

@push('styles')
<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
    }

    /* Abstract Background Styles */
    .careers-hero {
        position: relative;
        padding: 6rem 0 4rem;
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
        z-index: 1;
    }

    .tech-grid {
        position: absolute;
        width: 200%;
        height: 200%;
        transform: rotateX(60deg) translateZ(-100px);
    }

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

    .circuit-lines {
        position: absolute;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
    }

    .circuit-line {
        position: absolute;
        background: var(--waveron-green, #006400);
        opacity: 0.2;
        transform-style: preserve-3d;
        animation: glowPulse 2s ease-in-out infinite;
    }

    .tech-element {
        position: absolute;
        width: 20px;
        height: 20px;
        background: var(--waveron-green, #006400);
        transform-style: preserve-3d;
        opacity: 0.3;
        animation: float 4s ease-in-out infinite;
    }

    .data-stream {
        position: absolute;
        width: 2px;
        height: 100%;
        background: linear-gradient(to bottom, transparent, var(--waveron-green, #006400), transparent);
        opacity: 0.2;
        transform-style: preserve-3d;
        animation: dataFlow 3s linear infinite;
    }

    @keyframes rotate3d {
        0% { transform: rotateX(60deg) rotateZ(0); }
        100% { transform: rotateX(60deg) rotateZ(360deg); }
    }

    @keyframes glowPulse {
        0%, 100% { opacity: 0.2; box-shadow: 0 0 10px var(--waveron-green, #006400); }
        50% { opacity: 0.4; box-shadow: 0 0 20px var(--waveron-green, #006400); }
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
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const background = document.querySelector('.animated-background');
    if(!background) return;
    
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
            ${isVertical ? 'width: 2px; height: '+size+'px; left: '+position+'%;' 
                        : 'height: 2px; width: '+size+'px; top: '+position+'%;'}
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
@endpush
