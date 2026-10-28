<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CareerRole;
use App\Models\ClientReferral;
use App\Models\JobApplication;

class CareersSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Career Roles
        $seniorDev = CareerRole::create([
            'code'            => 'SNR-SYSTEMS-DEV',
            'title'           => 'Senior Systems Developer (Rust/Go)',
            'employment_type' => 'Full-Time',
            'location'        => 'Nairobi, Kenya (Hybrid)',
            'compensation'    => 'KES 450,000 - 680,000 / Month + Tech Equity',
            'prerequisites'   => [
                '5+ years of production experience with Go, Rust, or C++ in highly distributed environments.',
                'Deep understanding of Linux kernel networking, epoll systems, and raw WebSockets.',
                'Hands-on knowledge of Redis pub/sub architectures and PostgreSQL connection pooling.',
            ],
            'status' => 'Active',
        ]);

        $frontendEng = CareerRole::create([
            'code'            => 'MID-REACT-ENGINEER',
            'title'           => 'Mid-Weight Frontend Craftsman (React/TS)',
            'employment_type' => 'Contract',
            'location'        => 'Remote (GMT+3 overlap)',
            'compensation'    => 'KES 180,000 - 250,000 / Month',
            'prerequisites'   => [
                '3+ years of professional React development experience.',
                'Solid mastery of modern CSS (Tailwind) and SVG animation techniques.',
                'Experience integrating REST and GraphQL APIs cleanly with robust error boundaries.',
            ],
            'status' => 'Active',
        ]);

        $salesperson = CareerRole::create([
            'code'            => 'SALES-ASSOCIATE',
            'title'           => 'Salesperson',
            'employment_type' => 'Full-Time / Contract',
            'location'        => 'Nairobi, Kenya (Hybrid/Remote)',
            'compensation'    => 'Commission-Based',
            'prerequisites'   => [
                'Sell subscriptions and licenses to our proprietary platforms: Waveron CRM, our automated Brand Book Generator, and our Job/Scholarship Matching Platform.',
                'Identify and pursue new B2B clients for custom agency services (Web, Mobile, Enterprise Solutions).',
                'Understand client needs and match them accurately with our SaaS products or custom services.',
                'Negotiate contracts, close enterprise deals, and build lasting relationships to maximize your revenue.',
            ],
            'status' => 'Active',
        ]);

        // 2. Client Referrals
        ClientReferral::create([
            'referral_code'    => 'WVRN-KIR001',
            'referrer_name'    => 'Eng. Nicholas Kirui',
            'referrer_contact' => 'n.kirui@kiruiconsulting.com',
            'client_name'      => 'Athi Water Services',
            'services_needed'  => 'Enterprise SCADA Web Dashboard integration and alert hub.',
            'commission_amount' => 45000,
            'payout_status'    => 'In Progress',
            'status'           => 'Active Lead',
        ]);

        ClientReferral::create([
            'referral_code'    => 'WVRN-WAM002',
            'referrer_name'    => 'Lydia Wambui',
            'referrer_contact' => '+254712345678',
            'client_name'      => 'Soma Academy',
            'services_needed'  => 'E-learning system redesign with video delivery node tuning.',
            'commission_amount' => 25000,
            'payout_status'    => 'Paid',
            'status'           => 'Paid Out Commission',
        ]);

        ClientReferral::create([
            'referral_code'    => 'WVRN-VAN003',
            'referrer_name'    => 'Hillary Vance',
            'referrer_contact' => 'hillary@vance-fintech.co',
            'client_name'      => 'Maisha Microfinance',
            'services_needed'  => 'SME lending scorecard mobile app and agent portal.',
            'commission_amount' => 60000,
            'payout_status'    => 'Pending',
            'status'           => 'Pending Review',
        ]);

        // 3. Job Applications
        JobApplication::create([
            'career_role_id' => $seniorDev->id,
            'name'           => 'Josphat Njuguna',
            'contact'        => 'josphat.njuguna@email.com',
            'resume_path'    => null,
            'years_exp'      => 6,
            'why_fit'        => 'I have spent 6 years building distributed systems at scale, primarily using Go and Rust. I\'ve contributed to open-source WebSocket servers and have deep knowledge of epoll I/O models. Waveron\'s engineering-first culture is exactly the environment where I thrive.',
            'largest_deal'   => 'Architected a real-time telemetry pipeline for a Nairobi-based ISP handling 50,000 concurrent connections. The deal was KES 4.2M and I was the lead architect.',
            'proud_sale'     => 'Convinced a skeptical CTO to migrate from a monolithic PHP system to a Go microservices architecture — delivered 10x throughput improvement in 3 months.',
            'first_clients'  => 'Week 1: I would audit Waveron\'s existing client list to identify upsell opportunities. Week 2: Target fintech startups in Kilimani and Westlands. Week 3: LinkedIn outreach to CTOs of medium-sized logistics firms.',
            'internal_notes' => ['[Admin]: Reviewed CV — excellent Go/Rust portfolio.', '[Admin]: Scheduled technical screening for July 12th.'],
            'status'         => 'Reviewing',
        ]);

        JobApplication::create([
            'career_role_id' => $frontendEng->id,
            'name'           => 'Stacy Awuor',
            'contact'        => 'stacy.awuor@design.co.ke',
            'resume_path'    => null,
            'years_exp'      => 3,
            'why_fit'        => 'I specialize in building pixel-perfect React interfaces with smooth SVG animations. I\'ve worked on 3 SaaS products from MVP to launch.',
            'largest_deal'   => 'Delivered a complete UI overhaul for a Kenyan fintech app — 40% improvement in user retention reported after launch.',
            'proud_sale'     => 'Built a custom data visualization dashboard using D3.js and React that replaced 3 separate reporting tools.',
            'first_clients'  => 'I would reach out to early-stage startups needing their first professional frontend build, focusing on product designers I know personally.',
            'internal_notes' => [],
            'status'         => 'New',
        ]);

        JobApplication::create([
            'career_role_id' => $seniorDev->id,
            'name'           => 'Emmanuel Kipchirchir',
            'contact'        => '+254711223344',
            'resume_path'    => null,
            'years_exp'      => 5,
            'why_fit'        => 'I have 5 years building high-throughput backend systems using C++ and Rust with a focus on kernel-level networking optimizations.',
            'largest_deal'   => 'Led a team that migrated a 10TB PostgreSQL database with zero downtime for a Nairobi bank.',
            'proud_sale'     => 'Negotiated a KES 3M infrastructure contract by demonstrating a live benchmark that beat the competitor\'s system by 3x.',
            'first_clients'  => 'I would target enterprise clients in banking and insurance who need low-latency processing and compliance-grade audit logs.',
            'internal_notes' => [],
            'status'         => 'Interview',
        ]);
    }
}
