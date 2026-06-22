@extends('layouts.app')

@section('title', 'Free Break-Even Point Calculator | Waveron Technologies')
@section('meta_description', 'Calculate your business break-even point in units and sales revenue in real-time. Features interactive SVG financial charts and printable A4 business reports.')

@section('content')
<div class="container-fluid py-4 no-print" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">Break-Even Calculator</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Left Side: Inputs Form -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-graph-up-arrow me-2"></i> Break-Even Calculator
                    </h3>

                    <!-- Fixed Costs Input -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Total Fixed Costs (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted font-monospace">KES</span>
                            <input type="number" id="fixed-costs" class="form-control" value="120000" min="0" placeholder="e.g. Rent, Salaries, Insurance">
                        </div>
                        <div class="form-text small text-muted">Expenses that do not change regardless of production volume.</div>
                    </div>

                    <!-- Selling Price Per Unit -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Selling Price Per Unit (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted font-monospace">KES</span>
                            <input type="number" id="unit-price" class="form-control" value="500" min="1" placeholder="e.g. Price customers pay per unit">
                        </div>
                    </div>

                    <!-- Variable Cost Per Unit -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Variable Cost Per Unit (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted font-monospace">KES</span>
                            <input type="number" id="unit-variable" class="form-control" value="200" min="0" placeholder="e.g. Raw materials, Direct labor">
                        </div>
                        <div class="form-text small text-muted">Costs that vary directly with the production of each unit.</div>
                    </div>

                    <!-- Optional Target Profit -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Target Profit (KES) - Optional</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted font-monospace">KES</span>
                            <input type="number" id="target-profit" class="form-control" value="60000" min="0" placeholder="e.g. Desired monthly profit">
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Upload Company Logo (For printable report)</label>
                        <input type="file" id="company-logo" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- Contextual CTA -->
                <div class="card border-0 rounded-4 p-4 text-center" style="background-color: rgba(21, 128, 61, 0.06); border: 1px solid rgba(21, 128, 61, 0.15) !important;">
                    <h5 class="fw-bold mb-2" style="color: #15803d;">Ready to Scale Operations?</h5>
                    <p class="small mb-3" style="color: #4b5563;">Struggling with financial forecasting and cost tracking? Waveron builds custom enterprise dashboard integrations, analytics portals, and bookkeeping software for Kenyan SMEs.</p>
                    <div>
                        <a href="{{ route('contact') }}" class="btn rounded-pill px-4 py-2 fw-semibold btn-sm shadow-sm text-white" style="background-color: #15803d; border: none;">
                            Get Custom Dashboard Demo <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Live Analysis Report & Chart -->
            <div class="col-lg-7">
                <div class="preview-sticky">
                    <h5 class="text-muted small font-monospace mb-2"><i class="bi bi-eye"></i> LIVE PREVIEW & VISUAL ANALYSIS</h5>

                    <!-- A4 Sheet Card -->
                    <div id="break-even-preview" class="invoice-paper shadow-sm bg-white p-4 p-md-5 rounded-4 border border-light">
                        
                        <!-- Report Letterhead Header -->
                        <div class="d-flex justify-content-between border-bottom pb-4 mb-4 align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Logo Container -->
                                <div id="prev-logo-container" class="d-none" style="max-width: 150px; max-height: 70px; overflow: hidden;">
                                    <img id="prev-logo-img" src="" alt="Company Logo" style="max-height: 60px; max-width: 150px; object-fit: contain;">
                                </div>
                                <div id="prev-initials-container" class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold fs-3 text-theme" style="width: 55px; height: 55px; color: #15803d;">
                                    BE
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-theme" style="color: #15803d;">Break-Even Analysis</h4>
                                    <div class="text-muted small">Generated on: <span id="report-date">June 22, 2026</span></div>
                                </div>
                            </div>
                            <div class="text-end small text-muted font-monospace" style="max-width: 45%;">
                                <div class="fw-bold text-dark">Waveron Technologies</div>
                                <div>waverontechnologies.co.ke/tools</div>
                            </div>
                        </div>

                        <!-- Summary Cards Row -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="border rounded-3 p-3 bg-light text-center">
                                    <div class="text-muted small fw-bold text-uppercase mb-1">Break-Even Point (Units)</div>
                                    <h2 class="fw-bold mb-0 text-success" id="prev-be-units">0</h2>
                                    <small class="text-muted font-monospace" id="prev-unit-desc">Units sold</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border rounded-3 p-3 bg-light text-center">
                                    <div class="text-muted small fw-bold text-uppercase mb-1">Break-Even Sales (Revenue)</div>
                                    <h2 class="fw-bold mb-0 text-primary" id="prev-be-revenue">KES 0.00</h2>
                                    <small class="text-muted font-monospace" id="prev-revenue-desc">Total sales amount</small>
                                </div>
                            </div>
                        </div>

                        <!-- Dynamic Cost & Revenue Chart SVG -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-2 text-uppercase font-monospace small"><i class="bi bi-graph-up"></i> Cost vs Revenue Trend Chart</h6>
                            <div class="border rounded-3 p-3 bg-light d-flex justify-content-center align-items-center" style="position: relative; min-height: 250px;">
                                <svg id="chart-svg" width="100%" height="220" viewBox="0 0 400 220" style="overflow: visible; font-family: monospace; font-size: 8px;">
                                    <!-- Dynamic elements will be injected here via JS -->
                                </svg>
                            </div>
                        </div>

                        <!-- Key Metrics Breakdown List -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-1 mb-3 text-uppercase font-monospace small">Metrics Breakdown</h6>
                            
                            <div class="d-flex justify-content-between py-1.5 border-bottom small">
                                <span class="text-muted">Contribution Margin Per Unit:</span>
                                <span class="fw-bold text-dark" id="prev-margin-unit">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1.5 border-bottom small">
                                <span class="text-muted">Contribution Margin Ratio:</span>
                                <span class="fw-bold text-dark" id="prev-margin-ratio">0.0%</span>
                            </div>
                            <div class="d-flex justify-content-between py-1.5 border-bottom small" id="target-profit-unit-row">
                                <span class="text-muted">Units Required for Target Profit:</span>
                                <span class="fw-bold text-dark" id="prev-target-units">0 Units</span>
                            </div>
                            <div class="d-flex justify-content-between py-1.5 border-bottom small" id="target-profit-sales-row">
                                <span class="text-muted">Sales Revenue for Target Profit:</span>
                                <span class="fw-bold text-dark" id="prev-target-revenue">KES 0.00</span>
                            </div>
                        </div>

                        <!-- Disclaimer / Notes -->
                        <div class="p-3 bg-light rounded-3 mb-5 border-start border-3 border-secondary text-muted" style="font-size: 0.75rem;">
                            <strong>Note:</strong> Variable costs per unit are assumed to be constant. Selling price is assumed to remain constant across all sales volume bands. Amortization is factored into fixed expenses.
                        </div>

                        <!-- Watermark -->
                        <div class="pt-3 border-top text-end watermark-print" style="border-top: 1px dashed #e5e7eb !important;">
                            <span class="text-muted small" style="font-size: 0.7rem; font-family: monospace;">Generated by <a href="https://waverontechnologies.co.ke/tools" target="_blank" style="text-decoration: none; color: #15803d; font-weight: bold;">waverontechnologies.co.ke/tools</a></span>
                        </div>
                    </div>

                    <!-- Print CTA Button -->
                    <button id="print-report-btn" class="btn btn-success w-100 rounded-pill py-2.5 fw-semibold shadow-sm mt-4">
                        <i class="bi bi-printer me-2"></i> Print / Save Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print-Only Page Wrapper -->
<div id="print-sheet" class="print-only"></div>
@endsection

@push('styles')
<style>
    .preview-sticky {
        position: sticky;
        top: 96px;
    }

    .invoice-paper {
        position: relative !important;
        padding-bottom: 60px !important;
    }

    .invoice-paper .watermark-print {
        position: absolute !important;
        bottom: 20px !important;
        left: 48px !important;
        right: 48px !important;
    }

    .text-theme {
        transition: color 0.2s ease;
    }

    @page {
        size: auto;
        margin: 12mm;
    }

    /* Print media styling */
    @media print {
        body {
            background-color: white !important;
            color: black !important;
            font-size: 10.5pt !important;
            margin: 0 !important;
            padding: 0 !important;
            padding-bottom: 20mm !important;
            width: 100% !important;
            max-width: 100% !important;
            zoom: 1 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .no-print, header, footer, .navbar, .navbar-spacer, #navbarNav, .navbar-toggler, .tools-hero, .btn, .card, .AI-widget, #AI-chatbot-widget {
            display: none !important;
        }
        .print-only {
            display: block !important;
            width: 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .invoice-paper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            page-break-inside: avoid;
            break-inside: avoid;
            min-height: 0 !important;
            padding-bottom: 0 !important;
        }
        .watermark-print {
            position: fixed !important;
            bottom: 12mm !important;
            left: 12mm !important;
            right: 12mm !important;
            border-top: 1px dashed #e5e7eb !important;
            background-color: white !important;
            padding-top: 8px !important;
            text-align: right !important;
            z-index: 9999 !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const fixedCostsInput = document.getElementById('fixed-costs');
    const unitPriceInput = document.getElementById('unit-price');
    const unitVariableInput = document.getElementById('unit-variable');
    const targetProfitInput = document.getElementById('target-profit');
    const logoInput = document.getElementById('company-logo');

    const reportDate = document.getElementById('report-date');
    reportDate.innerText = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

    // Format numbers as KES currency
    function formatCurrency(val) {
        return 'KES ' + Number(val).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Logo upload
    logoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('prev-logo-img').src = evt.target.result;
                document.getElementById('prev-logo-container').classList.remove('d-none');
                document.getElementById('prev-initials-container').classList.add('d-none');
            }
            reader.readAsDataURL(file);
        }
    });

    // Calculations & Chart updates
    function updateAnalysis() {
        const fixedCosts = Math.max(0, Number(fixedCostsInput.value) || 0);
        const unitPrice = Math.max(1, Number(unitPriceInput.value) || 1);
        const variableCost = Math.max(0, Number(unitVariableInput.value) || 0);
        const targetProfit = Math.max(0, Number(targetProfitInput.value) || 0);

        // Calculate contribution margin
        const contributionMargin = unitPrice - variableCost;
        let contributionRatio = 0;
        if (unitPrice > 0) {
            contributionRatio = contributionMargin / unitPrice;
        }

        // Calculations for break-even
        let beUnits = 0;
        let beRevenue = 0;
        if (contributionMargin > 0) {
            beUnits = Math.ceil(fixedCosts / contributionMargin);
            beRevenue = beUnits * unitPrice;
        }

        // Target profit units
        let targetUnits = 0;
        let targetRevenue = 0;
        if (contributionMargin > 0) {
            targetUnits = Math.ceil((fixedCosts + targetProfit) / contributionMargin);
            targetRevenue = targetUnits * unitPrice;
        }

        // Set values in document
        document.getElementById('prev-be-units').innerText = beUnits.toLocaleString();
        document.getElementById('prev-be-revenue').innerText = formatCurrency(beRevenue);
        document.getElementById('prev-margin-unit').innerText = formatCurrency(contributionMargin);
        document.getElementById('prev-margin-ratio').innerText = (contributionRatio * 100).toFixed(1) + '%';

        const targetUnitsRow = document.getElementById('target-profit-unit-row');
        const targetRevenueRow = document.getElementById('target-profit-sales-row');
        
        if (targetProfit > 0 && contributionMargin > 0) {
            targetUnitsRow.classList.remove('d-none');
            targetRevenueRow.classList.remove('d-none');
            document.getElementById('prev-target-units').innerText = targetUnits.toLocaleString() + ' Units';
            document.getElementById('prev-target-revenue').innerText = formatCurrency(targetRevenue);
        } else {
            targetUnitsRow.classList.add('d-none');
            targetRevenueRow.classList.add('d-none');
        }

        // Render dynamic SVG Chart
        renderChart(fixedCosts, unitPrice, variableCost, beUnits, targetUnits, targetProfit);
    }

    function renderChart(fixedCosts, price, variable, beUnits, targetUnits, targetProfit) {
        const svg = document.getElementById('chart-svg');
        svg.innerHTML = ''; // clear

        // Determine max units to plot
        const maxUnits = Math.max(10, (targetProfit > 0 ? targetUnits : beUnits) * 1.5);
        const maxCostRevenue = Math.max(1000, maxUnits * price);

        const width = 340;
        const height = 180;
        const padding = { left: 45, right: 15, top: 15, bottom: 25 };

        // Helper to convert units & currency to SVG coordinates
        function getX(units) {
            return padding.left + (units / maxUnits) * (width - padding.left - padding.right);
        }
        function getY(value) {
            return height - padding.bottom - (value / maxCostRevenue) * (height - padding.top - padding.bottom);
        }

        // Add Grid Lines & Labels (Y Axis)
        for (let i = 0; i <= 4; i++) {
            const val = (maxCostRevenue / 4) * i;
            const y = getY(val);
            // Grid line
            const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            line.setAttribute('x1', padding.left);
            line.setAttribute('y1', y);
            line.setAttribute('x2', width - padding.right);
            line.setAttribute('y2', y);
            line.setAttribute('stroke', '#e5e7eb');
            line.setAttribute('stroke-dasharray', '2,2');
            svg.appendChild(line);

            // Label
            const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            text.setAttribute('x', padding.left - 5);
            text.setAttribute('y', y + 3);
            text.setAttribute('text-anchor', 'end');
            text.setAttribute('fill', '#9ca3af');
            text.textContent = val >= 1000 ? (val / 1000).toFixed(0) + 'k' : val.toFixed(0);
            svg.appendChild(text);
        }

        // Add Grid Lines & Labels (X Axis)
        for (let i = 0; i <= 4; i++) {
            const units = (maxUnits / 4) * i;
            const x = getX(units);
            // Grid line
            const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            line.setAttribute('x1', x);
            line.setAttribute('y1', padding.top);
            line.setAttribute('x2', x);
            line.setAttribute('y2', height - padding.bottom);
            line.setAttribute('stroke', '#e5e7eb');
            line.setAttribute('stroke-dasharray', '2,2');
            svg.appendChild(line);

            // Label
            const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            text.setAttribute('x', x);
            text.setAttribute('y', height - padding.bottom + 12);
            text.setAttribute('text-anchor', 'middle');
            text.setAttribute('fill', '#9ca3af');
            text.textContent = Math.round(units).toLocaleString();
            svg.appendChild(text);
        }

        // Draw Axes lines
        const xAxis = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        xAxis.setAttribute('x1', padding.left);
        xAxis.setAttribute('y1', height - padding.bottom);
        xAxis.setAttribute('x2', width - padding.right);
        xAxis.setAttribute('y2', height - padding.bottom);
        xAxis.setAttribute('stroke', '#9ca3af');
        svg.appendChild(xAxis);

        const yAxis = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        yAxis.setAttribute('x1', padding.left);
        yAxis.setAttribute('y1', padding.top);
        yAxis.setAttribute('x2', padding.left);
        yAxis.setAttribute('y2', height - padding.bottom);
        yAxis.setAttribute('stroke', '#9ca3af');
        svg.appendChild(yAxis);

        // 1. Fixed Cost line (Horizontal line)
        const fcLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        fcLine.setAttribute('x1', padding.left);
        fcLine.setAttribute('y1', getY(fixedCosts));
        fcLine.setAttribute('x2', width - padding.right);
        fcLine.setAttribute('y2', getY(fixedCosts));
        fcLine.setAttribute('stroke', '#6b7280');
        fcLine.setAttribute('stroke-width', '1.5');
        fcLine.setAttribute('stroke-dasharray', '4,4');
        svg.appendChild(fcLine);

        // Label FC
        const fcText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        fcText.setAttribute('x', width - padding.right - 2);
        fcText.setAttribute('y', getY(fixedCosts) - 4);
        fcText.setAttribute('text-anchor', 'end');
        fcText.setAttribute('fill', '#6b7280');
        fcText.textContent = 'Fixed Costs';
        svg.appendChild(fcText);

        // 2. Total Cost line (starts at Fixed Cost and grows by variable cost)
        const tcStart = { x: getX(0), y: getY(fixedCosts) };
        const tcEnd = { x: getX(maxUnits), y: getY(fixedCosts + maxUnits * variable) };
        const tcLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        tcLine.setAttribute('x1', tcStart.x);
        tcLine.setAttribute('y1', tcStart.y);
        tcLine.setAttribute('x2', tcEnd.x);
        tcLine.setAttribute('y2', tcEnd.y);
        tcLine.setAttribute('stroke', '#ef4444');
        tcLine.setAttribute('stroke-width', '2');
        svg.appendChild(tcLine);

        // Label TC
        const tcText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        tcText.setAttribute('x', tcEnd.x - 2);
        tcText.setAttribute('y', tcEnd.y - 4);
        tcText.setAttribute('text-anchor', 'end');
        tcText.setAttribute('fill', '#ef4444');
        tcText.textContent = 'Total Costs';
        svg.appendChild(tcText);

        // 3. Sales Revenue line (starts at 0 and grows by Price)
        const revStart = { x: getX(0), y: getY(0) };
        const revEnd = { x: getX(maxUnits), y: getY(maxUnits * price) };
        const revLine = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        revLine.setAttribute('x1', revStart.x);
        revLine.setAttribute('y1', revStart.y);
        revLine.setAttribute('x2', revEnd.x);
        revLine.setAttribute('y2', revEnd.y);
        revLine.setAttribute('stroke', '#10b981');
        revLine.setAttribute('stroke-width', '2');
        svg.appendChild(revLine);

        // Label Rev
        const revText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        revText.setAttribute('x', revEnd.x - 2);
        revText.setAttribute('y', revEnd.y - 4);
        revText.setAttribute('text-anchor', 'end');
        revText.setAttribute('fill', '#10b981');
        revText.textContent = 'Total Revenue';
        svg.appendChild(revText);

        // 4. Draw Break-Even point marker
        if (price > variable && fixedCosts > 0 && beUnits <= maxUnits) {
            const beX = getX(beUnits);
            const beY = getY(beUnits * price);

            const point = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            point.setAttribute('cx', beX);
            point.setAttribute('cy', beY);
            point.setAttribute('r', '5');
            point.setAttribute('fill', '#15803d');
            point.setAttribute('stroke', 'white');
            point.setAttribute('stroke-width', '1.5');
            svg.appendChild(point);

            // Label Break-Even Point
            const ptText = document.createElementNS('http://www.w3.org/2000/svg', 'text');
            ptText.setAttribute('x', beX + 8);
            ptText.setAttribute('y', beY - 2);
            ptText.setAttribute('fill', '#15803d');
            ptText.setAttribute('font-weight', 'bold');
            ptText.textContent = 'BEP (' + Math.round(beUnits) + ')';
            svg.appendChild(ptText);
        }
    }

    // Attach listeners
    fixedCostsInput.addEventListener('input', updateAnalysis);
    unitPriceInput.addEventListener('input', updateAnalysis);
    unitVariableInput.addEventListener('input', updateAnalysis);
    targetProfitInput.addEventListener('input', updateAnalysis);

    // Run first calculation
    updateAnalysis();

    // Print logic
    document.getElementById('print-report-btn').addEventListener('click', function() {
        const printSheet = document.getElementById('print-sheet');
        printSheet.innerHTML = document.getElementById('break-even-preview').outerHTML;
        window.print();
    });
});
</script>
@endpush
