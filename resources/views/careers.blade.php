@extends('layouts.app')

@section('title', 'Careers & Referrals - Waveron')
@section('meta_description', 'Join the Waveron Technologies team or participate in our referral program. Explore job openings, career development, and contract opportunities.')
@section('og_title', 'Careers at Waveron Technologies — Join the Team')
@section('og_description', 'We are building the future of digital solutions in Kenya. Explore open positions and our referral program to earn commissions by connecting clients with Waveron.')
@section('og_url', 'https://waverontechnologies.co.ke/careers')

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

        <div class="row justify-content-center g-4">
            <div class="col-lg-8">
                @forelse($roles as $role)
                    <div class="card border-0 shadow-sm rounded-4 hover-lift mb-4">
                        <div class="card-body p-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                            <div class="mb-4 mb-md-0 flex-grow-1">
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <h3 class="fw-bold mb-0">{{ $role->title }}</h3>
                                    <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">{{ $role->employment_type }}</span>
                                </div>
                                <p class="text-muted mb-3">
                                    <i class="bi bi-geo-alt me-2"></i>{{ $role->location }} &nbsp;&bull;&nbsp;
                                    <i class="bi bi-cash me-2"></i>{{ $role->compensation }}
                                </p>
                                <div class="mb-2 text-start">
                                    <h5 class="fw-bold fs-6">Prerequisites:</h5>
                                    @if(is_array($role->prerequisites))
                                        <ul class="text-muted small mb-0">
                                            @foreach($role->prerequisites as $prereq)
                                                <li>{{ $prereq }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted small mb-0">{{ $role->prerequisites }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="ms-md-4 shrink-0">
                                <button class="btn btn-primary rounded-pill px-4 py-2 w-100" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#applyModal" 
                                        data-role-id="{{ $role->id }}" 
                                        data-role-title="{{ $role->title }}">
                                    Apply Now
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <i class="bi bi-briefcase text-muted mb-3" style="font-size: 3rem;"></i>
                        <h4 class="fw-bold">No Open Positions</h4>
                        <p class="text-muted">We don't have any open recruitment postings at the moment. However, we are always on the lookout for talent!</p>
                        <button class="btn btn-primary rounded-pill px-4 py-2 mt-2" 
                                data-bs-toggle="modal" 
                                data-bs-target="#applyModal" 
                                data-role-id="" 
                                data-role-title="General Application">
                            Submit General Application
                        </button>
                    </div>
                @endforelse
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
          <input type="hidden" name="career_role_id" id="modal_career_role_id" value="">

          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Full Name</label>
            <input type="text" name="name" class="form-control rounded-3" required placeholder="John Doe">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Email Address &amp; Phone Contact</label>
            <input type="text" name="contact" class="form-control rounded-3" required placeholder="e.g. john@example.com or +254 700 000 000">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Years of Professional Experience</label>
            <input type="number" name="years_exp" class="form-control rounded-3" required min="0" max="50" placeholder="e.g. 5">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Resume / CV (PDF, DOCX)</label>
            <input type="file" name="resume" class="form-control rounded-3" required accept=".pdf,.doc,.docx">
          </div>
          <div class="mb-3">
            <label class="form-label text-muted small fw-bold">Why are you a great fit for Waveron?</label>
            <textarea name="why_fit" class="form-control rounded-3" rows="3" required placeholder="Briefly describe your experience and why you would excel in this role..."></textarea>
          </div>

          <hr class="my-3">
          <p class="fw-bold text-dark mb-3" style="font-size:0.95rem;">Custom Application Questions</p>

          <div class="mb-3">
            <label class="form-label text-muted small fw-bold" id="q1_label">1. What is the largest deal you have personally closed?</label>
            <p class="text-muted" id="q1_desc" style="font-size:0.78rem; margin-top:-4px;">Include the product/service sold, approximate deal value, and your specific role in the sale.</p>
            <textarea name="largest_deal" class="form-control rounded-3" rows="4" required placeholder="E.g. Closed a KSh 2.5M ERP implementation..."></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label text-muted small fw-bold" id="q2_label">2. Describe a sale you are particularly proud of.</label>
            <p class="text-muted" id="q2_desc" style="font-size:0.78rem; margin-top:-4px;">What was the client's challenge, how did you approach the opportunity, and what was the outcome?</p>
            <textarea name="proud_sale" class="form-control rounded-3" rows="4" required placeholder="Describe the opportunity..."></textarea>
          </div>

          <div class="mb-4">
            <label class="form-label text-muted small fw-bold" id="q3_label">3. If hired, how would you find your first three potential clients for Waveron Technologies within the first 30 days?</label>
            <p class="text-muted" id="q3_desc" style="font-size:0.78rem; margin-top:-4px;">Please be as specific as possible.</p>
            <textarea name="first_clients" class="form-control rounded-3" rows="4" required placeholder="Describe your 30-day outreach strategy..."></textarea>
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
                                    @if (session('referral_success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            Referral submitted successfully! Your tracking code is: <strong>{{ session('referral_code') }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                document.getElementById('referralCodeDisplay').textContent = "{{ session('referral_code') }}";
                                                const refModal = new bootstrap.Modal(document.getElementById('referralSuccessModal'));
                                                refModal.show();
                                            });
                                        </script>
                                    @endif

                                    @if ($errors->any() && !session('success'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('referrals.submit') }}" method="POST">
                                        @csrf
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label text-muted small fw-semibold">Your Name <span class="text-danger">*</span></label>
                                                <input type="text" name="referrer_name" class="form-control" required placeholder="John Doe">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label text-muted small fw-semibold">Your Email or Phone <span class="text-danger">*</span></label>
                                                <input type="text" name="referrer_contact" class="form-control" required placeholder="For tracking code & payout">
                                            </div>
                                        </div>

                                        <div class="p-3 bg-light rounded-3 mb-3 border">
                                            <div class="text-xs uppercase fw-bold text-primary mb-2" style="letter-spacing: 0.5px;">Client Lead Information</div>
                                            <div class="mb-2">
                                                <label class="form-label text-muted small fw-semibold">Company / Client Name <span class="text-danger">*</span></label>
                                                <input type="text" name="client_name" class="form-control" required placeholder="Acme Enterprises or Client Full Name">
                                            </div>
                                            <div class="row g-2 mb-2">
                                                <div class="col-md-12">
                                                    <label class="form-label text-muted small">Key Contact Person (Optional)</label>
                                                    <input type="text" name="client_contact_person" class="form-control" placeholder="E.g. Managing Director, Sarah Muthoni">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label text-muted small">Client Email (Optional)</label>
                                                    <input type="email" name="client_email" class="form-control" placeholder="client@company.co.ke">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label text-muted small">Client Phone (Optional)</label>
                                                    <input type="text" name="client_phone" class="form-control" placeholder="+254 7XX XXX XXX">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label text-muted small fw-semibold">What services do they need?</label>
                                            <textarea name="services_needed" class="form-control" rows="2" placeholder="E.g. Custom web portal, mobile app development, branding..."></textarea>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label text-muted small">Additional Notes / Intro Context (Optional)</label>
                                            <textarea name="notes" class="form-control" rows="2" placeholder="E.g. They are planning to launch next month and looking for a reputable software partner."></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2.5 fw-bold shadow-sm">Submit Client Referral</button>
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

    // Dynamic Apply Modal Labels & Fields Configuration
    const applyModal = document.getElementById('applyModal');
    if (applyModal) {
        applyModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const roleId = button.getAttribute('data-role-id');
            const roleTitle = button.getAttribute('data-role-title');
            
            const modalTitle = applyModal.querySelector('.modal-title');
            const roleIdInput = applyModal.querySelector('#modal_career_role_id');
            
            modalTitle.textContent = 'Apply for ' + roleTitle;
            roleIdInput.value = roleId;

            // Check if the title is sales-related or general/default
            const isSales = roleTitle.toLowerCase().includes('sales') || roleTitle.toLowerCase().includes('general') || !roleId;

            const q1Label = applyModal.querySelector('#q1_label');
            const q1Desc = applyModal.querySelector('#q1_desc');
            const q1Input = applyModal.querySelector('textarea[name="largest_deal"]');

            const q2Label = applyModal.querySelector('#q2_label');
            const q2Desc = applyModal.querySelector('#q2_desc');
            const q2Input = applyModal.querySelector('textarea[name="proud_sale"]');

            const q3Label = applyModal.querySelector('#q3_label');
            const q3Desc = applyModal.querySelector('#q3_desc');
            const q3Input = applyModal.querySelector('textarea[name="first_clients"]');

            if (isSales) {
                q1Label.textContent = '1. What is the largest deal you have personally closed?';
                q1Desc.textContent = 'Include the product/service sold, approximate deal value, and your specific role in the sale.';
                q1Input.placeholder = 'E.g. Closed a KSh 2.5M ERP implementation for a logistics company — I prospected the lead, ran all demos, and negotiated the contract...';

                q2Label.textContent = '2. Describe a sale you are particularly proud of.';
                q2Desc.textContent = 'What was the client\'s challenge, how did you approach the opportunity, and what was the outcome?';
                q2Input.placeholder = 'The client was struggling with customer churn. I positioned our CRM as a retention tool, ran a 2-week trial, and converted them to a 12-month contract...';

                q3Label.textContent = '3. If hired, how would you find your first three potential clients for Waveron Technologies within the first 30 days?';
                q3Desc.textContent = 'Please be as specific as possible.';
                q3Input.placeholder = 'Week 1: I would map SMEs in Westlands using Google Maps and LinkedIn, targeting founders with active Facebook/Instagram pages but no professional website. Week 2...';
            } else {
                q1Label.textContent = '1. What is the largest or most complex technical system you have architected/delivered?';
                q1Desc.textContent = 'Include the technologies used, scale of the project, and your specific architectural contributions.';
                q1Input.placeholder = 'E.g. Architected a real-time telemetry pipeline for a logistics company using Go and Kafka, handling 50k concurrent requests...';

                q2Label.textContent = '2. Describe a technical achievement or system migration you are particularly proud of.';
                q2Desc.textContent = 'What was the technical bottleneck or problem, how did you solve it, and what was the engineering impact?';
                q2Input.placeholder = 'Convinced a skeptical team to migrate a legacy monolith to Go microservices, improving throughput by 10x and database load by 40%...';

                q3Label.textContent = '3. If hired, what is your 30-day plan to integrate and start contributing to Waveron\'s technical stack?';
                q3Desc.textContent = 'Describe how you will familiarize yourself with our codebase, architecture, and systems.';
                q3Input.placeholder = 'Week 1: Local setup, audit dependencies. Week 2: Fix minor backlogged bugs, write unit tests. Week 3: Partner with senior devs on core tasks...';
            }
        });
    }
});
</script>
@endpush
