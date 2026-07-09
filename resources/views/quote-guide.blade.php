@extends('layouts.app')

@section('title', 'Service Pricing Guide | Waveron Technologies')
@section('meta_description', 'A comprehensive detailed guide on Waveron Technologies project configurations, complexity levels, timeline multipliers, and estimated feature costs.')
@section('og_title', 'Service Configuration & Pricing Guide — Waveron Technologies')
@section('og_description', 'Understand how Waveron prices software, design, branding, and marketing projects. Detailed guide on complexity levels, timelines, and feature cost breakdowns.')
@section('og_url', 'https://waverontechnologies.co.ke/quote/guide')

@section('content')
<div class="container py-5">
    <!-- Breadcrumbs / Top Actions (Hidden in Print) -->
    <div class="row align-items-center mb-4 no-print">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('quote') }}" class="text-muted text-decoration-none">Quote Calculator</a></li>
                    <li class="breadcrumb-item active text-success fw-bold" aria-current="page">Configuration Guide</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <button onclick="window.print()" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="bi bi-printer me-2"></i> Print or Save as PDF
            </button>
        </div>
    </div>

    <!-- Main Print-styled Document Card -->
    <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
        <!-- Letterhead Header -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
            <div>
                <h2 class="fw-bold text-primary mb-1 d-flex align-items-center">
                    Waveron Technologies
                </h2>
                <p class="text-muted mb-0 small font-monospace">PROJECT CONFIGURATION & PRICING ENGINE GUIDE</p>
            </div>
            <div class="text-end">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-semibold">Version 2.0 (2026)</span>
            </div>
        </div>

        <!-- Introduction -->
        <div class="row mb-5">
            <div class="col-12">
                <h4 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle text-primary me-2"></i> 1. Introduction & Estimating Philosophy</h4>
                <p class="text-muted">
                    At Waveron Technologies, our pricing models are transparent and engineered to deliver maximum client-side value. We utilize an interactive, multi-variable cost engine to construct baseline estimates for software platforms, design assets, corporate branding, and inbound digital marketing funnels. 
                </p>
                <p class="text-muted">
                    Estimates are calculated using a baseline formula that factors in <strong>Service Base Price</strong>, <strong>Complexity Multipliers</strong>, <strong>Timeline Urgency Coefficients</strong>, <strong>Target Feature Adjustments</strong>, and <strong>Flat Add-on Integrations</strong>. This guide breaks down exactly how each configuration parameter works, what it means for your scope, and how it impacts your final budget.
                </p>
            </div>
        </div>

        <!-- Service Types Table -->
        <div class="row mb-5">
            <div class="col-12">
                <h4 class="fw-bold text-dark mb-3"><i class="bi bi-grid-fill text-primary me-2"></i> 2. Core Service Offerings & Base Costs</h4>
                <p class="text-muted">Every configuration starts with a base price representing the standard core project setup, baseline QA testing cycles, and initial system scoping.</p>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 25%;">Service Class</th>
                                <th style="width: 20%;">Base Price</th>
                                <th>Core Baseline Scope (Included)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-primary">Software Development</td>
                                <td class="fw-bold">Ksh 150,000</td>
                                <td class="text-muted small">Standard MVP database architecture, modular routing, responsive interface layout matching standard viewports, API endpoints structure, secure user login/registration system, and initial production server deployment pipeline.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Graphic / UI Design</td>
                                <td class="fw-bold">Ksh 85,000</td>
                                <td class="text-muted small">Up to 5 standard pages design layouts (Desktop + Mobile responsive mockups), custom style guide guidelines, Interactive Figma prototype, standard wireframes mapping, and design source files delivery.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Branding & Identity</td>
                                <td class="fw-bold">Ksh 65,000</td>
                                <td class="text-muted small">Startup brand identity, custom logomark designs (3 initial concepts, 2 revision cycles), color palettes setup, typography pairing recommendations, and digital brand style guidelines book.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-primary">Digital Marketing</td>
                                <td class="fw-bold">Ksh 95,000</td>
                                <td class="text-muted small">Local SEO audit, metadata optimization, primary social media marketing setup, tracking pixel configurations, conversion funnel audit report, and monthly report templates setup.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="page-break"></div>

        <!-- Complexity and Timeline Multipliers -->
        <div class="row mb-5">
            <div class="col-lg-6">
                <h4 class="fw-bold text-dark mb-3"><i class="bi bi-diagram-3-fill text-primary me-2"></i> 3. Complexity & Scale Multipliers</h4>
                <p class="text-muted small">Complexity represents the scale of workflows, system architecture, database relationships, and third-party integrations.</p>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark">Standard MVP (Core flows)</span>
                            <span class="badge bg-primary">1.0x Multiplier</span>
                        </div>
                        <p class="text-muted mb-0 small">Best for testing early ideas. Focuses on straightforward database models, standard dashboards, and standard administrative CRUD operations with no custom middleware rules.</p>
                    </li>
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark">Advanced System (Integrations & workflows)</span>
                            <span class="badge bg-warning text-dark">1.35x - 1.5x Multiplier</span>
                        </div>
                        <p class="text-muted mb-0 small">Requires multi-role authorization levels, custom API webhooks, third-party API integrations (e.g. payment portals, SMS gateways), and real-time dashboard analytics.</p>
                    </li>
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark">Enterprise Platform (Scalable & secure)</span>
                            <span class="badge bg-danger">1.8x - 2.2x Multiplier</span>
                        </div>
                        <p class="text-muted mb-0 small">Requires multi-tenant SaaS workspace isolation, strict encryption protocols, high-availability architecture setups, horizontal load balancer configurations, and intensive data compliance.</p>
                    </li>
                </ul>
            </div>

            <div class="col-lg-6 mt-4 mt-lg-0">
                <h4 class="fw-bold text-dark mb-3"><i class="bi bi-clock-history text-primary me-2"></i> 4. Timeline Urgency Coefficients</h4>
                <p class="text-muted small">Timeline constraints impact resource allocation, parallel design/QA operations, and developer shift hours.</p>
                <ul class="list-group list-group-flush small">
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark">Flexible Timeline</span>
                            <span class="badge bg-success bg-opacity-10 text-success">0.90x Multiplier</span>
                        </div>
                        <p class="text-muted mb-0 small"><strong>Cost Saving:</strong> Gives Waveron flexibility on staging, scheduling priority, and launch targets, translating to a 10% discount on standard rates.</p>
                    </li>
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark">Standard Delivery</span>
                            <span class="badge bg-secondary">1.00x Multiplier</span>
                        </div>
                        <p class="text-muted mb-0 small">Balanced developer allocation, structured sprint demos, standard review periods, and linear deployment schedules.</p>
                    </li>
                    <li class="list-group-item py-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-dark">Rush / Expedited Delivery</span>
                            <span class="badge bg-danger bg-opacity-10 text-danger">1.25x Multiplier</span>
                        </div>
                        <p class="text-muted mb-0 small"><strong>Accelerated Focus:</strong> Compresses milestones by 30-50%. Requires dedicated developer focus, parallel testing pipelines, weekend shifts, and priority QA queues.</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="page-break"></div>

        <!-- Features Breakdown -->
        <div class="row mb-5">
            <div class="col-12">
                <h4 class="fw-bold text-dark mb-4"><i class="bi bi-plugin text-primary me-2"></i> 5. Feature Scope Adjustments (All Services)</h4>
                <p class="text-muted">Feature counts adjust the scope linear coefficient. While the base price includes up to <strong>5 baseline features</strong>, additional features scale the cost by approximately <strong>+6% per feature</strong>. This represents developer or designer effort, testing, and system complexity adjustments.</p>
                
                <!-- Software Development Features -->
                <div class="mb-4">
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-3"><i class="bi bi-code-slash me-2"></i> Software Development Features</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Real-Time Live WebSockets & Messaging</span>
                                <p class="text-muted small mb-0">Persistent server-client channels for instant messaging, typing indicators, and active notification triggers. Replaces slow polling processes.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Custom AI Model / Chatbot Integration</span>
                                <p class="text-muted small mb-0">Interfacing with LLM APIs, engineering optimal prompts, vector database caching for common context, and creating conversational frontend chat bubbles.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Multi-Tenant SaaS Infrastructure Setup</span>
                                <p class="text-muted small mb-0">Isolating user databases at the row level, dynamic workspace subdomain routing (tenant.domain.com), and centralized subscription license controls.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Offline-First Synchronization (PWA)</span>
                                <p class="text-muted small mb-0">Using browser IndexedDB caches to read/write data locally without internet access, with automatic conflict resolution triggers once connection restores.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Advanced Custom Search Engine Integration</span>
                                <p class="text-muted small mb-0">Implementing index configurations (e.g. Meilisearch/Elasticsearch) for instant faceted filter lists, typographic tolerance matching, and custom weighting rules.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graphic / UI Design Features -->
                <div class="mb-4">
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-3"><i class="bi bi-palette me-2"></i> Graphic / UI Design Features</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Interactive Micro-Animations & Lottie Assets</span>
                                <p class="text-muted small mb-0">Custom vector-based animations for transitions, micro-interactions, and visual feedback that enhance user experience.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">3D Rendered Elements & Scene Illustration</span>
                                <p class="text-muted small mb-0">Creating custom 3D design models, abstract scenes, and realistic compositions to distinguish your digital products.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Light / Dark Mode Adaptive Design System</span>
                                <p class="text-muted small mb-0">Generating unified color tokens and layout adaptations to fit light and dark mode OS settings seamlessly.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Interactive Figma Prototype & User Journeys</span>
                                <p class="text-muted small mb-0">Fully clickable and animated prototypes ready for user testing, user flow audits, and developer handoff.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Comprehensive Conversion Rate Audit Report</span>
                                <p class="text-muted small mb-0">Detailed analytical evaluation of UI layouts to find points of friction and improve CTA conversion performance.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Branding & Identity Features -->
                <div class="mb-4">
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-3"><i class="bi bi-award me-2"></i> Branding & Identity Features</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Interactive Brand Guidelines Digital Portal</span>
                                <p class="text-muted small mb-0">A dedicated web-based brand assets hub showing colors, typographies, code blocks, and asset download packages.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Custom Bespoke Typography & Logomark Creation</span>
                                <p class="text-muted small mb-0">Creation of custom vector logo marks and hand-drawn/adjusted typography specifically for your brand.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Animated Motion Graphics (Intros, Transitions)</span>
                                <p class="text-muted small mb-0">Animated logo idents, social media lower-thirds, and slide transitions ready for use in video production.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Premium Packaging & Merchandise Mockups</span>
                                <p class="text-muted small mb-0">Photorealistic prints and layouts mapping your branding onto packaging, corporate apparel, vehicles, or physical collateral.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Sonic Brand Identity (Custom Audio Logo/Jingle)</span>
                                <p class="text-muted small mb-0">Bespoke high-quality sound signature and musical theme for use on podcasts, videos, and phone systems.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Marketing Features -->
                <div class="mb-4">
                    <h5 class="fw-bold text-success border-bottom pb-2 mb-3"><i class="bi bi-megaphone me-2"></i> Digital Marketing Features</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Automated CRM & Multi-Step Sales Funnel Integration</span>
                                <p class="text-muted small mb-0">Setting up leads tracking, email sequencing triggers, dynamic email drips, and CRM landing page templates.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">AI-Powered Competitor Intelligence Tracking</span>
                                <p class="text-muted small mb-0">Configuring scraper monitors tracking competitors' pricing shifts, ad copy campaigns, and keywords ranking.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">SEO Domination (High-Authority Backlink Engine)</span>
                                <p class="text-muted small mb-0">Targeted campaign structures aimed at acquiring high Domain Authority contextual backlinks to scale organic ranks.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Influencer Partnership Strategy & Matchmaking</span>
                                <p class="text-muted small mb-0">Vetting, coordinating, and outlining campaign briefs for micro and macro influencer target niches.</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="border rounded-3 p-3 h-100">
                                <span class="fw-bold text-dark d-block mb-1">Predictive Analytics & Lifetime Value Reporting</span>
                                <p class="text-muted small mb-0">Dynamic dashboards showing conversion channels attribution models, LTV predictions, and cohort retention metrics.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add-ons Breakdown -->
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="fw-bold text-dark mb-4"><i class="bi bi-box-seam-fill text-primary me-2"></i> 6. Premium Flat Add-ons (All Services)</h4>
                <p class="text-muted">Optional architecture and compliance modules that stack flat pricing layers onto any calculated base scope, specific to each service class.</p>
                
                <div class="row g-3">
                    <!-- Software Dev Add-ons -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Security & Auto-Patching</span>
                                <span class="badge bg-primary text-white">Ksh 25,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Software Add-on:</strong> Automated vulnerability scans, framework patch upgrades, and regular firewall rules maintenance.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">24/7 SLA Emergency Support</span>
                                <span class="badge bg-primary text-white">Ksh 20,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Software Add-on:</strong> Guaranteed 1-hour critical response, server monitor failover configs, and alert integrations.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Behavioral Intelligence Setup</span>
                                <span class="badge bg-primary text-white">Ksh 15,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Software Add-on:</strong> Mixpanel/Hotjar analytics trigger mapping, session records, and conversion funnel dashboards.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">AI E2E Testing Suite (Playwright)</span>
                                <span class="badge bg-primary text-white">Ksh 30,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Software Add-on:</strong> Complete suite of automated browser tests running before deployment to avoid regressions.</p>
                        </div>
                    </div>

                    <!-- Design Add-ons -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Lottie & Micro-Animations</span>
                                <span class="badge bg-success text-white">Ksh 15,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Design Add-on:</strong> Custom interactive SVG vector animations ready for web/app implementation.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Custom 3D Render Elements</span>
                                <span class="badge bg-success text-white">Ksh 20,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Design Add-on:</strong> High-quality 3D models and compositions designed exclusively for layout integration.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">UX A/B Testing Variant Assets</span>
                                <span class="badge bg-success text-white">Ksh 25,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Design Add-on:</strong> Alternative screen layouts and elements designed specifically for UX variants comparison.</p>
                        </div>
                    </div>

                    <!-- Branding Add-ons -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Stationery & Pitch Deck Templates</span>
                                <span class="badge bg-warning text-dark">Ksh 15,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Branding Add-on:</strong> Presentation slides, business cards, letterheads, and corporate templates.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Motion Graphics (Animated Logo)</span>
                                <span class="badge bg-warning text-dark">Ksh 25,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Branding Add-on:</strong> 2D/3D custom animated logomarks, intro/outro idents for video campaigns.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Sonic Identity (Audio Jingle)</span>
                                <span class="badge bg-warning text-dark">Ksh 30,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Branding Add-on:</strong> Custom-tailored audio logo and brand sound signatures.</p>
                        </div>
                    </div>

                    <!-- Marketing Add-ons -->
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Premium Editorial Backlinks</span>
                                <span class="badge bg-info text-white">Ksh 30,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Marketing Add-on:</strong> Premium placement links pointing to your domains from high-ranking blogs.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Influencer Sourcing & Placement</span>
                                <span class="badge bg-info text-white">Ksh 35,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Marketing Add-on:</strong> Vetting, connecting, and handling negotiations with niche industry influencer leaders.</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border rounded-3 p-3 bg-light h-100">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark">Automated CRM Funnel Setup</span>
                                <span class="badge bg-info text-white">Ksh 20,000</span>
                            </div>
                            <p class="text-muted small mb-0"><strong>Marketing Add-on:</strong> Setting up CRM triggers, integration APIs, scoring models, and auto-drip flows.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact/Callout -->
        <div class="border-top pt-4 mt-5 d-flex flex-column flex-md-row justify-content-between align-items-center text-muted small">
            <div>
                <p class="mb-1">&copy; {{ date('Y') }} Waveron Technologies. All rights reserved.</p>
                <p class="mb-0">Website: <a href="https://waverontechnologies.co.ke" class="text-muted text-decoration-none">waverontechnologies.co.ke</a></p>
            </div>
            <div class="text-md-end mt-3 mt-md-0 font-monospace">
                <p class="mb-1">Support: info@waverontechnologies.co.ke</p>
                <p class="mb-0">Call: +254 798 717 800</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @media print {
        /* Hide navbar, footer, breadcrumbs and action buttons */
        nav, footer, .no-print, .btn, .breadcrumb, header {
            display: none !important;
        }
        
        body {
            background-color: #fff !important;
            color: #000 !important;
            padding: 0 !important;
            margin: 0 !important;
            font-size: 11pt !important;
        }
        
        .container {
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        .page-break {
            page-break-before: always;
            clear: both;
        }

        a {
            text-decoration: none !important;
            color: #000 !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // If URL contains ?download=1 or ?print=1, automatically trigger the browser print window
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('download') === '1' || urlParams.get('print') === '1') {
        setTimeout(() => {
            window.print();
        }, 1000);
    }
});
</script>
@endpush
