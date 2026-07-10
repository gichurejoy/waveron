<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuoteSubmission;
use App\Models\FastInquiry;
use App\Models\ContactSubmission;

class LeadsSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Quote Submissions
        QuoteSubmission::create([
            'service_type' => 'Software Development (web/app platforms)',
            'complexity' => 'Advanced Platform',
            'timeline' => '2 - 3 Months',
            'selected_features' => ['Real-Time Live WebSockets', 'Custom AI Model Integration', 'Role-Based RBAC'],
            'selected_addons' => ['Continuous Security Auditing', '24/7 SLA-Backed Support'],
            'estimated_total' => 1750000,
            'user_email' => 'tech-ops@nairobilogistics.co.ke',
            'company' => 'Nairobi Logistics Ltd',
            'status' => 'New',
            'internal_notes' => 'Interactive cost calculator submission received on website.',
        ]);

        QuoteSubmission::create([
            'service_type' => 'Graphic / UI Design',
            'complexity' => 'High Fidelity UI Kit',
            'timeline' => 'Standard',
            'selected_features' => ['Dark Mode Native Support', 'SVG Assets Collection', 'Figma Interactive Mockup'],
            'selected_addons' => ['Source Files Delivery'],
            'estimated_total' => 450000,
            'user_email' => 'branding@savannahsafaris.com',
            'company' => 'Savannah Safaris Ltd',
            'status' => 'In Review',
            'internal_notes' => 'Spoke to their head of marketing, requested review of the timeline.',
        ]);

        QuoteSubmission::create([
            'service_type' => 'Software Development (web/app platforms)',
            'complexity' => 'MVP Launch Package',
            'timeline' => '1 - 2 Months',
            'selected_features' => ['Standard Admin Portal', 'M-Pesa Integration'],
            'selected_addons' => [],
            'estimated_total' => 850000,
            'user_email' => 'founders@kilibox.co',
            'company' => 'KiliBox Startup',
            'status' => 'Converted',
            'internal_notes' => 'Contract signed! Invoices generated and project kicked off.',
        ]);

        // 2. Fast Inquiries
        FastInquiry::create([
            'name' => 'Michael Kamau',
            'email' => 'm.kamau@equitypartners.co.ke',
            'company' => 'Equity Partners East Africa',
            'budget' => 'KES 1,500,000 - 3,000,000',
            'timeline' => '2 - 3 Months',
            'services_requested' => 'High-Frequency Real-time Telemetry Dashboard',
            'project_details' => 'We would like to request Waveron Technologies to architect a highly high-performance module custom-fitted for our Nairobi headquarters. Must fully comply with local data protection regulations, handle heavy concurrent traffic, and feature clean SVG analytics diagrams.',
            'status' => 'New',
            'internal_notes' => ['[Simulated crawler webhook]: Ingested raw form payload successfully.', '[Admin Log]: Added to priority dispatch.'],
        ]);

        FastInquiry::create([
            'name' => 'Cherotich Langat',
            'email' => 'c.langat@tea-export.co.ke',
            'company' => 'Kericho Tea Exporters',
            'budget' => 'KES 500,000 - 1,500,000',
            'timeline' => '1 - 2 Months',
            'services_requested' => 'M-Pesa Express Payment Portal & CRM Integration',
            'project_details' => 'Need a streamlined payment processing dashboard connected directly to Safaricom Daraja API with automatic PDF invoice dispatch and customer portal access.',
            'status' => 'Contacted',
            'internal_notes' => ['Contact email sent to Cherotich on 9th July. Waiting for confirmation callback.'],
        ]);

        // 3. Contact Submissions
        ContactSubmission::create([
            'full_name' => 'Dr. Patrick Mwangi',
            'email' => 'p.mwangi@africamedtech.org',
            'company' => 'Africa MedTech Consortium',
            'subject' => 'Urgent custom consulting request',
            'message' => 'Hi, we love your engineering-as-marketing tools. We would like to schedule a quick Zoom call to review integration parameters for our upcoming health telemetry suite.',
            'budget' => 'Over KES 3,000,000',
            'timeline' => '3 - 6 Months',
            'services' => 'Software Development',
            'status' => 'Unread',
        ]);

        ContactSubmission::create([
            'full_name' => 'Wanjiku Njoroge',
            'email' => 'wanjiku@apexbrands.co.ke',
            'company' => 'Apex Brands Kenya',
            'subject' => 'API endpoint integration details',
            'message' => 'Does your custom software offer direct container deployment to our private on-premise cloud infrastructure? Let us know if you provide SLA support.',
            'budget' => 'KES 1,500,000 - 3,000,000',
            'timeline' => '2 - 3 Months',
            'services' => 'Software Development, Branding',
            'status' => 'Read',
        ]);

        ContactSubmission::create([
            'full_name' => 'Sylvester Omondi',
            'email' => 'omondi@cybernet.co.ke',
            'company' => 'CyberNet Solutions',
            'subject' => 'Looking for system partners',
            'message' => 'Looking for premium high-throughput systems partners in Nairobi. Please contact us to share your corporate portfolio.',
            'status' => 'Replied',
        ]);
    }
}
