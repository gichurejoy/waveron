<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quote Estimate — Waveron Technologies</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'DejaVu Sans', 'Helvetica Neue', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.7;
            color: #1a1a2e;
            background: #ffffff;
        }

        /* ---- Print Wrapper ---- */
        .print-page {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 48px;
        }

        /* ---- Header ---- */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 36px;
            padding-bottom: 24px;
            border-bottom: 3px solid #006400;
        }
        .brand {
            display: flex;
            flex-direction: column;
        }
        .brand-name {
            font-size: 26px;
            font-weight: 800;
            color: #006400;
            letter-spacing: -0.5px;
        }
        .brand-tagline {
            font-size: 10px;
            color: #6b7280;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 2px;
        }
        .quote-meta {
            text-align: right;
        }
        .quote-ref {
            font-size: 20px;
            font-weight: 700;
            color: #006400;
        }
        .quote-date {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 4px;
        }
        .status-badge {
            display: inline-block;
            margin-top: 8px;
            padding: 3px 12px;
            background: rgba(0, 100, 0, 0.08);
            color: #004d00;
            border: 1px solid rgba(0, 100, 0, 0.25);
            border-radius: 50px;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        /* ---- Two-column client / project info ---- */
        .info-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 28px;
        }
        .info-box {
            background: #f9fafb;
            border-radius: 8px;
            padding: 16px 18px;
            border-left: 3px solid #006400;
        }
        .info-box-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #006400;
            margin-bottom: 10px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 11px;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #6b7280; }
        .info-value { font-weight: 600; color: #111827; text-align: right; }

        /* ---- Section heading ---- */
        .section-heading {
            font-size: 14px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 12px;
            padding-bottom: 6px;
            border-bottom: 1px solid #e5e7eb;
        }

        /* ---- Services table ---- */
        .services-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 28px;
            font-size: 11px;
        }
        .services-table thead tr {
            background: #006400;
            color: white;
        }
        .services-table th {
            padding: 10px 12px;
            text-align: left;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .services-table th:last-child { text-align: right; }
        .services-table td {
            padding: 10px 12px;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: top;
        }
        .services-table td:last-child { text-align: right; font-weight: 600; color: #006400; }
        .services-table tbody tr:last-child td { border-bottom: none; }
        .services-table tbody tr:nth-child(even) td { background: #f9fafb; }
        .item-name { font-weight: 600; color: #111827; }
        .item-desc { color: #6b7280; font-size: 10px; margin-top: 2px; }

        /* ---- Totals ---- */
        .totals-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 28px;
        }
        .totals-box {
            width: 260px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 7px 0;
            font-size: 11px;
            border-bottom: 1px solid #f3f4f6;
        }
        .total-row:last-child {
            border-bottom: none;
            border-top: 2px solid #006400;
            padding-top: 12px;
            margin-top: 6px;
            font-size: 15px;
            font-weight: 800;
            color: #006400;
        }
        .total-label { color: #6b7280; }
        .total-value { font-weight: 600; }

        /* ---- Features / addons ---- */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            margin-bottom: 28px;
        }
        .feature-chip {
            background: rgba(0, 100, 0, 0.06);
            border: 1px solid rgba(0, 100, 0, 0.15);
            border-radius: 6px;
            padding: 7px 10px;
            font-size: 10px;
            font-weight: 600;
            color: #004d00;
        }
        .feature-chip::before { content: '✓  '; color: #006400; }

        /* ---- Notes ---- */
        .notes-box {
            background: #fffbeb;
            border-left: 3px solid #f59e0b;
            border-radius: 0 8px 8px 0;
            padding: 14px 16px;
            margin-bottom: 28px;
            font-size: 11px;
        }
        .notes-box strong { color: #92400e; }

        /* ---- Terms ---- */
        .terms {
            background: #f9fafb;
            border-radius: 8px;
            padding: 14px 18px;
            margin-bottom: 28px;
            font-size: 10px;
            color: #6b7280;
            line-height: 1.8;
        }
        .terms strong { color: #374151; }

        /* ---- Footer ---- */
        .doc-footer {
            margin-top: 36px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            font-size: 10px;
            color: #9ca3af;
        }
        .footer-brand { color: #006400; font-weight: 700; font-size: 11px; }

        /* ---- Print button (screen only) ---- */
        .print-actions {
            text-align: right;
            margin-bottom: 24px;
        }
        .btn-print {
            background: #006400;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 10px 24px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.3px;
        }
        .btn-print:hover { background: #004d00; }

        @media print {
            body { padding: 0; }
            .print-actions { display: none !important; }
            .print-page { padding: 20px 30px; }
        }
    </style>
</head>
<body>
    <div class="print-page">

        <!-- Print Button (Screen Only) -->
        <div class="print-actions">
            <button class="btn-print" onclick="window.print()">
                🖨 Print / Save as PDF
            </button>
        </div>

        <!-- ---- HEADER ---- -->
        <div class="header">
            <div class="brand">
                <div class="brand-name">Waveron Technologies</div>
                <div class="brand-tagline">Innovation's Crest, Tomorrow's Best</div>
                <div style="margin-top: 8px; font-size: 10px; color: #6b7280;">
                    Westlands, Nairobi, Kenya &nbsp;·&nbsp;
                    info@waverontechnologies.co.ke &nbsp;·&nbsp;
                    +254 798 717 800
                </div>
            </div>
            <div class="quote-meta">
                <div class="quote-ref">ESTIMATE QUOTE</div>
                <div class="quote-date">Generated: {{ now()->format('F d, Y') }}</div>
                <div class="quote-date">Valid for: <strong>30 days</strong></div>
            </div>
        </div>

        <!-- ---- CLIENT & PROJECT INFO ---- -->
        <div class="info-columns">
            <div class="info-box">
                <div class="info-box-title">Prepared For</div>
                @if(!empty($estimate['name']))
                <div class="info-row">
                    <span class="info-label">Name</span>
                    <span class="info-value">{{ $estimate['name'] }}</span>
                </div>
                @endif
                @if(!empty($estimate['email']))
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $estimate['email'] }}</span>
                </div>
                @endif
                @if(!empty($estimate['company']))
                <div class="info-row">
                    <span class="info-label">Company</span>
                    <span class="info-value">{{ $estimate['company'] }}</span>
                </div>
                @endif
            </div>
            <div class="info-box">
                <div class="info-box-title">Project Overview</div>
                @if(!empty($estimate['service']))
                <div class="info-row">
                    <span class="info-label">Service</span>
                    <span class="info-value">{{ $estimate['service'] }}</span>
                </div>
                @endif
                @if(!empty($estimate['complexity']))
                <div class="info-row">
                    <span class="info-label">Complexity</span>
                    <span class="info-value">{{ $estimate['complexity'] }}</span>
                </div>
                @endif
                @if(!empty($estimate['timeline']))
                <div class="info-row">
                    <span class="info-label">Timeline</span>
                    <span class="info-value">{{ $estimate['timeline'] }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- ---- COST BREAKDOWN TABLE ---- -->
        <div class="section-heading">Cost Breakdown</div>
        <table class="services-table">
            <thead>
                <tr>
                    <th style="width:40%">Item</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($estimate['base_cost']))
                <tr>
                    <td>
                        <div class="item-name">Base Development</div>
                        <div class="item-desc">{{ $estimate['complexity'] ?? 'Core project scope' }}</div>
                    </td>
                    <td style="font-size:10px; color:#6b7280;">Core functionality, setup, and architecture</td>
                    <td>Ksh {{ number_format($estimate['base_cost']) }}</td>
                </tr>
                @endif
                @if(!empty($estimate['features_cost']))
                <tr>
                    <td>
                        <div class="item-name">Key Features ({{ $estimate['feature_count'] ?? count($estimate['features'] ?? []) }})</div>
                        <div class="item-desc">{{ implode(', ', array_slice($estimate['features'] ?? [], 0, 3)) }}</div>
                    </td>
                    <td style="font-size:10px; color:#6b7280;">Selected feature development and integration</td>
                    <td>Ksh {{ number_format($estimate['features_cost']) }}</td>
                </tr>
                @endif
                @if(!empty($estimate['addons_cost']))
                <tr>
                    <td>
                        <div class="item-name">Add-on Services</div>
                        <div class="item-desc">{{ implode(', ', $estimate['addons'] ?? []) }}</div>
                    </td>
                    <td style="font-size:10px; color:#6b7280;">Ongoing managed add-ons (monthly basis)</td>
                    <td>Ksh {{ number_format($estimate['addons_cost']) }}/mo</td>
                </tr>
                @endif
                @if(!empty($estimate['timeline_multiplier']) && $estimate['timeline_multiplier'] > 1)
                <tr>
                    <td>
                        <div class="item-name">Rush / Expedited Delivery</div>
                        <div class="item-desc">{{ $estimate['timeline'] }}</div>
                    </td>
                    <td style="font-size:10px; color:#6b7280;">Timeline acceleration surcharge</td>
                    <td>+{{ round(($estimate['timeline_multiplier'] - 1) * 100) }}%</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- ---- TOTALS ---- -->
        <div class="totals-wrapper">
            <div class="totals-box">
                @if(!empty($estimate['base_cost']))
                <div class="total-row">
                    <span class="total-label">Subtotal</span>
                    <span class="total-value">Ksh {{ number_format(($estimate['base_cost'] ?? 0) + ($estimate['features_cost'] ?? 0)) }}</span>
                </div>
                @endif
                @if(!empty($estimate['addons_cost']))
                <div class="total-row">
                    <span class="total-label">Monthly Add-ons</span>
                    <span class="total-value">Ksh {{ number_format($estimate['addons_cost']) }}/mo</span>
                </div>
                @endif
                <div class="total-row">
                    <span>Total Estimate</span>
                    <span>Ksh {{ number_format($estimate['total'] ?? 0) }}</span>
                </div>
            </div>
        </div>

        <!-- ---- FEATURES / ADDONS LIST ---- -->
        @if(!empty($estimate['features']) && count($estimate['features']) > 0)
        <div class="section-heading">Included Features</div>
        <div class="features-grid" style="margin-bottom: 24px;">
            @foreach($estimate['features'] as $feature)
            <div class="feature-chip">{{ $feature }}</div>
            @endforeach
        </div>
        @endif

        <!-- ---- NOTES ---- -->
        <div class="notes-box">
            <strong>📝 Note:</strong> This is an automated estimate based on your selected configuration. Final pricing is confirmed after a discovery call where we scope your exact requirements, integrations, and architecture needs. We may adjust this figure up or down following discovery.
        </div>

        <!-- ---- TERMS ---- -->
        <div class="terms">
            <strong>Payment Terms:</strong> 50% deposit required before project kickoff. Remaining 50% due on delivery. Monthly add-on billing begins after go-live.<br>
            <strong>Validity:</strong> This estimate is valid for 30 days from the date issued.<br>
            <strong>Revisions:</strong> Up to 3 rounds of revisions included in scope. Additional revisions billed at Ksh 3,500/hour.<br>
            <strong>IP & Source Code:</strong> Full intellectual property and source code ownership transferred to client upon final payment.
        </div>

        <!-- ---- FOOTER ---- -->
        <div class="doc-footer">
            <div>
                <div class="footer-brand">Waveron Technologies</div>
                <div>Westlands, Nairobi, Kenya · info@waverontechnologies.co.ke</div>
            </div>
            <div style="text-align: right;">
                <div>© {{ date('Y') }} Waveron Technologies. All rights reserved.</div>
                <div>www.waverontechnologies.co.ke</div>
            </div>
        </div>

    </div>
</body>
</html>
