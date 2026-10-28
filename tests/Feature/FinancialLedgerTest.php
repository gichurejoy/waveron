<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Invoice;
use App\Models\QuoteSubmission;
use App\Models\AuditLog;
use Tests\TestCase;

class FinancialLedgerTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_creation_and_audit_log(): void
    {
        $invoice = Invoice::create([
            'invoice_number' => 'INV-2026-001',
            'project_type'   => 'Dynamic Web Applications',
            'client_name'    => 'Safaricom Tech',
            'client_email'   => 'ops@safaricom.co.ke',
            'client_phone'   => '+254712345678',
            'project_brief'  => 'Enterprise API & Portal Integration',
            'amount'         => 1500000,
            'issued_at'      => now()->format('Y-m-d'),
            'due_at'         => now()->addDays(14)->format('Y-m-d'),
            'credit_terms'   => 'Standard Net-14',
            'status'         => 'Sent',
        ]);

        $this->assertDatabaseHas('invoices', [
            'invoice_number' => 'INV-2026-001',
            'amount'         => 1500000,
            'status'         => 'Sent',
        ]);
    }

    public function test_invoice_status_transition_to_paid(): void
    {
        $invoice = Invoice::create([
            'invoice_number' => 'INV-2026-002',
            'project_type'   => 'Custom Software',
            'client_name'    => 'Equity Bank',
            'client_email'   => 'tech@equitybank.co.ke',
            'client_phone'   => '+254700000000',
            'project_brief'  => 'Core Banking Dashboard',
            'amount'         => 2400000,
            'issued_at'      => now()->format('Y-m-d'),
            'due_at'         => now()->addDays(14)->format('Y-m-d'),
            'credit_terms'   => 'Standard Net-14',
            'status'         => 'Sent',
        ]);

        $invoice->update(['status' => 'Paid']);

        $this->assertEquals('Paid', $invoice->fresh()->status);
    }

    public function test_overdue_status_calculation_for_past_due_invoices(): void
    {
        $pastInvoice = Invoice::create([
            'invoice_number' => 'INV-2026-003',
            'project_type'   => 'Graphic Design',
            'client_name'    => 'Kilibox Cargo',
            'client_email'   => 'finance@kilibox.co',
            'client_phone'   => '+254711223344',
            'project_brief'  => 'Brand Identity Redesign',
            'amount'         => 450000,
            'issued_at'      => now()->subDays(30)->format('Y-m-d'),
            'due_at'         => now()->subDays(10)->format('Y-m-d'),
            'credit_terms'   => 'Standard Net-14',
            'status'         => 'Sent',
        ]);

        // Trigger overdue check matching FinancialLedger logic
        Invoice::where('status', '!=', 'Paid')
            ->where('status', '!=', 'Void')
            ->where('due_at', '<', now()->format('Y-m-d'))
            ->update(['status' => 'Overdue']);

        $this->assertEquals('Overdue', $pastInvoice->fresh()->status);
    }

    public function test_audit_log_logging_helper(): void
    {
        $log = AuditLog::logAction('Invoice Issued', 'Issued test statement INV-999', 'Invoice', '999');

        $this->assertDatabaseHas('audit_logs', [
            'action' => 'Invoice Issued',
            'entity_type' => 'Invoice',
            'entity_id' => '999',
        ]);
    }

    public function test_generate_next_number_increments_and_respects_soft_deletes(): void
    {
        $year = now()->year;

        // No invoices yet
        $this->assertEquals("INV-{$year}-001", Invoice::generateNextNumber());

        // Create first invoice
        $inv1 = Invoice::create([
            'invoice_number' => "INV-{$year}-001",
            'project_type'   => 'Web App',
            'client_name'    => 'Test Client 1',
            'client_email'   => 'client1@test.com',
            'client_phone'   => '+254700000001',
            'project_brief'  => 'Test Brief 1',
            'amount'         => 100000,
            'issued_at'      => now()->format('Y-m-d'),
            'due_at'         => now()->addDays(14)->format('Y-m-d'),
        ]);

        $this->assertEquals("INV-{$year}-002", Invoice::generateNextNumber());

        // Soft delete the invoice
        $inv1->delete();

        // Must still return 002 even though 001 is soft deleted
        $this->assertEquals("INV-{$year}-002", Invoice::generateNextNumber());

        // Create 002 and soft delete it
        $inv2 = Invoice::create([
            'invoice_number' => "INV-{$year}-002",
            'project_type'   => 'Mobile App',
            'client_name'    => 'Test Client 2',
            'client_email'   => 'client2@test.com',
            'client_phone'   => '+254700000002',
            'project_brief'  => 'Test Brief 2',
            'amount'         => 200000,
            'issued_at'      => now()->format('Y-m-d'),
            'due_at'         => now()->addDays(14)->format('Y-m-d'),
        ]);
        $inv2->delete();

        // Must now return 003
        $this->assertEquals("INV-{$year}-003", Invoice::generateNextNumber());
    }

    public function test_quote_submission_scale_and_timeline_accessor(): void
    {
        $quote = QuoteSubmission::create([
            'service_type'    => 'Web App',
            'complexity'      => 'Enterprise Level',
            'timeline'        => '4-8 Weeks',
            'estimated_total' => 500000,
            'user_email'      => 'client@example.com',
        ]);

        $this->assertEquals('Enterprise Level / 4-8 Weeks', $quote->scale_and_timeline);
    }
}
