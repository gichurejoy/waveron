<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement - {{ $invoice->invoice_number }} - Waveron Technologies</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: #1e293b;
            background: #f8fafc;
            line-height: 1.5;
            padding: 30px 20px;
        }
        .container {
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            padding: 48px;
            border: 1px solid #e2e8f0;
        }
        .actions-bar {
            max-width: 820px;
            margin: 0 auto 20px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }
        .btn-print {
            background: #0f172a;
            color: #ffffff;
        }
        .btn-print:hover {
            background: #1e293b;
        }
        .btn-pdf {
            background: #059669;
            color: #ffffff;
        }
        .btn-pdf:hover {
            background: #047857;
        }
        .btn-back {
            background: #e2e8f0;
            color: #334155;
        }
        .btn-back:hover {
            background: #cbd5e1;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-bottom: 28px;
            border-bottom: 2px solid #f1f5f9;
        }
        .logo-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .logo-icon {
            color: #0891b2;
        }
        .company-subtitle {
            font-size: 11px;
            color: #64748b;
            margin-top: 6px;
        }
        .doc-meta {
            text-align: right;
        }
        .doc-badge {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            font-family: 'JetBrains Mono', monospace;
        }
        .invoice-num {
            font-size: 20px;
            font-weight: 800;
            color: #0891b2;
            font-family: 'JetBrains Mono', monospace;
            margin-top: 2px;
        }
        .invoice-date {
            font-size: 11px;
            color: #64748b;
            margin-top: 2px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin: 28px 0;
        }
        .info-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
        }
        .info-card-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 8px;
            font-family: 'JetBrains Mono', monospace;
        }
        .client-name {
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
        }
        .client-meta {
            font-size: 12px;
            color: #475569;
            margin-top: 4px;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            margin-top: 4px;
        }
        .status-paid { background: #dcfce7; color: #15803d; }
        .status-sent { background: #e0f2fe; color: #0369a1; }
        .status-overdue { background: #fee2e2; color: #b91c1c; }
        .status-draft { background: #f1f5f9; color: #475569; }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .items-table th {
            background: #f8fafc;
            text-align: left;
            padding: 12px 14px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }
        .items-table td {
            padding: 16px 14px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }
        .item-desc {
            font-weight: 600;
            color: #0f172a;
        }
        .item-sub {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }
        .text-right {
            text-align: right;
        }
        .mono {
            font-family: 'JetBrains Mono', monospace;
        }

        .summary-wrap {
            display: flex;
            justify-content: flex-end;
            margin-top: 28px;
        }
        .summary-box {
            width: 320px;
            border-top: 2px solid #e2e8f0;
            padding-top: 14px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            font-size: 13px;
            color: #64748b;
        }
        .summary-row.total {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
            border-top: 2px solid #0f172a;
            padding-top: 12px;
            margin-top: 8px;
        }
        .total-amount {
            color: #0891b2;
            font-family: 'JetBrains Mono', monospace;
        }

        .banking-box {
            margin-top: 36px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px dashed #cbd5e1;
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .banking-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .banking-info {
            font-size: 12px;
            color: #475569;
            line-height: 1.6;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            color: #94a3b8;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }
            .actions-bar {
                display: none !important;
            }
            .container {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                max-width: 100% !important;
            }
            @page {
                size: A4 portrait;
                margin: 15mm;
            }
        }
    </style>
</head>
<body>
    <div class="actions-bar">
        <a href="javascript:window.close()" class="btn btn-back">
            ← Close Window
        </a>
        <div style="display: flex; gap: 10px;">
            <a href="{{ route('admin.invoices.download-pdf', $invoice->id) }}" class="btn btn-pdf">
                Download PDF
            </a>
            <button onclick="window.print()" class="btn btn-print">
                Print Statement
            </button>
        </div>
    </div>

    <div class="container">
        <div class="header">
            <div>
                <div class="logo-title">
                    <span class="logo-icon">❖</span> WAVERON TECHNOLOGIES
                </div>
                <div class="company-subtitle">Enterprise Software Architects &amp; Digital Solutions</div>
                <div class="company-subtitle">Upper Hill District, Nairobi, Kenya • info@waverontechnologies.co.ke</div>
            </div>
            <div class="doc-meta">
                <div class="doc-badge">Official Financial Statement</div>
                <div class="invoice-num">{{ $invoice->invoice_number }}</div>
                <div class="invoice-date">Issued: {{ \Carbon\Carbon::parse($invoice->issued_at)->format('d M Y') }}</div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-title">Bill To / Client Details</div>
                <div class="client-name">{{ $invoice->client_name }}</div>
                @if($invoice->client_email)
                    <div class="client-meta">✉ {{ $invoice->client_email }}</div>
                @endif
                @if($invoice->client_phone)
                    <div class="client-meta">✆ {{ $invoice->client_phone }}</div>
                @endif
            </div>
            <div class="info-card">
                <div class="info-card-title">Statement Particulars</div>
                <div>
                    <span class="status-badge {{ $invoice->status === 'Paid' ? 'status-paid' : ($invoice->status === 'Overdue' ? 'status-overdue' : 'status-sent') }}">
                        • {{ strtoupper($invoice->status) }}
                    </span>
                </div>
                <div class="client-meta" style="margin-top: 8px;">
                    <strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_at)->format('d M Y') }}
                </div>
                <div class="client-meta">
                    <strong>Payment Terms:</strong> {{ $invoice->credit_terms ?? 'Standard Net-14' }}
                </div>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Deliverable / Core Module</th>
                    <th style="width: 70px; text-align: center;">Qty</th>
                    <th class="text-right" style="width: 140px;">Unit Rate</th>
                    <th class="text-right" style="width: 150px;">Total (KES)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="item-desc">{{ $invoice->project_type }}</div>
                        <div class="item-sub">{{ $invoice->project_brief ?? 'Enterprise technology execution and architectural deployment as per project scope.' }}</div>
                    </td>
                    <td style="text-align: center;" class="mono">1</td>
                    <td class="text-right mono">KES {{ number_format($invoice->amount, 2) }}</td>
                    <td class="text-right mono" style="font-weight: 700; color: #0f172a;">KES {{ number_format($invoice->amount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="summary-wrap">
            <div class="summary-box">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span class="mono">KES {{ number_format($invoice->amount, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax / VAT (Inclusive)</span>
                    <span class="mono">KES 0.00</span>
                </div>
                <div class="summary-row total">
                    <span>Total Balance</span>
                    <span class="total-amount">KES {{ number_format($invoice->amount, 2) }}</span>
                </div>
            </div>
        </div>

        <div class="banking-box">
            <div>
                <div class="banking-title">M-Pesa Business Settlement</div>
                <div class="banking-info">
                    <strong>Paybill / Till:</strong> 247247<br>
                    <strong>Account No:</strong> {{ $invoice->invoice_number }}<br>
                    <strong>Instant Push:</strong> Available on Client Portal
                </div>
            </div>
            <div>
                <div class="banking-title">Direct Bank Transfer (EFT/RTGS)</div>
                <div class="banking-info">
                    <strong>Bank:</strong> NCBA Bank Kenya PLC<br>
                    <strong>Account Name:</strong> Waveron Technologies Ltd<br>
                    <strong>Branch:</strong> Upper Hill, Nairobi
                </div>
            </div>
        </div>

        <div class="footer">
            <span>Waveron Technologies Ltd • Registration: PVT-XY78129</span>
            <span>Thank you for choosing Waveron as your technology partner.</span>
        </div>
    </div>

    <script>
        // Auto print on load if requested
        if (window.location.search.includes('autoprint=1')) {
            window.addEventListener('load', () => {
                setTimeout(() => window.print(), 350);
            });
        }
    </script>
</body>
</html>
