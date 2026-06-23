@extends('layouts.app')

@section('title', 'Service Quote Calculator - Waveron')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-8">
                <span class="badge bg-primary-subtle text-primary fw-semibold px-3 py-2 rounded-pill">Interactive pricing</span>
                <h1 class="display-5 fw-bold text-primary mt-3">Service Request Quote Calculator</h1>
                <p class="lead text-muted">Build a quick, ballpark estimate for your next project. Adjust scope, complexity, and timeline to see how they influence pricing.</p>
            </div>
        </div>

        <!-- Tabs -->
        <h4 class="text-center mb-4 text-muted fw-normal">How would you like to start?</h4>
        <ul class="nav nav-pills justify-content-center mb-5 gap-3" id="quoteTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4" id="calculator-tab" data-bs-toggle="pill" data-bs-target="#calculator" type="button" role="tab" aria-controls="calculator" aria-selected="true">
                    <i class="bi bi-calculator me-2"></i> Interactive Calculator
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4" id="inquiry-tab" data-bs-toggle="pill" data-bs-target="#inquiry" type="button" role="tab" aria-controls="inquiry" aria-selected="false">
                    <i class="bi bi-send me-2"></i> Fast Inquiry
                </button>
            </li>
        </ul>

        <div class="tab-content" id="quoteTabsContent">
            <!-- Tab 1: Calculator -->
            <div class="tab-pane fade show active" id="calculator" role="tabpanel" aria-labelledby="calculator-tab">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 p-lg-5">
                                <h3 class="h4 fw-bold mb-4">Configure your project</h3>
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold">Service type</label>
                                        <select id="serviceSelect" class="form-select form-select-lg">
                                            <option value="software">Software Development (web/app platforms)</option>
                                            <option value="design">Graphic / UI Design</option>
                                            <option value="branding">Branding & Identity</option>
                                            <option value="marketing">Digital Marketing</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Complexity / Scale</label>
                                        <select id="complexitySelect" class="form-select">
                                        </select>
                                        <div class="text-muted small mt-2" id="complexityDescription">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Timeline urgency</label>
                                        <select id="timelineSelect" class="form-select">
                                            <option value="flexible">Flexible (best value)</option>
                                            <option value="standard">Standard</option>
                                            <option value="rush">Rush / expedited</option>
                                        </select>
                                        <div class="text-muted small mt-2">
                                            Flexible: best value, schedule can shift. Standard: balanced speed and cost. Rush: compressed timeline, more resources/QA to hit dates.
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold d-flex align-items-center justify-content-between">
                                            Select the features to include
                                            <span class="text-muted small" id="featureCountLabel">0 selected</span>
                                        </label>
                                        <ul class="list-unstyled mb-0 small" id="featureList" style="max-height: 280px; overflow-y: auto;"></ul>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-semibold d-block mb-2">Add-ons</label>
                                        <div class="text-muted small mb-2">Optional layers that stack on top of the estimate (works with any complexity/timeline).</div>
                                        <div class="row g-3" id="addonsContainer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm h-100 quote-summary-card">
                            <div class="card-body p-4 p-lg-5">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <h3 class="h4 fw-bold mb-0">Estimate summary</h3>
                                    <span class="badge bg-primary text-white">Instant</span>
                                </div>
                                <ul class="list-unstyled mb-4" id="breakdownList"></ul>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="text-muted">Estimated total</span>
                                    <span class="h3 fw-bold text-primary" id="totalDisplay">Ksh 0</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <span class="text-muted small">Est. monthly (6-month engagement)</span>
                                    <span class="fw-semibold" id="monthlyDisplay">Ksh 0</span>
                                </div>
                                <div class="alert alert-info d-flex align-items-start gap-2">
                                    <i class="bi bi-info-circle text-primary fs-5"></i>
                                    <div class="small mb-0">This is a ballpark estimate. We tailor final pricing to your exact scope, integrations, and success criteria.</div>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg" id="shareDetailsBtn">
                                        <i class="bi bi-send me-2"></i>Share my project details
                                    </a>
                                    <button class="btn btn-outline-primary" id="emailEstimateBtn" type="button">
                                        <i class="bi bi-envelope me-2"></i>Email this estimate
                                    </button>
                                    <button class="btn btn-outline-secondary" id="pdfEstimateBtn" type="button">
                                        <i class="bi bi-file-earmark-pdf me-2"></i>Download PDF
                                    </button>
                                    <a href="{{ route('quote.guide') }}?download=1" target="_blank" class="btn btn-link text-success fw-bold text-decoration-none mt-2 text-center" id="downloadGuideBtn">
                                        <i class="bi bi-book me-1"></i> Download Configuration & Cost Guide (PDF)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Inquiry Form -->
            <div class="tab-pane fade" id="inquiry" role="tabpanel" aria-labelledby="inquiry-tab">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body p-4 p-lg-5">
                                <div class="row">
                                    <div class="col-lg-4 mb-4 mb-lg-0 border-end-lg">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 mb-3">
                                            <i class="bi bi-circle-fill me-1 small"></i> Now booking Q4 2025
                                        </span>
                                        <h3 class="fw-bold mb-4">Ready to ship something great?</h3>
                                        
                                        <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
                                            <li class="d-flex gap-2 text-muted">
                                                <i class="bi bi-check2 text-success"></i>
                                                <span>Senior-only team on every engagement</span>
                                            </li>
                                            <li class="d-flex gap-2 text-muted">
                                                <i class="bi bi-check2 text-success"></i>
                                                <span>Weekly demos and shared roadmaps</span>
                                            </li>
                                            <li class="d-flex gap-2 text-muted">
                                                <i class="bi bi-check2 text-success"></i>
                                                <span>Clear pricing, flexible scopes</span>
                                            </li>
                                        </ul>

                                        <div class="d-flex flex-column gap-2 text-muted small">
                                            <a href="mailto:info@waverontechnologies.co.ke" class="text-decoration-none text-muted">
                                                <i class="bi bi-envelope me-2"></i> info@waverontechnologies.co.ke
                                            </a>
                                            <a href="{{ route('contact') }}" class="text-decoration-none text-muted">
                                                <i class="bi bi-telephone me-2"></i> Schedule a call
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-8 ps-lg-5">
                                        <form action="{{ route('contact.submit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="subject" value="New Project Inquiry (Fast Track)">
                                            
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted">Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="you@company.com" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted">Company</label>
                                                    <input type="text" name="company" class="form-control" placeholder="Company name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted">Budget</label>
                                                    <input type="text" name="budget" class="form-control" placeholder="Ksh 50,000 - Ksh 100,000">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted">Timeline</label>
                                                    <input type="text" name="timeline" class="form-control" placeholder="ASAP">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label small fw-bold text-muted">Services</label>
                                                    <input type="text" name="services" class="form-control" placeholder="Product Design">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label small fw-bold text-muted">Project details</label>
                                                    <textarea name="message" class="form-control" rows="4" placeholder="What are you building? Goals, scope, links..." required></textarea>
                                                </div>
                                                <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                                                    <span class="small text-muted">We'll get back to you within 24 hours with next steps.</span>
                                                    <button type="submit" class="btn btn-success rounded-pill px-4">
                                                        Send inquiry
                                                        <i class="bi bi-send-fill ms-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Email Estimate Modal -->
<div class="modal fade" id="emailEstimateModal" tabindex="-1" aria-labelledby="emailEstimateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="emailEstimateModalLabel">Email Estimate Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">
                <p class="text-muted small">Enter your email address to receive a detailed breakdown of your project configuration. The estimate will also be forwarded directly to our team at <strong>info@waverontechnologies.co.ke</strong>.</p>
                <div class="mb-3">
                    <label for="estimate-email-input" class="form-label small fw-bold">Your Email Address</label>
                    <input type="email" id="estimate-email-input" class="form-control rounded-3" placeholder="name@company.com" required>
                    <div class="invalid-feedback" id="estimate-email-error-msg">Please enter a valid email address.</div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="sendEstimateSubmitBtn" class="btn btn-primary rounded-pill px-4">
                    <span id="sendEstimateSpinner" class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
                    Send Estimate
                </button>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

@push('styles')
<style>
    .quote-summary-card {
        position: sticky;
        top: 96px;
    }
    .form-check-input {
        border-color: #cfd4da;
    }
    .form-check-input:checked {
        background-color: var(--waveron-green);
        border-color: var(--waveron-green);
    }
    .bg-primary-subtle {
        background-color: rgba(0, 100, 0, 0.08) !important;
    }
    /* Add border-end-lg utility for large screens */
    @media (min-width: 992px) {
        .border-end-lg {
            border-right: 1px solid #dee2e6;
        }
    }
    .nav-pills .nav-link {
        color: #6c757d;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }
    .nav-pills .nav-link.active {
        background-color: var(--primary-color, #006400);
        color: #fff;
        border-color: var(--primary-color, #006400);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const serviceSelect = document.getElementById('serviceSelect');
    const complexitySelect = document.getElementById('complexitySelect');
    const timelineSelect = document.getElementById('timelineSelect');
    const featureCountLabel = document.getElementById('featureCountLabel');
    const featureList = document.getElementById('featureList');
    const breakdownList = document.getElementById('breakdownList');
    const totalDisplay = document.getElementById('totalDisplay');
    const monthlyDisplay = document.getElementById('monthlyDisplay');
    const emailEstimateBtn = document.getElementById('emailEstimateBtn');
    const pdfEstimateBtn = document.getElementById('pdfEstimateBtn');

    const timelineMultipliers = {
        flexible: 0.9,
        standard: 1,
        rush: 1.25,
    };

    const serviceConfigs = {
        software: {
            basePrice: 150000,
            complexities: [
                { value: 'basic', label: 'Standard MVP (Core flows)', multiplier: 1.0, desc: 'Ideal for simple flows, standard features, and minimal custom logic.' },
                { value: 'advanced', label: 'Advanced System (Integrations & workflows)', multiplier: 1.35, desc: 'Multiple user roles, custom dashboard widgets, and third-party API connectivity.' },
                { value: 'enterprise', label: 'Enterprise Platform (Scalable & secure)', multiplier: 1.8, desc: 'High-availability architecture, multi-tenant SaaS capability, and intensive data compliance.' }
            ],
            addons: [
                { value: 'maintenance', label: 'Continuous Security & Auto-Patching', desc: 'Weekly malware sweeps, vulnerability patching, dependency updates.', price: 25000 },
                { value: 'support', label: '24/7 SLA-Backed Emergency Hotlines', desc: 'Guaranteed under-1-hour resolution for critical downtimes.', price: 20000 },
                { value: 'analytics', label: 'Advanced Behavioral Intelligence', desc: 'Heatmapping and user recording (Hotjar/Mixpanel).', price: 15000 },
                { value: 'qa', label: 'AI-Driven Automated Testing Suite', desc: 'Custom E2E test suites (Playwright/Cypress) that run before every deploy.', price: 30000 }
            ],
            features: [
                'Real-Time Live WebSockets & Messaging',
                'Custom AI Model / Chatbot Integration',
                'Multi-Tenant SaaS Infrastructure Setup',
                'Offline-First Synchronization (PWA)',
                'Advanced Custom Search Engine Integration',
            ]
        },
        design: {
            basePrice: 85000,
            complexities: [
                { value: 'basic', label: 'Standard Web/App Design (Up to 5 pages)', multiplier: 1.0, desc: 'Straightforward clean landing page or simple multi-page marketing design.' },
                { value: 'advanced', label: 'Multi-Platform System (Up to 15 pages + tokens)', multiplier: 1.4, desc: 'Complete interactive interface design for full web apps and responsive tablet/mobile viewports.' },
                { value: 'enterprise', label: 'Comprehensive App Suite (Web + iOS + Android)', multiplier: 1.9, desc: 'Cross-platform native apps designs, unified Figma design systems, and component libraries.' }
            ],
            addons: [
                { value: 'lottie', label: 'Interactive Lottie & Micro-Animations', desc: 'Custom vector animations for transitions and interactive effects.', price: 15000 },
                { value: 'illustrations', label: 'Custom 3D Rendered Elements & Scenes', desc: 'Bespoke 3D assets to elevate website visuals.', price: 20000 },
                { value: 'abtesting', label: 'UX A/B Testing Variant Assets', desc: 'Alternative screen variations designed for user behavior testing.', price: 25000 }
            ],
            features: [
                'Interactive Micro-Animations & Lottie Assets',
                '3D Rendered Elements & Scene Illustration',
                'Light / Dark Mode Adaptive Design System',
                'Interactive Figma Prototype & User Journeys',
                'Comprehensive Conversion Rate Audit Report',
            ]
        },
        branding: {
            basePrice: 65000,
            complexities: [
                { value: 'basic', label: 'Startup Brand Package (Logo + typography)', multiplier: 1.0, desc: 'Perfect for new ventures needing a fast, professional logo, color palette, and typography.' },
                { value: 'advanced', label: 'Complete Corporate Identity (Logo + full guidelines)', multiplier: 1.5, desc: 'Full branding including print collaterals, pitch deck template, and brand book guidelines.' },
                { value: 'enterprise', label: 'Global Rebrand & Portal (Full identity + web assets portal)', multiplier: 2.0, desc: 'Full brand guidelines, custom stationery designs, and a digital cloud brand assets hub.' }
            ],
            addons: [
                { value: 'stationery', label: 'Stationery, Pitch Decks & Marketing Templates', desc: 'Print-ready business cards, letterheads, and presentations.', price: 15000 },
                { value: 'motion', label: 'Motion Graphics Pack (Animated Logos)', desc: 'Animated logos and video assets for intros and social media.', price: 25000 },
                { value: 'sonic', label: 'Sonic Brand Identity (Bespoke Audio Jingle)', desc: 'Custom sound signature/audio logo for digital content.', price: 30000 }
            ],
            features: [
                'Interactive Brand Guidelines Digital Portal',
                'Custom Bespoke Typography & Logomark Creation',
                'Animated Motion Graphics (Intros, Transitions)',
                'Premium Packaging & Merchandise Mockups',
                'Sonic Brand Identity (Custom Audio Logo/Jingle)',
            ]
        },
        marketing: {
            basePrice: 95000,
            complexities: [
                { value: 'basic', label: 'Local Campaign Booster (Local SEO + 1 channel)', multiplier: 1.0, desc: 'Highly focused local presence boost, search map setup, and primary social campaign.' },
                { value: 'advanced', label: 'Multi-Channel Strategy (SEO + Facebook/Google Ads)', multiplier: 1.5, desc: 'Full organic optimization, keyword bidding, and monthly audience acquisition funnels.' },
                { value: 'enterprise', label: 'Full Funnel Inbound Automation (SEO + email drip + CRM)', multiplier: 2.2, desc: 'End-to-end user growth engines including auto-responders, lead grading, and CRM integrations.' }
            ],
            addons: [
                { value: 'backlinks', label: 'Premium Editorial Backlink Injection', desc: 'Securing premium editorial backlinks to boost search rank.', price: 30000 },
                { value: 'influencer', label: 'Influencer Sourcing & Partnership Management', desc: 'Vetting, contracting, and managing niche micro-influencers.', price: 35000 },
                { value: 'funnel', label: 'Automated CRM & Lead Scoring Funnel Setup', desc: 'Advanced email automation, CRM triggers, and lead grading.', price: 20000 }
            ],
            features: [
                'Automated CRM & Multi-Step Sales Funnel Integration',
                'AI-Powered Competitor Intelligence Tracking',
                'SEO Domination (High-Authority Backlink Engine)',
                'Influencer Partnership Strategy & Matchmaking',
                'Predictive Analytics & Lifetime Value Reporting',
            ]
        }
    };

    function formatCurrency(value) {
        return 'Ksh ' + new Intl.NumberFormat('en-KE', { maximumFractionDigits: 0 }).format(value);
    }

    function renderServiceOptions() {
        const service = serviceSelect.value;
        const config = serviceConfigs[service];
        if (!config) return;

        // Render Complexity options
        complexitySelect.innerHTML = config.complexities.map(c => 
            `<option value="${c.value}" data-multiplier="${c.multiplier}" data-desc="${c.desc}">${c.label}</option>`
        ).join('');
        
        // Render Complexity description
        updateComplexityDescription();

        // Render Addons checkboxes
        const addonsContainer = document.getElementById('addonsContainer');
        addonsContainer.innerHTML = config.addons.map(addon => `
            <div class="col-md-6">
                <div class="form-check border rounded-3 p-3 h-100">
                    <input class="form-check-input addon-check" type="checkbox" value="${addon.value}" id="addon-${addon.value}" data-price="${addon.price}" data-label="${addon.label}">
                    <label class="form-check-label fw-semibold text-wrap text-start" for="addon-${addon.value}">${addon.label}</label>
                    <div class="text-muted small text-start">${addon.desc}</div>
                </div>
            </div>
        `).join('');

        // Re-attach listeners to dynamic add-ons
        addonsContainer.querySelectorAll('.addon-check').forEach(input => {
            input.addEventListener('change', calcEstimate);
        });

        // Render features
        renderFeatures(service);

        // Run calculation
        calcEstimate();
    }

    function updateComplexityDescription() {
        const selectedOption = complexitySelect.options[complexitySelect.selectedIndex];
        const desc = selectedOption ? selectedOption.getAttribute('data-desc') : '';
        document.getElementById('complexityDescription').textContent = desc;
    }

    function renderFeatures(service) {
        const config = serviceConfigs[service];
        const items = config ? config.features : [];
        featureList.innerHTML = items.map((text, idx) => {
            const id = `feature-${service}-${idx}`;
            return `
                <li class="d-flex align-items-start mb-2">
                    <div class="form-check">
                        <input class="form-check-input feature-check" type="checkbox" id="${id}" data-label="${text}" checked>
                        <label class="form-check-label ms-2 text-start" for="${id}">${text}</label>
                    </div>
                </li>
            `;
        }).join('');
        featureList.querySelectorAll('.feature-check').forEach(el => {
            el.addEventListener('change', calcEstimate);
        });
    }

    function getSelectedFeatures() {
        return Array.from(featureList.querySelectorAll('.feature-check'))
            .filter(el => el.checked)
            .map(el => el.getAttribute('data-label'));
    }

    function buildSummary(total, monthly, features, addonTotal, featureAdj, selectedFeatures, checkedAddons) {
        const serviceLabel = serviceSelect.options[serviceSelect.selectedIndex].text;
        const complexityLabel = complexitySelect.options[complexitySelect.selectedIndex]?.text || '';
        const timelineLabel = timelineSelect.options[timelineSelect.selectedIndex].text;
        const addonNames = checkedAddons.map(a => a.getAttribute('data-label'));

        return {
            serviceLabel,
            complexityLabel,
            timelineLabel,
            features,
            selectedFeatures,
            addonNames,
            total,
            monthly,
            addonTotal,
            featureAdj,
        };
    }

    function openPdf(summary) {
        const { serviceLabel, complexityLabel, timelineLabel, features, addonNames, total, monthly, featureAdj, selectedFeatures } = summary;
        const selectedFeatureItems = (selectedFeatures || []).map(f => `<li>${f}</li>`).join('') || '<li>Features will be finalized in scope</li>';
        const selectedAddonItems = (addonNames || []).map(a => `<li>${a}</li>`).join('') || '<li>None selected</li>';

        const html = `
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quote - ${serviceLabel}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body { padding: 32px; font-family: 'Inter', system-ui, -apple-system, sans-serif; }
        .brand { color: #006400; font-weight: 800; letter-spacing: 0.02em; }
        .card { border: 1px solid #e5e7eb; }
        .badge-soft { background: rgba(0, 100, 0, 0.08); color: #004d00; }
    </style>
</head>
<body>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <div class="brand h4 mb-1">Waveron</div>
            <div class="text-muted">Service Quote Summary</div>
        </div>
        <span class="badge badge-soft px-3 py-2 rounded-pill">Draft estimate</span>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div class="text-muted small">Service</div>
                    <div class="fw-semibold">${serviceLabel}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Complexity</div>
                    <div class="fw-semibold">${complexityLabel}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Timeline</div>
                    <div class="fw-semibold">${timelineLabel}</div>
                </div>
            </div>
            <hr>
            <div class="mb-2 d-flex justify-content-between">
                <span>Feature set adjustment</span>
                <span class="text-muted">× ${featureAdj.toFixed(2)}</span>
            </div>
            <div class="mb-2 d-flex justify-content-between">
                <span>Add-ons</span>
                <span class="text-muted">${addonNames.length ? addonNames.join(', ') : 'None'}</span>
            </div>
            <div class="mb-3 d-flex justify-content-between">
                <span>Estimated total</span>
                <span class="h4 text-primary mb-0">${formatCurrency(total)}</span>
            </div>
            <div class="mb-4 d-flex justify-content-between text-muted">
                <span>Est. monthly (6-month engagement)</span>
                <span>${formatCurrency(monthly)}/mo</span>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="fw-semibold mb-2">Example feature coverage</div>
                    <ul class="mb-0 ps-3 text-start">${selectedFeatureItems}</ul>
                </div>
                <div class="col-md-6">
                    <div class="fw-semibold mb-2">Selected add-ons</div>
                    <ul class="mb-0 ps-3 text-start">${selectedAddonItems}</ul>
                </div>
            </div>
            <div class="alert alert-info mt-4 mb-0 small text-start">This estimate is indicative. Final pricing will be confirmed after a scoping call.</div>
        </div>
    </div>
</body>
</html>`;
        const printWindow = window.open('', '_blank');
        if (!printWindow) return;
        printWindow.document.write(html);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    function buildMailto(summary) {
        const { serviceLabel, complexityLabel, timelineLabel, features, addonNames, total, monthly } = summary;
        const body = [
            'Hi Waveron,',
            '',
            'Here is my draft estimate:',
            `Service: ${serviceLabel}`,
            `Complexity: ${complexityLabel}`,
            `Timeline: ${timelineLabel}`,
            `Feature set size: ${features} key features`,
            `Add-ons: ${addonNames.length ? addonNames.join(', ') : 'None'}`,
            `Estimated total: ${formatCurrency(total)}`,
            `Est. monthly (6mo): ${formatCurrency(monthly)}/mo`,
            '',
            'Let’s discuss and refine the scope.',
        ].join('%0A');
        const subject = encodeURIComponent('Quote Request');
        return `mailto:info@waverontechnologies.co.ke?subject=${subject}&body=${body}`;
    }

    function calcEstimate() {
        if(!serviceSelect) return;
        
        const service = serviceSelect.value;
        const config = serviceConfigs[service];
        if (!config) return;

        const selectedOption = complexitySelect.options[complexitySelect.selectedIndex];
        const complexityMultiplier = selectedOption ? parseFloat(selectedOption.getAttribute('data-multiplier')) : 1.0;
        const complexity = complexitySelect.value;

        const timeline = timelineSelect.value;
        const selectedFeatures = getSelectedFeatures();
        const features = selectedFeatures.length || 1;

        featureCountLabel.textContent = `${features} feature${features === 1 ? '' : 's'} selected`;

        const base = config.basePrice;
        const baseline = 5;
        const featureAdj = Math.max(0.7, 1 + ((features - baseline) * 0.06)); // adjust per selected feature, capped floor
        const subtotal = base * complexityMultiplier * timelineMultipliers[timeline] * featureAdj;

        let addonTotal = 0;
        const checkedAddons = Array.from(document.querySelectorAll('.addon-check:checked'));
        checkedAddons.forEach(input => {
            addonTotal += parseFloat(input.getAttribute('data-price')) || 0;
        });

        const total = Math.round(subtotal + addonTotal);
        const monthly = Math.round(total / 6);

        renderBreakdown({ base, complexityMultiplier, timeline, featureAdj, addonTotal, total, monthly });

        const summary = buildSummary(total, monthly, features, addonTotal, featureAdj, selectedFeatures, checkedAddons);
        emailEstimateBtn.onclick = () => {
            window.activeEstimateSummary = summary;
            const modalEl = document.getElementById('emailEstimateModal');
            const modalInstance = new bootstrap.Modal(modalEl);
            modalInstance.show();
        };
        pdfEstimateBtn.onclick = () => openPdf(summary);
    }

    function renderBreakdown({ base, complexityMultiplier, timeline, featureAdj, addonTotal, total, monthly }) {
        const complexityLabel = complexitySelect.options[complexitySelect.selectedIndex]?.text || '';
        const timelineLabels = {
            flexible: 'Flexible timeline x0.90',
            standard: 'Standard timeline x1.00',
            rush: 'Rush timeline x1.25',
        };

        breakdownList.innerHTML = `
            <li class="d-flex justify-content-between mb-2">
                <span>Base for ${serviceSelect.options[serviceSelect.selectedIndex].text}</span>
                <span>${formatCurrency(base)}</span>
            </li>
            <li class="d-flex justify-content-between mb-2 text-muted text-wrap text-end">
                <span>Complexity (${complexityLabel})</span>
                <span>× ${complexityMultiplier}</span>
            </li>
            <li class="d-flex justify-content-between mb-2 text-muted">
                <span>${timelineLabels[timeline]}</span>
                <span>× ${timelineMultipliers[timeline]}</span>
            </li>
            <li class="d-flex justify-content-between mb-3 text-muted">
                <span>Feature set adjustment</span>
                <span>× ${featureAdj.toFixed(2)}</span>
            </li>
            <li class="d-flex justify-content-between mb-1">
                <span>Add-ons</span>
                <span>${formatCurrency(addonTotal)}</span>
            </li>
        `;

        totalDisplay.textContent = formatCurrency(total);
        monthlyDisplay.textContent = `${formatCurrency(monthly)}/mo`;
    }

    if(serviceSelect) {
        serviceSelect.addEventListener('change', renderServiceOptions);
        complexitySelect.addEventListener('change', () => {
            updateComplexityDescription();
            calcEstimate();
        });
        timelineSelect.addEventListener('change', calcEstimate);

        // Initial render
        renderServiceOptions();
    }

    // Handle sending estimate via AJAX
    const sendEstimateSubmitBtn = document.getElementById('sendEstimateSubmitBtn');
    const estimateEmailInput = document.getElementById('estimate-email-input');
    const sendEstimateSpinner = document.getElementById('sendEstimateSpinner');

    sendEstimateSubmitBtn.addEventListener('click', () => {
        const email = estimateEmailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (!email || !emailRegex.test(email)) {
            estimateEmailInput.classList.add('is-invalid');
            return;
        }
        
        estimateEmailInput.classList.remove('is-invalid');
        
        // Show spinner, disable button
        sendEstimateSpinner.classList.remove('d-none');
        sendEstimateSubmitBtn.disabled = true;
        
        // Get CSRF Token
        const csrfToken = document.querySelector('input[name="_token"]').value;

        fetch('{{ route("quote.email-estimate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                summary: window.activeEstimateSummary
            })
        })
        .then(response => response.json())
        .then(data => {
            sendEstimateSpinner.classList.add('d-none');
            sendEstimateSubmitBtn.disabled = false;
            
            if (data.success) {
                // Hide modal
                const modalEl = document.getElementById('emailEstimateModal');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();
                
                // Show a success message
                alert('Estimate successfully sent to ' + email + ' and our sales team!');
                estimateEmailInput.value = '';
            } else {
                alert('Error: ' + (data.message || 'Failed to send estimate email.'));
            }
        })
        .catch(error => {
            sendEstimateSpinner.classList.add('d-none');
            sendEstimateSubmitBtn.disabled = false;
            console.error('Email estimate error:', error);
            alert('An unexpected error occurred. Please try again.');
        });
    });
});
</script>
@endpush
@endsection