<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'invoice_number' => 'INV-2026-001',
            'project_type'   => 'Dynamic Web Applications',
            'client_name'    => 'Wanjiku Kamau',
            'client_email'   => 'wanjiku@m-soko.co.ke',
            'client_phone'   => '+254712009901',
            'project_brief'  => 'M-Soko Dispatch Fleet MVP Front-End Implementation',
            'amount'         => 650000,
            'status'         => 'Paid',
            'issued_at'      => '2026-07-01',
            'due_at'         => '2026-07-15',
            'credit_terms'   => 'Standard Net-14',
        ]);

        Invoice::create([
            'invoice_number' => 'INV-2026-002',
            'project_type'   => 'Custom Software Development',
            'client_name'    => 'Nicholas Kirui',
            'client_email'   => 'n.kirui@kiruiconsulting.com',
            'client_phone'   => '+254712009902',
            'project_brief'  => 'Athi Water SCADA Web Dashboard Integration Setup',
            'amount'         => 1500000,
            'status'         => 'Sent',
            'issued_at'      => '2026-07-06',
            'due_at'         => '2026-07-20',
            'credit_terms'   => 'Standard Net-14',
        ]);

        Invoice::create([
            'invoice_number' => 'INV-2026-003',
            'project_type'   => 'Custom Software Development',
            'client_name'    => 'Purity Wanjiku',
            'client_email'   => 'purity.wanjiku@innovate-east.com',
            'client_phone'   => '+254712009903',
            'project_brief'  => 'Custom AI Voice & Chat Customer Agent Integration',
            'amount'         => 950000,
            'status'         => 'Draft',
            'issued_at'      => '2026-07-08',
            'due_at'         => '2026-07-22',
            'credit_terms'   => 'Standard Net-14',
        ]);

        Invoice::create([
            'invoice_number' => 'INV-2026-004',
            'project_type'   => 'Mobile Application Development',
            'client_name'    => 'Collins Kipkemoi',
            'client_email'   => 'collins.k@safaritour.ke',
            'client_phone'   => '+254722334455',
            'project_brief'  => 'Safari Tour Android & iOS Custom Offline Booking App',
            'amount'         => 1845000,
            'status'         => 'Overdue',
            'issued_at'      => '2026-06-15',
            'due_at'         => '2026-06-29',
            'credit_terms'   => 'Standard Net-14',
        ]);
    }
}
