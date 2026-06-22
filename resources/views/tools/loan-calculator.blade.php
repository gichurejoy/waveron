@extends('layouts.app')

@section('title', 'Free Loan & Amortization Calculator | Waveron Technologies')
@section('meta_description', 'Calculate loan monthly payments, total interest fees, and amortization schedules. Includes interactive SVG donut charts and printable A4 financial schedules.')

@section('content')
<div class="container-fluid py-4 no-print" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">Loan Calculator</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Left Column: Inputs Form -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-cash-coin me-2"></i> Loan Calculator
                    </h3>

                    <!-- Loan Amount -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Loan Principal Amount (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted font-monospace">KES</span>
                            <input type="number" id="loan-principal" class="form-control" value="500000" min="1" placeholder="e.g. 500,000">
                        </div>
                    </div>

                    <!-- Interest Rate -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Annual Interest Rate (%)</label>
                        <div class="input-group">
                            <input type="number" id="loan-rate" class="form-control" value="12" step="0.1" min="0.1" placeholder="e.g. 12%">
                            <span class="input-group-text bg-light text-muted font-monospace">%</span>
                        </div>
                    </div>

                    <!-- Loan Term -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Loan Term</label>
                        <div class="row g-2">
                            <div class="col-8">
                                <input type="number" id="loan-term-val" class="form-control" value="5" min="1">
                            </div>
                            <div class="col-4">
                                <select id="loan-term-type" class="form-select">
                                    <option value="years">Years</option>
                                    <option value="months">Months</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Logo Upload -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold">Upload Company Logo (For printable schedule)</label>
                        <input type="file" id="company-logo" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- Contextual CTA -->
                <div class="card border-0 rounded-4 p-4 text-center" style="background-color: rgba(21, 128, 61, 0.06); border: 1px solid rgba(21, 128, 61, 0.15) !important;">
                    <h5 class="fw-bold mb-2" style="color: #15803d;">Need Corporate Financing Solutions?</h5>
                    <p class="small mb-3" style="color: #4b5563;">Looking for custom fintech integrations, secure banking APIs, automated invoice factoring modules, or ledger software? Waveron builds premium web systems.</p>
                    <div>
                        <a href="{{ route('contact') }}" class="btn rounded-pill px-4 py-2 fw-semibold btn-sm shadow-sm text-white" style="background-color: #15803d; border: none;">
                            Connect with Finance Techs <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Results & Schedule -->
            <div class="col-lg-7">
                <div class="preview-sticky">
                    <h5 class="text-muted small font-monospace mb-2"><i class="bi bi-eye"></i> LIVE PREVIEW & REPAYMENT SCHEDULE</h5>

                    <!-- A4 Sheet Card -->
                    <div id="loan-preview" class="invoice-paper shadow-sm bg-white p-4 p-md-5 rounded-4 border border-light">
                        
                        <!-- Header / Letterhead -->
                        <div class="d-flex justify-content-between border-bottom pb-4 mb-4 align-items-center">
                            <div class="d-flex align-items-center gap-3">
                                <!-- Logo Container -->
                                <div id="prev-logo-container" class="d-none" style="max-width: 150px; max-height: 70px; overflow: hidden;">
                                    <img id="prev-logo-img" src="" alt="Company Logo" style="max-height: 60px; max-width: 150px; object-fit: contain;">
                                </div>
                                <div id="prev-initials-container" class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold fs-3 text-theme" style="width: 55px; height: 55px; color: #15803d;">
                                    LC
                                </div>
                                <div>
                                    <h4 class="fw-bold mb-0 text-theme" style="color: #15803d;">Loan Repayment Schedule</h4>
                                    <div class="text-muted small">Generated: <span id="report-date">June 22, 2026</span></div>
                                </div>
                            </div>
                            <div class="text-end small text-muted font-monospace" style="max-width: 45%;">
                                <div class="fw-bold text-dark">Waveron Technologies</div>
                                <div>waverontechnologies.co.ke/tools</div>
                            </div>
                        </div>

                        <!-- Summary Cards Row -->
                        <div class="row g-3 mb-4">
                            <div class="col-sm-4">
                                <div class="border rounded-3 p-3 bg-light text-center">
                                    <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size:0.6rem;">Monthly Payment</div>
                                    <h4 class="fw-bold mb-0 text-success" id="prev-monthly-payment">KES 0.00</h4>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded-3 p-3 bg-light text-center">
                                    <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size:0.6rem;">Total Interest</div>
                                    <h4 class="fw-bold mb-0 text-primary" id="prev-total-interest">KES 0.00</h4>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="border rounded-3 p-3 bg-light text-center">
                                    <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size:0.6rem;">Total Payments</div>
                                    <h4 class="fw-bold mb-0 text-dark" id="prev-total-payments">KES 0.00</h4>
                                </div>
                            </div>
                        </div>

                        <!-- Donut Ratio SVG Chart & Stats -->
                        <div class="row g-3 align-items-center mb-4 pb-2 border-bottom">
                            <div class="col-sm-5 text-center">
                                <svg width="120" height="120" id="ratio-donut" style="transform: rotate(-90deg);">
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#e5e7eb" stroke-width="15"></circle>
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#15803d" stroke-width="15" stroke-dasharray="283" stroke-dashoffset="0" id="donut-principal" stroke-linecap="round"></circle>
                                    <circle cx="60" cy="60" r="45" fill="none" stroke="#ca8a04" stroke-width="15" stroke-dasharray="283" stroke-dashoffset="283" id="donut-interest" stroke-linecap="round"></circle>
                                </svg>
                            </div>
                            <div class="col-sm-7 small">
                                <h6 class="fw-bold text-dark font-monospace text-uppercase mb-2" style="font-size: 0.75rem;">Payment Composition</h6>
                                <div class="d-flex align-items-center gap-2 mb-1.5">
                                    <span class="d-inline-block rounded-circle bg-success" style="width:10px; height:10px;"></span>
                                    <span class="text-muted">Principal Paid:</span>
                                    <span class="fw-bold text-dark" id="composition-principal">KES 0.00 (0%)</span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="d-inline-block rounded-circle bg-warning" style="width:10px; height:10px;"></span>
                                    <span class="text-muted">Interest Paid:</span>
                                    <span class="fw-bold text-dark" id="composition-interest">KES 0.00 (0%)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Schedule Table -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-2 text-uppercase font-monospace small">Amortization Table (First 12 Months)</h6>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0" style="font-size:0.75rem;">
                                    <thead>
                                        <tr class="text-muted">
                                            <th>Month</th>
                                            <th>Payment</th>
                                            <th>Principal</th>
                                            <th>Interest</th>
                                            <th class="text-end">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody id="schedule-rows">
                                        <!-- Dynamic monthly breakdown rows -->
                                    </tbody>
                                </table>
                            </div>
                            <div id="schedule-overflow-msg" class="text-center text-muted font-monospace small mt-2 d-none">
                                ... showing first 12 months. Print full report to view all payments.
                            </div>
                        </div>

                        <!-- Disclaimer -->
                        <div class="p-3 bg-light rounded-3 mb-5 border-start border-3 border-secondary text-muted" style="font-size: 0.75rem;">
                            <strong>Disclaimer:</strong> Calculations are based on standard monthly compounding amortization formulas. Actual interest charges may vary depending on financing providers' payment processing rules.
                        </div>

                        <!-- Watermark -->
                        <div class="pt-3 border-top text-end watermark-print" style="border-top: 1px dashed #e5e7eb !important;">
                            <span class="text-muted small" style="font-size: 0.7rem; font-family: monospace;">Generated by <a href="https://waverontechnologies.co.ke/tools" target="_blank" style="text-decoration: none; color: #15803d; font-weight: bold;">waverontechnologies.co.ke/tools</a></span>
                        </div>
                    </div>

                    <!-- Print CTA Button -->
                    <button id="print-schedule-btn" class="btn btn-success w-100 rounded-pill py-2.5 fw-semibold shadow-sm mt-4">
                        <i class="bi bi-printer me-2"></i> Print Full Repayment Schedule
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
    
    .mb-1.5 {
        margin-bottom: 0.35rem !important;
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
            font-size: 9.5pt !important;
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
            page-break-inside: auto;
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
    const principalInput = document.getElementById('loan-principal');
    const rateInput = document.getElementById('loan-rate');
    const termValInput = document.getElementById('loan-term-val');
    const termTypeSelect = document.getElementById('loan-term-type');
    const logoInput = document.getElementById('company-logo');

    const reportDate = document.getElementById('report-date');
    reportDate.innerText = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });

    // Format KES currency
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

    // Run Calculations
    function calculateLoan() {
        const principal = Math.max(1, Number(principalInput.value) || 1);
        const annualRate = Math.max(0.1, Number(rateInput.value) || 0.1);
        const termVal = Math.max(1, Number(termValInput.value) || 1);
        const termType = termTypeSelect.value;

        // Convert term to total months
        const totalMonths = termType === 'years' ? termVal * 12 : termVal;

        // Monthly interest rate
        const monthlyRate = (annualRate / 100) / 12;

        // Calculate monthly payment
        // Formula: P * (r*(1+r)^n) / ((1+r)^n - 1)
        let monthlyPayment = 0;
        if (monthlyRate > 0) {
            monthlyPayment = principal * (monthlyRate * Math.pow(1 + monthlyRate, totalMonths)) / (Math.pow(1 + monthlyRate, totalMonths) - 1);
        } else {
            monthlyPayment = principal / totalMonths;
        }

        const totalPayments = monthlyPayment * totalMonths;
        const totalInterest = totalPayments - principal;

        // Update summary metrics
        document.getElementById('prev-monthly-payment').innerText = formatCurrency(monthlyPayment);
        document.getElementById('prev-total-interest').innerText = formatCurrency(totalInterest);
        document.getElementById('prev-total-payments').innerText = formatCurrency(totalPayments);

        // Composition metrics
        const principalPct = Math.round((principal / totalPayments) * 100);
        const interestPct = 100 - principalPct;
        document.getElementById('composition-principal').innerText = `${formatCurrency(principal)} (${principalPct}%)`;
        document.getElementById('composition-interest').innerText = `${formatCurrency(totalInterest)} (${interestPct}%)`;

        // Update SVG Donut
        const donutPrincipal = document.getElementById('donut-principal');
        const donutInterest = document.getElementById('donut-interest');
        const circumference = 283; // 2 * PI * r = 2 * 3.14159 * 45
        
        const principalOffset = circumference - (principalPct / 100) * circumference;
        donutPrincipal.style.strokeDashoffset = principalOffset;

        donutInterest.style.strokeDasharray = `${circumference}`;
        donutInterest.style.strokeDashoffset = principalOffset; // Starts right where principal ends

        // Build schedule array (Limit screen view to 12 months, but print full schedule)
        buildAmortizationSchedule(principal, monthlyRate, monthlyPayment, totalMonths);
    }

    function buildAmortizationSchedule(principal, monthlyRate, monthlyPayment, totalMonths) {
        const rowsContainer = document.getElementById('schedule-rows');
        rowsContainer.innerHTML = '';

        let remainingBalance = principal;
        let cumulativeInterest = 0;
        
        let printHtml = '';

        // Prepare first 12 rows for screen view
        for (let m = 1; m <= totalMonths; m++) {
            const interestPayment = remainingBalance * monthlyRate;
            const principalPayment = monthlyPayment - interestPayment;
            remainingBalance = Math.max(0, remainingBalance - principalPayment);
            cumulativeInterest += interestPayment;

            const rowHtml = `
                <tr>
                    <td class="font-monospace">Month ${m}</td>
                    <td class="font-monospace">${formatCurrency(monthlyPayment)}</td>
                    <td class="font-monospace">${formatCurrency(principalPayment)}</td>
                    <td class="font-monospace">${formatCurrency(interestPayment)}</td>
                    <td class="font-monospace text-end">${formatCurrency(remainingBalance)}</td>
                </tr>
            `;

            if (m <= 12) {
                const tr = document.createElement('tr');
                tr.innerHTML = rowHtml;
                rowsContainer.appendChild(tr);
            }

            printHtml += rowHtml;
        }

        // Show/hide overflow message
        const overflowMsg = document.getElementById('schedule-overflow-msg');
        if (totalMonths > 12) {
            overflowMsg.classList.remove('d-none');
        } else {
            overflowMsg.classList.add('d-none');
        }

        // Setup print full sheet content
        document.getElementById('print-schedule-btn').onclick = function() {
            const printSheet = document.getElementById('print-sheet');
            
            // Clone the preview element
            const clonedPreview = document.getElementById('loan-preview').cloneNode(true);
            
            // Replace the tbody with the complete full-duration print list
            clonedPreview.querySelector('#schedule-rows').innerHTML = printHtml;
            clonedPreview.querySelector('#schedule-overflow-msg').classList.add('d-none');
            
            printSheet.innerHTML = '';
            printSheet.appendChild(clonedPreview);
            window.print();
        };
    }

    // Event listeners
    principalInput.addEventListener('input', calculateLoan);
    rateInput.addEventListener('input', calculateLoan);
    termValInput.addEventListener('input', calculateLoan);
    termTypeSelect.addEventListener('change', calculateLoan);

    // Initial run
    calculateLoan();
});
</script>
@endpush
