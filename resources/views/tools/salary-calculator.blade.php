@extends('layouts.app')

@section('title', 'Free KRA PAYE & Kenyan Salary Calculator | Waveron Technologies')
@section('meta_description', 'Calculate your net salary in Kenya. Computes exact KRA PAYE tax brackets, NSSF Tier I & II, SHIF (2.75%), and Housing Levy (AHL) deductions.')

@section('content')
<div class="container-fluid py-4 no-print" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">PAYE Calculator</li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <!-- Left Side: Salary Inputs -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h3 class="fw-bold mb-4 text-primary d-flex align-items-center">
                        <i class="bi bi-wallet2 me-2"></i> Salary Inputs
                    </h3>

                    <!-- Basic Inputs -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Basic Monthly Salary (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted fw-semibold">KES</span>
                            <input type="number" id="basic-pay" class="form-control" value="85000" min="0" placeholder="e.g. 85000">
                        </div>
                    </div>

                    <!-- Upload Logo -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Upload Company Logo</label>
                        <input type="file" id="comp-logo" class="form-control" accept="image/*">
                        <div class="form-text small text-muted">Upload a company logo to display on the payslip.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Monthly Allowances / Benefits (KES)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted fw-semibold">KES</span>
                            <input type="number" id="allowances" class="form-control" value="0" min="0" placeholder="e.g. 10000">
                        </div>
                        <div class="form-text small text-muted">Include housing allowances, car benefits, airtime, etc.</div>
                    </div>

                    <!-- Pension Scheme Settings -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2 mt-4">Deduction Details</h5>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">NSSF Contribution</label>
                            <select id="nssf-rate" class="form-select">
                                <option value="new">New NSSF Act 2025/2026 (Max 5,160 KES)</option>
                                <option value="old">Old NSSF Act (Flat 200 KES)</option>
                                <option value="none">Exempt / None</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Housing Levy (AHL)</label>
                            <select id="housing-levy" class="form-select">
                                <option value="yes">Apply Housing Levy (1.5%)</option>
                                <option value="no">Exempt / None</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Social Health Insurance (SHIF)</label>
                            <select id="shif-deduct" class="form-select">
                                <option value="yes">Apply SHIF (2.75%)</option>
                                <option value="no">Exempt / None</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Voluntary Pension Scheme (KES)</label>
                            <input type="number" id="voluntary-pension" class="form-control" value="0" min="0" placeholder="e.g. 5000">
                        </div>
                    </div>

                    <!-- Calculate Button -->
                    <button id="calculate-btn" class="btn btn-primary w-100 rounded-pill py-2.5 fw-semibold shadow-sm">
                        Calculate Deductions & Net Pay
                    </button>
                </div>
            </div>

            <!-- Right Side: Detailed Payslip / KRA Breakdown -->
            <div class="col-lg-6">
                <div class="preview-sticky">
                    <h5 class="text-muted small font-monospace mb-2"><i class="bi bi-file-text"></i> ESTIMATED MONTHLY PAYSLIP</h5>

                    <!-- Payslip Layout -->
                    <div id="payslip-preview" class="payslip-paper shadow-sm bg-white p-4 p-md-5 rounded-4 border border-light">
                        <div class="text-center border-bottom pb-4 mb-4">
                            <div id="prev-logo-container" class="d-none mb-3">
                                <img id="prev-logo-img" src="" alt="Company Logo" class="img-fluid" style="max-height: 90px; max-width: 250px; object-fit: contain; margin: 0 auto; display: block;">
                            </div>
                            <h4 class="fw-bold text-primary mb-1">ESTIMATED PAYSLIP BREAKDOWN</h4>
                            <div class="text-muted small font-monospace">Tax Period: June 2026 (KRA Compliance)</div>
                        </div>

                        <!-- Earnings -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-1 mb-2">1. EARNINGS</h6>
                            <div class="d-flex justify-content-between py-1">
                                <span>Basic Monthly Pay:</span>
                                <span class="fw-semibold text-dark" id="slip-basic-pay">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span>Allowances & Benefits:</span>
                                <span class="fw-semibold text-dark" id="slip-allowances">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 text-dark fw-bold bg-light px-2 rounded-2 mt-1">
                                <span>Gross Pay:</span>
                                <span id="slip-gross-pay">KES 0.00</span>
                            </div>
                        </div>

                        <!-- Pre-tax Deductions -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-1 mb-2">2. DEDUCTIBLES (Pre-Tax)</h6>
                            <div class="d-flex justify-content-between py-1 small">
                                <span>- Tier I Employee NSSF:</span>
                                <span class="fw-semibold text-danger" id="slip-nssf-tier1">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 small">
                                <span>- Tier II Employee NSSF:</span>
                                <span class="fw-semibold text-danger" id="slip-nssf-tier2">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 fw-semibold border-bottom">
                                <span>Total NSSF Deducted:</span>
                                <span class="text-danger" id="slip-nssf-total">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span>SHIF Deductible (2.75%):</span>
                                <span class="fw-semibold text-danger" id="slip-shif-total">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span>Affordable Housing Levy (AHL - 1.5%):</span>
                                <span class="fw-semibold text-danger" id="slip-ahl-total">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom d-none" id="slip-voluntary-row">
                                <span>Voluntary Pension:</span>
                                <span class="fw-semibold text-danger" id="slip-voluntary-pension">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 text-dark fw-bold bg-light px-2 rounded-2 mt-2">
                                <span>TAXABLE PAY:</span>
                                <span id="slip-taxable-income">KES 0.00</span>
                            </div>
                        </div>

                        <!-- Brackets Breakdown -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-1 mb-2">3. INCOME TAX BRACKETS</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm align-middle small text-center mb-0">
                                    <thead>
                                        <tr class="table-light">
                                            <th class="text-start">Income Brackets</th>
                                            <th>Taxable Pay</th>
                                            <th>Rate</th>
                                            <th class="text-end">Tax</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bracket-table-body">
                                        <!-- Populated dynamically via JS -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Taxes (PAYE) Summary -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark border-bottom pb-1 mb-2">4. PAYE SUMMARY</h6>
                            <div class="d-flex justify-content-between py-1">
                                <span>PAYE Tax (Before Relief):</span>
                                <span class="fw-semibold text-danger" id="slip-paye-before-relief">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-1 border-bottom">
                                <span>Monthly Personal Relief:</span>
                                <span class="fw-semibold text-success" id="slip-personal-relief">KES 0.00</span>
                            </div>
                            <div class="d-flex justify-content-between py-2 text-dark fw-bold border-bottom">
                                <span>Net PAYE Tax Deducted:</span>
                                <span class="text-danger" id="slip-net-paye">KES 0.00</span>
                            </div>
                        </div>

                        <!-- Net Pay -->
                        <div class="p-3 bg-success bg-opacity-10 border border-success border-opacity-25 rounded-3 d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-dark fs-5">NET Monthly Salary:</span>
                            <span class="fw-bold text-success fs-4" id="slip-net-take-home">KES 0.00</span>
                        </div>

                        <!-- Actions -->
                        <button id="print-payslip" class="btn btn-outline-primary w-100 rounded-pill py-2 fw-semibold mb-3">
                            <i class="bi bi-printer me-2"></i> Print / Save Calculations
                        </button>

                        <!-- Watermark -->
                        <div class="pt-3 border-top text-center watermark-print" style="border-top: 1px dashed #e5e7eb !important;">
                            <span class="text-muted small" style="font-size: 0.7rem; font-family: monospace;">Generated by <a href="https://waverontechnologies.co.ke/tools" target="_blank" style="text-decoration: none; color: #15803d; font-weight: bold;">waverontechnologies.co.ke/tools</a></span>
                        </div>
                    </div>

                    <!-- Contextual Lead Capture CTA -->
                    <div class="card border-0 rounded-4 p-4 mt-4 text-center" style="background-color: rgba(21, 128, 61, 0.06); border: 1px solid rgba(21, 128, 61, 0.15) !important;">
                        <h5 class="fw-bold mb-2" style="color: #15803d;">Automate Your Company Payroll</h5>
                        <p class="small mb-3" style="color: #4b5563;">Tired of managing employees' payslips manually? Waveron builds custom HR, timesheet, and payroll ERP integrations customized for Kenyan SMEs.</p>
                        <div>
                            <a href="{{ route('contact') }}" class="btn rounded-pill px-4 py-2 fw-semibold btn-sm shadow-sm text-white" style="background-color: #15803d; border: none;">
                                Request Payroll System Demo <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print-Only Page (Visible only in Print dialog) -->
<div id="print-payslip-sheet" class="print-only">
    <!-- Copy of payslip-preview will be loaded here dynamically via JS during print -->
</div>

@include('partials.footer')
@endsection

@push('styles')
<style>
    /* Sticky preview sidebar for desktop */
    @media (min-width: 992px) {
        .preview-sticky {
            position: sticky;
            top: 96px;
        }
    }

    @page {
        size: auto;
        margin: 12mm;
    }

    /* Print stylesheet settings */
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
        .payslip-paper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            page-break-inside: avoid;
            break-inside: avoid;
        }
        .watermark-print {
            position: fixed !important;
            bottom: 12mm !important;
            left: 12mm !important;
            right: 12mm !important;
            border-top: 1px dashed #e5e7eb !important;
            background-color: white !important;
            padding-top: 8px !important;
            text-align: center !important;
            z-index: 9999 !important;
        }
        /* Tighten spacing for print to fit on one page */
        .payslip-paper h4, .payslip-paper h5 {
            margin-top: 5px !important;
            margin-bottom: 5px !important;
        }
        .payslip-paper .border-bottom {
            padding-bottom: 8px !important;
            margin-bottom: 8px !important;
        }
        .payslip-paper table {
            margin-bottom: 8px !important;
        }
        .payslip-paper th, .payslip-paper td {
            padding: 3px 6px !important;
        }
        .payslip-paper .mb-4 {
            margin-bottom: 8px !important;
        }
        .payslip-paper .mt-4 {
            margin-top: 8px !important;
        }
        .payslip-paper .p-3 {
            padding: 8px !important;
            margin-bottom: 8px !important;
        }
    }

    .print-only {
        display: none;
    }

    /* Payslip paper layout */
    .payslip-paper {
        border: 1px solid #eee;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const basicPayInput = document.getElementById('basic-pay');
    const allowancesInput = document.getElementById('allowances');
    const nssfRateSelect = document.getElementById('nssf-rate');
    const housingLevySelect = document.getElementById('housing-levy');
    const shifDeductSelect = document.getElementById('shif-deduct');
    const voluntaryPensionInput = document.getElementById('voluntary-pension');
    const compLogoInput = document.getElementById('comp-logo');
    const calculateBtn = document.getElementById('calculate-btn');
    
    // Logo elements
    const prevLogoContainer = document.getElementById('prev-logo-container');
    const prevLogoImg = document.getElementById('prev-logo-img');
    
    // Payslip output elements
    const slipBasicPay = document.getElementById('slip-basic-pay');
    const slipAllowances = document.getElementById('slip-allowances');
    const slipGrossPay = document.getElementById('slip-gross-pay');
    
    const slipNssfTier1 = document.getElementById('slip-nssf-tier1');
    const slipNssfTier2 = document.getElementById('slip-nssf-tier2');
    const slipNssfTotal = document.getElementById('slip-nssf-total');
    const slipShifTotal = document.getElementById('slip-shif-total');
    const slipAhlTotal = document.getElementById('slip-ahl-total');
    
    const slipVoluntaryRow = document.getElementById('slip-voluntary-row');
    const slipVoluntaryPension = document.getElementById('slip-voluntary-pension');
    
    const slipTaxableIncome = document.getElementById('slip-taxable-income');
    const slipPayeBeforeRelief = document.getElementById('slip-paye-before-relief');
    const slipPersonalRelief = document.getElementById('slip-personal-relief');
    const slipNetPaye = document.getElementById('slip-net-paye');
    const slipNetTakeHome = document.getElementById('slip-net-take-home');
    const bracketTableBody = document.getElementById('bracket-table-body');
    
    const printBtn = document.getElementById('print-payslip');

    function formatMoney(amount) {
        return 'KES ' + Number(amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function runCalculations() {
        const basicPay = Number(basicPayInput.value) || 0;
        const allowances = Number(allowancesInput.value) || 0;
        const grossPay = basicPay + allowances;
        
        // 1. Calculate NSSF 2025/2026 limits:
        // Tier I Lower Limit: 9,000 KES (Max 540)
        // Tier II Upper Limit: 86,000 KES (Max 4,620)
        let nssfTier1 = 0;
        let nssfTier2 = 0;
        
        const nssfRate = nssfRateSelect.value;
        if (nssfRate === 'new') {
            if (grossPay >= 9000) {
                nssfTier1 = 540;
                let tier2Payable = Math.min(grossPay, 86000) - 9000;
                nssfTier2 = tier2Payable * 0.06;
            } else {
                nssfTier1 = grossPay * 0.06;
                nssfTier2 = 0;
            }
        } else if (nssfRate === 'old') {
            nssfTier1 = grossPay >= 2000 ? 200 : grossPay * 0.1;
            nssfTier2 = 0;
        }
        const totalNssf = nssfTier1 + nssfTier2;
        
        // 2. Calculate Housing Levy (AHL - 1.5% of Gross) - Pre-tax Deductible
        let housingLevy = 0;
        if (housingLevySelect.value === 'yes') {
            housingLevy = grossPay * 0.015;
        }
        
        // 3. Calculate SHIF (2.75% of Gross) - Pre-tax Deductible
        let shif = 0;
        if (shifDeductSelect.value === 'yes') {
            shif = grossPay * 0.0275;
        }
        
        // 4. Calculate Voluntary Pension (Pre-tax deductible up to 30,000 KES)
        const voluntaryPension = Number(voluntaryPensionInput.value) || 0;
        const taxExemptPension = Math.min(voluntaryPension, 30000);
        
        // 5. Calculate Taxable Income (Gross - NSSF - SHIF - AHL - Voluntary Pension)
        const taxableIncome = Math.max(0, grossPay - totalNssf - shif - housingLevy - taxExemptPension);
        
        // 6. Calculate Bracket Breakdown
        // KRA Tax Bands 2025/2026:
        // Band 1: Up to 24,000 -> 10%
        // Band 2: Next 8,333.33 (24,000 to 32,333.33) -> 25%
        // Band 3: Next 467,666.67 (32,333.33 to 500,000) -> 30%
        // Band 4: Next 300,000 (500,000 to 800,000) -> 32.5%
        // Band 5: Above 800,000 -> 35%
        const brackets = [
            { label: 'Kshs 0 - Kshs 24,000.00', size: 24000, rate: 0.10 },
            { label: 'Kshs 24,000.00 - Kshs 32,333.33', size: 8333.33, rate: 0.25 },
            { label: 'Kshs 32,333.33 - Kshs 499,999.99', size: 467666.67, rate: 0.30 },
            { label: 'Kshs 500,000.00 - Kshs 799,999.99', size: 300000.00, rate: 0.325 },
            { label: 'Kshs 800,000.00 and above', size: Infinity, rate: 0.35 }
        ];
        
        let remaining = taxableIncome;
        let payeBeforeRelief = 0;
        let tbodyHtml = '';
        
        brackets.forEach(function(b) {
            let payInBracket = 0;
            if (remaining > 0) {
                if (b.size === Infinity) {
                    payInBracket = remaining;
                } else {
                    payInBracket = Math.min(remaining, b.size);
                }
                remaining -= payInBracket;
            }
            
            let taxInBracket = payInBracket * b.rate;
            payeBeforeRelief += taxInBracket;
            
            tbodyHtml += `
                <tr>
                    <td class="text-start">${b.label}</td>
                    <td>KES ${payInBracket.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                    <td>${(b.rate * 100).toFixed(1).replace('.0', '')}%</td>
                    <td class="text-end fw-semibold">KES ${taxInBracket.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                </tr>
            `;
        });
        bracketTableBody.innerHTML = tbodyHtml;
        
        // 7. Calculate Reliefs
        const personalRelief = taxableIncome > 0 ? 2400 : 0;
        
        // Net PAYE
        let netPaye = Math.max(0, payeBeforeRelief - personalRelief);
        
        // 8. Net Take Home Pay
        const totalDeductions = totalNssf + housingLevy + shif + voluntaryPension + netPaye;
        const netTakeHome = grossPay - totalDeductions;
        
        // Render Output fields
        slipBasicPay.innerText = formatMoney(basicPay);
        slipAllowances.innerText = formatMoney(allowances);
        slipGrossPay.innerText = formatMoney(grossPay);
        
        slipNssfTier1.innerText = formatMoney(nssfTier1);
        slipNssfTier2.innerText = formatMoney(nssfTier2);
        slipNssfTotal.innerText = `-${formatMoney(totalNssf)}`;
        slipShifTotal.innerText = `-${formatMoney(shif)}`;
        slipAhlTotal.innerText = `-${formatMoney(housingLevy)}`;
        
        if (voluntaryPension > 0) {
            slipVoluntaryRow.classList.remove('d-none');
            slipVoluntaryPension.innerText = `-${formatMoney(voluntaryPension)}`;
        } else {
            slipVoluntaryRow.classList.add('d-none');
        }
        
        slipTaxableIncome.innerText = formatMoney(taxableIncome);
        slipPayeBeforeRelief.innerText = `-${formatMoney(payeBeforeRelief)}`;
        slipPersonalRelief.innerText = `+${formatMoney(personalRelief)}`;
        
        slipNetPaye.innerText = `-${formatMoney(netPaye)}`;
        slipNetTakeHome.innerText = formatMoney(netTakeHome);
    }

    // Bind logo upload FileReader
    compLogoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                prevLogoImg.src = event.target.result;
                prevLogoContainer.classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        } else {
            prevLogoImg.src = '';
            prevLogoContainer.classList.add('d-none');
        }
    });

    // Bind calculate action
    calculateBtn.addEventListener('click', runCalculations);
    
    // Print action
    printBtn.addEventListener('click', function() {
        const printSheet = document.getElementById('print-payslip-sheet');
        printSheet.innerHTML = document.getElementById('payslip-preview').outerHTML;
        window.print();
    });

    // Run initial calculation
    runCalculations();
});
</script>
@endpush
