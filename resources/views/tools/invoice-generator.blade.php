@extends('layouts.app')

@section('title', 'Free Invoice & Quotation Generator | Waveron Technologies')
@section('meta_description', 'Create professional PDF invoices and quotations online. Free, fast, and no registration required.')

@section('content')
<div class="container-fluid py-4 no-print" style="background-color: #fafafa;">
    <div class="container">
        <!-- Breadcrumb & Header -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('tools.index') }}" class="text-muted text-decoration-none">Tools</a></li>
                <li class="breadcrumb-item active text-success fw-bold" aria-current="page">Invoice Generator</li>
            </ol>
        </nav>
        
        <div class="row g-4">
            <!-- Left Side: Inputs -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm rounded-4 p-4 mb-4">
                    <h3 class="fw-bold mb-4 text-success d-flex align-items-center">
                        <i class="bi bi-file-earmark-plus-fill me-2"></i> Invoice Details
                    </h3>

                    <!-- Business Details -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">Your Business Details</h5>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Company Name</label>
                            <input type="text" id="biz-name" class="form-control form-control-sm" placeholder="Your Company Ltd" value="Waveron Client">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" id="biz-email" class="form-control form-control-sm" placeholder="billing@yourbiz.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Address / Phone</label>
                            <input type="text" id="biz-address" class="form-control form-control-sm" placeholder="Nairobi, Kenya | +254 700 000000">
                        </div>
                    </div>

                    <!-- Client Details -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">Bill To (Client)</h5>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Client Name</label>
                            <input type="text" id="client-name" class="form-control form-control-sm" placeholder="Client Company Name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Client Email</label>
                            <input type="email" id="client-email" class="form-control form-control-sm" placeholder="finance@client.com">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Client Address</label>
                            <input type="text" id="client-address" class="form-control form-control-sm" placeholder="Nairobi, Kenya">
                        </div>
                    </div>

                    <!-- Meta details -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">Metadata</h5>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Doc Type</label>
                            <select id="doc-type" class="form-select form-select-sm">
                                <option value="INVOICE">INVOICE</option>
                                <option value="QUOTATION">QUOTATION</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Doc Number</label>
                            <input type="text" id="doc-number" class="form-control form-control-sm" value="WV-2026-001">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Currency</label>
                            <select id="doc-currency" class="form-select form-select-sm">
                                <option value="KES">KES (Shilling)</option>
                                <option value="USD">USD (Dollar)</option>
                                <option value="EUR">EUR (Euro)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Date Issued</label>
                            <input type="date" id="doc-date" class="form-control form-control-sm" value="2026-06-19">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Due Date</label>
                            <input type="date" id="doc-due" class="form-control form-control-sm" value="2026-07-03">
                        </div>
                    </div>

                    <!-- Items Table -->
                    <div class="mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2 d-flex justify-content-between align-items-center">
                            Line Items
                            <button id="add-item-row" class="btn btn-outline-success btn-xs rounded-pill px-2 py-1" style="font-size:0.75rem;">
                                <i class="bi bi-plus-circle me-1"></i> Add Row
                            </button>
                        </h5>
                        <div id="items-container">
                            <!-- Dynamic Row -->
                            <div class="row g-2 align-items-end item-input-row mb-2">
                                <div class="col-5">
                                    <label class="form-label small text-muted mb-1">Description</label>
                                    <input type="text" class="form-control form-control-sm item-desc" placeholder="Software development service" value="Web Development Service">
                                </div>
                                <div class="col-2">
                                    <label class="form-label small text-muted mb-1">Qty</label>
                                    <input type="number" class="form-control form-control-sm item-qty" placeholder="1" value="1" min="1">
                                </div>
                                <div class="col-3">
                                    <label class="form-label small text-muted mb-1">Unit Rate</label>
                                    <input type="number" class="form-control form-control-sm item-rate" placeholder="50000" value="85000" min="0">
                                </div>
                                <div class="col-2 text-end">
                                    <button class="btn btn-outline-danger btn-sm remove-row-btn" style="border:none; padding: 4px 8px;"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tax & Discounts -->
                    <div class="row g-3 mb-4">
                        <h5 class="fw-semibold text-dark border-bottom pb-2">Tax & Discount</h5>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Tax Rate (%)</label>
                            <input type="number" id="tax-rate" class="form-control form-control-sm" value="16" min="0" max="100">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Discount (%)</label>
                            <input type="number" id="discount-rate" class="form-control form-control-sm" value="0" min="0" max="100">
                        </div>
                    </div>

                    <!-- Bottom actions -->
                    <div class="d-flex gap-2">
                        <button id="print-invoice" class="btn btn-success flex-grow-1 rounded-pill py-2 fw-semibold">
                            <i class="bi bi-printer me-2"></i> Print & Download PDF
                        </button>
                        <button id="reset-invoice" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side: Sticky Live Preview -->
            <div class="col-lg-6">
                <div class="preview-sticky">
                    <h5 class="text-muted small font-monospace mb-2"><i class="bi bi-eye"></i> LIVE PREVIEW</h5>
                    
                    <!-- Paper Sheet Layout -->
                    <div id="invoice-preview" class="invoice-paper shadow-sm bg-white p-5 rounded-3">
                        <div class="invoice-header d-flex justify-content-between border-bottom pb-4 mb-4">
                            <div>
                                <h2 id="prev-biz-name" class="fw-bold text-success mb-1">Waveron Client</h2>
                                <div id="prev-biz-email" class="text-muted small">billing@yourbiz.com</div>
                                <div id="prev-biz-address" class="text-muted small">Nairobi, Kenya | +254 700 000000</div>
                            </div>
                            <div class="text-end">
                                <h3 id="prev-doc-type" class="fw-bold text-success mb-1">INVOICE</h3>
                                <div class="fw-semibold text-dark mb-1" id="prev-doc-number">#WV-2026-001</div>
                                <div class="small text-muted">Date: <span id="prev-doc-date">2026-06-19</span></div>
                                <div class="small text-muted">Due: <span id="prev-doc-due">2026-07-03</span></div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <h6 class="text-muted text-uppercase mb-2 small fw-bold">Bill To:</h6>
                                <h5 id="prev-client-name" class="fw-semibold text-dark mb-1">Client Company Name</h5>
                                <div id="prev-client-email" class="text-muted small">finance@client.com</div>
                                <div id="prev-client-address" class="text-muted small">Nairobi, Kenya</div>
                            </div>
                        </div>

                        <!-- Live Items Table -->
                        <table class="table table-borderless table-striped preview-table mb-4">
                            <thead>
                                <tr class="bg-success bg-opacity-10 text-success fw-bold">
                                    <th class="py-2" style="width:60%;">Description</th>
                                    <th class="py-2 text-center" style="width:10%;">Qty</th>
                                    <th class="py-2 text-end" style="width:15%;">Rate</th>
                                    <th class="py-2 text-end" style="width:15%;">Total</th>
                                </tr>
                            </thead>
                            <tbody id="prev-table-body">
                                <!-- Rendered dynamically -->
                            </tbody>
                        </table>

                        <!-- Totals Summary -->
                        <div class="row justify-content-end">
                            <div class="col-md-6 col-lg-5 text-end">
                                <div class="d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted">Subtotal:</span>
                                    <span class="fw-semibold" id="prev-subtotal">KES 85,000.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-1 border-bottom">
                                    <span class="text-muted" id="prev-tax-label">VAT (16%):</span>
                                    <span class="fw-semibold" id="prev-tax">KES 13,600.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-1 border-bottom d-none" id="prev-discount-row">
                                    <span class="text-muted" id="prev-discount-label">Discount:</span>
                                    <span class="fw-semibold text-danger" id="prev-discount">-KES 0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 mb-3">
                                    <span class="fw-bold text-dark fs-5">Grand Total:</span>
                                    <span class="fw-bold text-success fs-5" id="prev-total">KES 98,600.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contextual Lead Capture CTA banner -->
                    <div class="card border-0 rounded-4 p-4 mt-4 text-center" style="background-color: rgba(21, 128, 61, 0.06); border: 1px solid rgba(21, 128, 61, 0.15) !important;">
                        <h5 class="fw-bold mb-2" style="color: #15803d;">Need an Automated Billing System?</h5>
                        <p class="small mb-3" style="color: #4b5563;">Tired of creating manual invoices? Waveron builds custom billing systems and ERP platforms for growing SMEs.</p>
                        <div>
                            <a href="{{ route('contact') }}" class="btn rounded-pill px-4 py-2 fw-semibold btn-sm shadow-sm text-white" style="background-color: #15803d; border: none;">
                                Discuss Your Project <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Print-Only Page (Visible only in Print dialog) -->
<div id="print-sheet" class="print-only">
    <!-- Copy of invoice-preview will be loaded here dynamically via JS during print -->
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

    /* Print stylesheet settings */
    @media print {
        body {
            background-color: white !important;
            color: black !important;
            font-size: 12pt;
        }
        .no-print, header, footer, .navbar, .navbar-spacer, #navbarNav, .navbar-toggler, .tools-hero, .btn, .card, .AI-widget, #AI-chatbot-widget {
            display: none !important;
        }
        .print-only {
            display: block !important;
            width: 100%;
        }
        .invoice-paper {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }
    }

    .print-only {
        display: none;
    }

    /* Invoice paper layout */
    .invoice-paper {
        min-height: 600px;
        border: 1px solid #eee;
    }

    .preview-table th {
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .preview-table td {
        font-size: 0.85rem;
    }

    /* Extra small buttons */
    .btn-xs {
        padding: 2px 6px;
        font-size: 0.75rem;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bizNameInput = document.getElementById('biz-name');
    const bizEmailInput = document.getElementById('biz-email');
    const bizAddressInput = document.getElementById('biz-address');
    
    const clientNameInput = document.getElementById('client-name');
    const clientEmailInput = document.getElementById('client-email');
    const clientAddressInput = document.getElementById('client-address');
    
    const docTypeInput = document.getElementById('doc-type');
    const docNumberInput = document.getElementById('doc-number');
    const docCurrencyInput = document.getElementById('doc-currency');
    const docDateInput = document.getElementById('doc-date');
    const docDueInput = document.getElementById('doc-due');
    
    const taxRateInput = document.getElementById('tax-rate');
    const discountRateInput = document.getElementById('discount-rate');
    
    const prevBizName = document.getElementById('prev-biz-name');
    const prevBizEmail = document.getElementById('prev-biz-email');
    const prevBizAddress = document.getElementById('prev-biz-address');
    
    const prevClientName = document.getElementById('prev-client-name');
    const prevClientEmail = document.getElementById('prev-client-email');
    const prevClientAddress = document.getElementById('prev-client-address');
    
    const prevDocType = document.getElementById('prev-doc-type');
    const prevDocNumber = document.getElementById('prev-doc-number');
    const prevDocDate = document.getElementById('prev-doc-date');
    const prevDocDue = document.getElementById('prev-doc-due');
    
    const prevTableBody = document.getElementById('prev-table-body');
    const prevSubtotal = document.getElementById('prev-subtotal');
    const prevTaxLabel = document.getElementById('prev-tax-label');
    const prevTax = document.getElementById('prev-tax');
    const prevDiscountRow = document.getElementById('prev-discount-row');
    const prevDiscountLabel = document.getElementById('prev-discount-label');
    const prevDiscount = document.getElementById('prev-discount');
    const prevTotal = document.getElementById('prev-total');
    
    const itemsContainer = document.getElementById('items-container');
    const addRowBtn = document.getElementById('add-item-row');
    const printBtn = document.getElementById('print-invoice');
    const resetBtn = document.getElementById('reset-invoice');

    // Sync header elements
    function syncHeader() {
        prevBizName.innerText = bizNameInput.value || 'Your Company Ltd';
        prevBizEmail.innerText = bizEmailInput.value || 'billing@yourbiz.com';
        prevBizAddress.innerText = bizAddressInput.value || 'Nairobi, Kenya';
        
        prevClientName.innerText = clientNameInput.value || 'Client Company Name';
        prevClientEmail.innerText = clientEmailInput.value || 'finance@client.com';
        prevClientAddress.innerText = clientAddressInput.value || 'Nairobi, Kenya';
        
        prevDocType.innerText = docTypeInput.value;
        prevDocNumber.innerText = '#' + (docNumberInput.value || '001');
        prevDocDate.innerText = docDateInput.value;
        prevDocDue.innerText = docDueInput.value;
    }

    // Add dynamic row
    addRowBtn.addEventListener('click', function() {
        const row = document.createElement('div');
        row.className = 'row g-2 align-items-end item-input-row mb-2';
        row.innerHTML = `
            <div class="col-5">
                <input type="text" class="form-control form-control-sm item-desc" placeholder="Service description" value="Consultancy Service">
            </div>
            <div class="col-2">
                <input type="number" class="form-control form-control-sm item-qty" placeholder="1" value="1" min="1">
            </div>
            <div class="col-3">
                <input type="number" class="form-control form-control-sm item-rate" placeholder="0" value="5000" min="0">
            </div>
            <div class="col-2 text-end">
                <button class="btn btn-outline-danger btn-sm remove-row-btn" style="border:none; padding: 4px 8px;"><i class="bi bi-trash"></i></button>
            </div>
        `;
        itemsContainer.appendChild(row);
        bindRowEvents(row);
        calculateInvoice();
    });

    // Remove row
    function bindRowEvents(row) {
        row.querySelector('.remove-row-btn').addEventListener('click', function() {
            if (document.querySelectorAll('.item-input-row').length > 1) {
                row.remove();
                calculateInvoice();
            } else {
                alert('Invoice must have at least one line item.');
            }
        });
        
        row.querySelector('.item-desc').addEventListener('input', calculateInvoice);
        row.querySelector('.item-qty').addEventListener('input', calculateInvoice);
        row.querySelector('.item-rate').addEventListener('input', calculateInvoice);
    }

    // Format money helper
    function formatMoney(amount, currency) {
        return currency + ' ' + Number(amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    // Calculate totals
    function calculateInvoice() {
        syncHeader();
        
        const currency = docCurrencyInput.value;
        const rows = document.querySelectorAll('.item-input-row');
        let subtotal = 0;
        
        prevTableBody.innerHTML = '';
        
        rows.forEach(function(row) {
            const desc = row.querySelector('.item-desc').value || 'Unlabelled Item';
            const qty = Number(row.querySelector('.item-qty').value) || 0;
            const rate = Number(row.querySelector('.item-rate').value) || 0;
            const rowTotal = qty * rate;
            subtotal += rowTotal;
            
            // Append preview table row
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-2 text-dark">${desc}</td>
                <td class="py-2 text-center text-muted">${qty}</td>
                <td class="py-2 text-end text-muted">${formatMoney(rate, '')}</td>
                <td class="py-2 text-end fw-semibold text-dark">${formatMoney(rowTotal, '')}</td>
            `;
            prevTableBody.appendChild(tr);
        });

        // Compute taxes & discounts
        const taxRate = Number(taxRateInput.value) || 0;
        const discountRate = Number(discountRateInput.value) || 0;
        
        const discountAmt = subtotal * (discountRate / 100);
        const taxableAmt = subtotal - discountAmt;
        const taxAmt = taxableAmt * (taxRate / 100);
        const grandTotal = taxableAmt + taxAmt;
        
        prevSubtotal.innerText = formatMoney(subtotal, currency);
        
        prevTaxLabel.innerText = `VAT (${taxRate}%):`;
        prevTax.innerText = formatMoney(taxAmt, currency);
        
        if (discountRate > 0) {
            prevDiscountRow.classList.remove('d-none');
            prevDiscountLabel.innerText = `Discount (${discountRate}%):`;
            prevDiscount.innerText = `-${formatMoney(discountAmt, currency)}`;
        } else {
            prevDiscountRow.classList.add('d-none');
        }
        
        prevTotal.innerText = formatMoney(grandTotal, currency);
    }

    // Print PDF
    printBtn.addEventListener('click', function() {
        // Copy the preview box to the print sheet
        const printSheet = document.getElementById('print-sheet');
        printSheet.innerHTML = document.getElementById('invoice-preview').outerHTML;
        
        // Trigger browser print
        window.print();
    });

    // Reset fields
    resetBtn.addEventListener('click', function() {
        if (confirm('Are you sure you want to clear this document?')) {
            clientNameInput.value = '';
            clientEmailInput.value = '';
            clientAddressInput.value = '';
            discountRateInput.value = '0';
            
            // Remove extra rows
            const rows = document.querySelectorAll('.item-input-row');
            rows.forEach((row, i) => {
                if (i > 0) row.remove();
                else {
                    row.querySelector('.item-desc').value = '';
                    row.querySelector('.item-qty').value = '1';
                    row.querySelector('.item-rate').value = '0';
                }
            });
            calculateInvoice();
        }
    });

    // Bind base event listeners
    const inputs = [
        bizNameInput, bizEmailInput, bizAddressInput,
        clientNameInput, clientEmailInput, clientAddressInput,
        docTypeInput, docNumberInput, docCurrencyInput, docDateInput, docDueInput,
        taxRateInput, discountRateInput
    ];
    
    inputs.forEach(input => input.addEventListener('input', calculateInvoice));
    
    // Bind initial rows
    document.querySelectorAll('.item-input-row').forEach(bindRowEvents);
    
    // Run initial calculate
    calculateInvoice();
});
</script>
@endpush
