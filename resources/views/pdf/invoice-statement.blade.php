<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Statement - {{ $invoice->invoice_number }}</title>
    <style>
        @page { margin: 30px; }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .logo-title {
            font-size: 20px;
            font-weight: bold;
            color: #059669;
            letter-spacing: -0.5px;
        }
        .logo-sub {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .statement-title {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
        }
        .statement-number {
            text-align: right;
            font-size: 12px;
            color: #059669;
            font-weight: bold;
        }
        .divider {
            height: 2px;
            background-color: #10b981;
            margin-bottom: 20px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .info-table td {
            vertical-align: top;
            width: 50%;
        }
        .section-label {
            font-size: 10px;
            font-weight: bold;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .client-name {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .items-table th {
            background-color: #0f172a;
            color: #ffffff;
            font-size: 10px;
            text-transform: uppercase;
            padding: 8px 10px;
            text-align: left;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 11px;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .summary-table td {
            padding: 6px 10px;
            font-size: 11px;
        }
        .total-row td {
            font-size: 14px;
            font-weight: bold;
            color: #059669;
            background-color: #ecfdf5;
            border-top: 2px solid #10b981;
            border-bottom: 2px solid #10b981;
        }
        .payment-box {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 15px;
            margin-top: 20px;
        }
        .payment-title {
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-paid { background-color: #d1fae5; color: #047857; }
        .badge-sent { background-color: #e0f2fe; color: #0369a1; }
        .badge-overdue { background-color: #ffe4e6; color: #be123c; }
        .footer {
            margin-top: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 15px;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td>
                <div class="logo-title">WAVERON TECHNOLOGIES</div>
                <div class="logo-sub">Enterprise Systems & Web Architecture</div>
            </td>
            <td>
                <div class="statement-title">INVOICE STATEMENT</div>
                <div class="statement-number">{{ $invoice->invoice_number }}</div>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <table class="info-table">
        <tr>
            <td>
                <div class="section-label">Billed To:</div>
                <div class="client-name">{{ $invoice->client_name }}</div>
                <div>{{ $invoice->client_email }}</div>
                <div>{{ $invoice->client_phone }}</div>
            </td>
            <td style="text-align: right;">
                <div class="section-label">Statement Details:</div>
                <div><strong>Issued Date:</strong> {{ $invoice->issued_at ? \Carbon\Carbon::parse($invoice->issued_at)->format('d F Y') : 'N/A' }}</div>
                <div><strong>Due Date:</strong> {{ $invoice->due_at ? \Carbon\Carbon::parse($invoice->due_at)->format('d F Y') : 'N/A' }}</div>
                <div><strong>Credit Terms:</strong> {{ $invoice->credit_terms }}</div>
                <div style="margin-top: 6px;">
                    <strong>Status:</strong> 
                    <span class="badge badge-{{ strtolower($invoice->status) }}">{{ $invoice->status }}</span>
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 60%;">Description / Scope of Work</th>
                <th style="width: 20%; text-align: center;">Project Type</th>
                <th style="width: 20%; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $invoice->project_type }}</strong><br>
                    <span style="color: #64748b;">{!! nl2br(e($invoice->project_brief)) !!}</span>
                </td>
                <td style="text-align: center;">{{ $invoice->project_type }}</td>
                <td style="text-align: right; font-weight: bold;">KES {{ number_format($invoice->amount) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td style="width: 60%;"></td>
            <td style="width: 20%; font-weight: bold; text-align: right;">Subtotal:</td>
            <td style="width: 20%; text-align: right;">KES {{ number_format($invoice->amount) }}</td>
        </tr>
        <tr>
            <td></td>
            <td style="font-weight: bold; text-align: right;">VAT / Taxes:</td>
            <td style="text-align: right;">KES 0.00</td>
        </tr>
        <tr class="total-row">
            <td></td>
            <td style="text-align: right;">TOTAL PAYABLE:</td>
            <td style="text-align: right;">KES {{ number_format($invoice->amount) }}</td>
        </tr>
    </table>

    <div class="payment-box">
        <div class="payment-title">Payment Guidelines & Options</div>
        <table style="width: 100%; border-collapse: collapse; font-size: 10px;">
            <tr>
                <td style="width: 50%;">
                    <strong>1. Safaricom M-Pesa Express / Till</strong><br>
                    • Business Name: Waveron Tech Ltd<br>
                    • Till / Paybill: 981402<br>
                    • Account Ref: {{ $invoice->invoice_number }}
                </td>
                <td style="width: 50%;">
                    <strong>2. Bank Electronic Transfer (EFT / RTGS)</strong><br>
                    • Bank: Equity Bank Kenya<br>
                    • Account Name: Waveron Technologies Ltd<br>
                    • Account Number: 0180293847561
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Waveron Technologies Ltd &bull; Nairobi, Kenya &bull; info@waverontechnologies.co.ke &bull; www.waverontechnologies.co.ke<br>
        This statement is computer generated and valid without signature.
    </div>

</body>
</html>
