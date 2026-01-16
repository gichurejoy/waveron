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
                                        <label class="form-label fw-semibold">Complexity</label>
                                        <select id="complexitySelect" class="form-select">
                                            <option value="basic">Standard (MVP / straightforward)</option>
                                            <option value="advanced">Advanced (integrations, custom workflows)</option>
                                            <option value="enterprise">Enterprise (scalability, security, compliance)</option>
                                        </select>
                                        <div class="text-muted small mt-2">
                                            Standard: simple flows and few integrations. Advanced: multiple roles/flows and custom logic. Enterprise: security/compliance, heavy integrations, and scale.
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
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-check border rounded-3 p-3 h-100">
                                                    <input class="form-check-input" type="checkbox" value="maintenance" id="addonMaintenance">
                                                    <label class="form-check-label fw-semibold" for="addonMaintenance">Maintenance & updates</label>
                                                    <div class="text-muted small">Ongoing fixes, patching, minor enhancements.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check border rounded-3 p-3 h-100">
                                                    <input class="form-check-input" type="checkbox" value="support" id="addonSupport">
                                                    <label class="form-check-label fw-semibold" for="addonSupport">Priority support</label>
                                                    <div class="text-muted small">Faster response times and dedicated contact.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check border rounded-3 p-3 h-100">
                                                    <input class="form-check-input" type="checkbox" value="analytics" id="addonAnalytics">
                                                    <label class="form-check-label fw-semibold" for="addonAnalytics">Analytics setup</label>
                                                    <div class="text-muted small">Tracking, dashboards, and KPI instrumentation.</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check border rounded-3 p-3 h-100">
                                                    <input class="form-check-input" type="checkbox" value="qa" id="addonQa">
                                                    <label class="form-check-label fw-semibold" for="addonQa">QA & usability testing</label>
                                                    <div class="text-muted small">Test plans, regression passes, and usability sessions.</div>
                                                </div>
                                            </div>
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
                                    <span class="h3 fw-bold text-primary" id="totalDisplay">$0</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <span class="text-muted small">Est. monthly (6-month engagement)</span>
                                    <span class="fw-semibold" id="monthlyDisplay">$0</span>
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
                                            <a href="mailto:hello@waveron.com" class="text-decoration-none text-muted">
                                                <i class="bi bi-envelope me-2"></i> hello@waveron.com
                                            </a>
                                            <a href="#" class="text-decoration-none text-muted">
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
                                                    <input type="text" name="budget" class="form-control" placeholder="$25k-$50k">
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

    const addonInputs = [
        document.getElementById('addonMaintenance'),
        document.getElementById('addonSupport'),
        document.getElementById('addonAnalytics'),
        document.getElementById('addonQa'),
    ];

    const basePrices = {
        software: 5000,
        design: 1800,
        branding: 2200,
        marketing: 2000,
    };

    const complexityMultipliers = {
        basic: 1,
        advanced: 1.35,
        enterprise: 1.8,
    };

    const timelineMultipliers = {
        flexible: 0.9,
        standard: 1,
        rush: 1.25,
    };

    const addonPrices = {
        maintenance: 600,
        support: 450,
        analytics: 400,
        qa: 650,
    };

    const serviceFeatures = {
        software: [
            'Responsive web or mobile-ready UI',
            'API integrations (payments, auth, third parties)',
            'Role-based access and security hardening',
            'Analytics + event tracking instrumentation',
            'Scalable deployment pipeline (CI/CD)',
        ],
        design: [
            'Visual identity and design system tokens',
            'High-fidelity UI screens and components',
            'Interactive prototypes for key user journeys',
            'Asset exports and developer handoff specs',
            'Accessibility-conscious color/typography choices',
        ],
        branding: [
            'Logo suite (primary, secondary, marks)',
            'Color, typography, and usage guidelines',
            'Voice/tone and messaging pillars',
            'Brand collateral templates (pitch, socials)',
            'Iconography and illustration direction',
        ],
        marketing: [
            'Campaign planning and channel mix',
            'Landing pages with conversion tracking',
            'SEO/SEM and keyword targeting setup',
            'Email/SMS nurture flows and automation',
            'Reporting dashboards and KPI reviews',
        ],
    };

    function formatCurrency(value) {
        return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD', maximumFractionDigits: 0 }).format(value);
    }

    function renderFeatures(service) {
        const items = serviceFeatures[service] || [];
        featureList.innerHTML = items.map((text, idx) => {
            const id = `feature-${service}-${idx}`;
            return `
                <li class="d-flex align-items-start mb-2">
                    <div class="form-check">
                        <input class="form-check-input feature-check" type="checkbox" id="${id}" data-label="${text}" checked>
                        <label class="form-check-label ms-2" for="${id}">${text}</label>
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

    function buildSummary(total, monthly, features, addonTotal, featureAdj, selectedFeatures) {
        const serviceLabel = serviceSelect.options[serviceSelect.selectedIndex].text;
        const complexityLabel = complexitySelect.options[complexitySelect.selectedIndex].text;
        const timelineLabel = timelineSelect.options[timelineSelect.selectedIndex].text;
        const addonNames = addonInputs.filter(a => a.checked).map(a => a.nextElementSibling?.textContent?.trim() || a.value);

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
                    <ul class="mb-0 ps-3">${selectedFeatureItems}</ul>
                </div>
                <div class="col-md-6">
                    <div class="fw-semibold mb-2">Selected add-ons</div>
                    <ul class="mb-0 ps-3">${addonNames.length ? addonNames.map(a => `<li>${a}</li>`).join('') : '<li>None selected</li>'}</ul>
                </div>
            </div>
            <div class="alert alert-info mt-4 mb-0 small">This estimate is indicative. Final pricing will be confirmed after a scoping call.</div>
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
        return `mailto:joy.gichure@outlook.com?subject=${subject}&body=${body}`;
    }

    function calcEstimate() {
        // Only run if elements exist (e.g. we are on the page)
        if(!serviceSelect) return;
        
        const service = serviceSelect.value;
        const complexity = complexitySelect.value;
        const timeline = timelineSelect.value;
        const selectedFeatures = getSelectedFeatures();
        const features = selectedFeatures.length || 1;

        featureCountLabel.textContent = `${features} feature${features === 1 ? '' : 's'} selected`;

        const base = basePrices[service] || 0;
        const baseline = 5;
        const featureAdj = Math.max(0.7, 1 + ((features - baseline) * 0.06)); // adjust per selected feature, capped floor
        const subtotal = base * complexityMultipliers[complexity] * timelineMultipliers[timeline] * featureAdj;

        let addonTotal = 0;
        addonInputs.forEach(input => {
            if (input.checked) addonTotal += addonPrices[input.value] || 0;
        });

        const total = Math.round(subtotal + addonTotal);
        const monthly = Math.round(total / 6);

        renderBreakdown({ base, complexity, timeline, featureAdj, addonTotal, total, monthly });

        const summary = buildSummary(total, monthly, features, addonTotal, featureAdj, selectedFeatures);
        emailEstimateBtn.onclick = () => {
            window.location.href = buildMailto(summary);
        };
        pdfEstimateBtn.onclick = () => openPdf(summary);
    }

    function renderBreakdown({ base, complexity, timeline, featureAdj, addonTotal, total, monthly }) {
        const complexityLabels = {
            basic: 'Standard x1.00',
            advanced: 'Advanced x1.35',
            enterprise: 'Enterprise x1.80',
        };
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
            <li class="d-flex justify-content-between mb-2 text-muted">
                <span>${complexityLabels[complexitySelect.value]}</span>
                <span>× ${complexityMultipliers[complexitySelect.value]}</span>
            </li>
            <li class="d-flex justify-content-between mb-2 text-muted">
                <span>${timelineLabels[timelineSelect.value]}</span>
                <span>× ${timelineMultipliers[timelineSelect.value]}</span>
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
        [complexitySelect, timelineSelect, ...addonInputs].forEach(el => {
            el.addEventListener('input', calcEstimate);
            el.addEventListener('change', calcEstimate);
        });

        serviceSelect.addEventListener('change', () => {
            renderFeatures(serviceSelect.value);
            calcEstimate();
        });

        renderFeatures(serviceSelect.value);
        calcEstimate();
    }
});
</script>
@endpush
@endsection