<?php

namespace App\Filament\Pages;

use App\Models\Invoice;
use App\Models\QuoteSubmission;
use App\Models\AuditLog;
use App\Mail\InvoiceSentMail;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Dompdf\Dompdf;
use Dompdf\Options;
use Livewire\Attributes\On;

class FinancialLedger extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Financial Ledgers';
    protected static ?int $navigationSort = 20;
    protected string $view = 'filament.pages.financial-ledger';

    public function getHeading(): string
    {
        return 'Billing & Financial Ledgers';
    }

    public function getSubheading(): ?string
    {
        return 'Manage client invoices, trigger simulated M-Pesa push requests, and track payments';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('headerStatus')
                ->view('filament.partials.header-status'),
            Action::make('simulateInboundLead')
                ->label('Simulate Inbound Lead')
                ->icon('heroicon-m-sparkles')
                ->color('info')
                ->action('simulateInboundLead'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Financial Ledgers';
    }

    public static function getNavigationBadge(): ?string
    {
        $overdue = Invoice::where('status', 'Overdue')->count();
        if ($overdue > 0) {
            return (string) $overdue;
        }

        $pending = Invoice::where('status', 'Sent')->count();
        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return Invoice::where('status', 'Overdue')->exists() ? 'danger' : 'warning';
    }

    // --- Search & Filter state ---
    public string $invoiceSearch = '';
    public string $invoiceStatusFilter = 'All';

    // --- Active/View State ---
    public ?int $activeInvoiceId = null;

    // --- View State: 'list', 'create', 'edit', 'mpesa' ---
    public string $currentView = 'list';
    public ?int $editingInvoiceId = null;

    // Form fields
    public string $invoiceNumber = '';
    public string $projectType = 'Dynamic Web Applications';
    public string $clientName = '';
    public string $clientEmail = '';
    public string $clientPhone = '';
    public string $projectBrief = '';
    public string $amount = '';
    public string $creditTerms = 'Standard Net-14';
    public string $issuedAt = '';
    public string $dueAt = '';
    public string $status = 'Draft';
    public ?int $quoteSubmissionId = null;

    // --- M-Pesa Simulation State ---
    public ?int $mpesaInvoiceId = null;
    public string $mpesaPhone = '';
    public string $mpesaPin = '';
    public bool $isPhonePrompterActive = true;
    public bool $isPaymentSuccessActive = false;

    public function mount(): void
    {
        $this->issuedAt = now()->format('Y-m-d');
        $this->recalculateDueDate();

        $quoteId = request()->query('quote_id');
        if ($quoteId) {
            $quote = QuoteSubmission::find($quoteId);
            if ($quote) {
                // Initialize default invoice number
                $this->invoiceNumber = Invoice::generateNextNumber();

                // Pre-fill fields from quote details
                $this->clientName = $quote->company ?: (explode('@', $quote->user_email)[0] ?: 'Client');
                $this->clientEmail = $quote->user_email;
                $this->amount = (string) $quote->estimated_total;
                $this->projectBrief = "Project: " . $quote->service_type . "\nScale: " . $quote->scale_and_timeline . "\nFeatures: " . implode(', ', $quote->selected_features ?? []);
                $this->quoteSubmissionId = $quote->id;
                $this->projectType = $quote->service_type ?: 'Dynamic Web Applications';

                $this->currentView = 'create';
            }
        }
    }

    public function updatedCreditTerms($value): void
    {
        $this->recalculateDueDate();
    }

    public function updatedIssuedAt($value): void
    {
        $this->recalculateDueDate();
    }

    private function recalculateDueDate(): void
    {
        if (!$this->issuedAt) return;
        try {
            $date = \Carbon\Carbon::parse($this->issuedAt);
            if ($this->creditTerms === 'Standard Net-14') {
                $date->addDays(14);
            } elseif ($this->creditTerms === 'Standard Net-30') {
                $date->addDays(30);
            }
            $this->dueAt = $date->format('Y-m-d');
        } catch (\Exception $e) {
            // Ignore parse errors
        }
    }

    public function getCalculatedDueDateStringProperty(): string
    {
        if (!$this->dueAt) return '';
        try {
            return \Carbon\Carbon::parse($this->dueAt)->format('l, d F Y');
        } catch (\Exception $e) {
            return '';
        }
    }

    // ─── Computed Properties ──────────────────────────────────────────────────

    public function getInvoicesProperty()
    {
        if ($this->invoiceStatusFilter === 'Trashed') {
            $query = Invoice::onlyTrashed();
        } else {
            $query = Invoice::query();

            // Status auto-check for Overdue
            Invoice::where('status', '!=', 'Paid')
                ->where('status', '!=', 'Void')
                ->where('status', '!=', 'Overdue')
                ->where('due_at', '<', now()->format('Y-m-d'))
                ->update(['status' => 'Overdue']);
        }

        if ($this->invoiceSearch) {
            $search = $this->invoiceSearch;
            $query->where(function ($q) use ($search) {
                $q->where('invoice_number', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('client_email', 'like', "%{$search}%")
                  ->orWhere('project_type', 'like', "%{$search}%");
            });
        }

        if ($this->invoiceStatusFilter !== 'All' && $this->invoiceStatusFilter !== 'Trashed') {
            $query->where('status', $this->invoiceStatusFilter);
        }

        return $query->orderBy('invoice_number', 'desc')->get();
    }

    private function renderInvoicePdf(Invoice $invoice): string
    {
        $options = new Options();
        $options->set('defaultFont', 'Helvetica');
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf($options);
        $html = view('pdf.invoice-statement', ['invoice' => $invoice])->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->output();
    }

    public function downloadPdfStatement(int $id)
    {
        $invoice = Invoice::withTrashed()->findOrFail($id);
        $pdfOutput = $this->renderInvoicePdf($invoice);

        AuditLog::logAction('Invoice PDF Downloaded', "Downloaded PDF statement {$invoice->invoice_number}", 'Invoice', $invoice->id);

        return response()->streamDownload(
            function () use ($pdfOutput) {
                echo $pdfOutput;
            },
            "Statement_{$invoice->invoice_number}.pdf",
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => "attachment; filename=\"Statement_{$invoice->invoice_number}.pdf\"",
            ]
        );
    }

    public function emailPdfStatement(int $id): void
    {
        $invoice = Invoice::findOrFail($id);

        if (empty($invoice->client_email)) {
            Notification::make()
                ->title('Missing Client Email')
                ->body("Cannot email statement: Invoice {$invoice->invoice_number} has no client email address set.")
                ->warning()
                ->send();
            return;
        }

        try {
            $pdfOutput = $this->renderInvoicePdf($invoice);

            Mail::to($invoice->client_email)->send(new InvoiceSentMail($invoice, $pdfOutput));
            
            AuditLog::logAction('Invoice Emailed', "Emailed statement {$invoice->invoice_number} PDF to {$invoice->client_email}", 'Invoice', $invoice->id);

            Notification::make()
                ->title('PDF Statement Emailed')
                ->body("Statement PDF successfully sent to {$invoice->client_email}.")
                ->success()
                ->send();
        } catch (\Exception $e) {
            Notification::make()
                ->title('Email Delivery Failed')
                ->body("Could not send email: " . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    public function exportInvoicesCsv(): StreamedResponse
    {
        $invoices = $this->getInvoicesProperty();

        AuditLog::logAction('Invoices Exported', "Exported " . count($invoices) . " invoice records to CSV", 'Invoice', null);

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=invoices_export_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($invoices) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Invoice Number', 'Client Name', 'Client Email', 'Client Phone', 'Project Type', 'Amount (KES)', 'Status', 'Credit Terms', 'Issued Date', 'Due Date']);

            foreach ($invoices as $inv) {
                fputcsv($file, [
                    $inv->invoice_number,
                    $inv->client_name,
                    $inv->client_email,
                    $inv->client_phone,
                    $inv->project_type,
                    $inv->amount,
                    $inv->status,
                    $inv->credit_terms,
                    $inv->issued_at ? \Illuminate\Support\Carbon::parse($inv->issued_at)->format('Y-m-d') : '',
                    $inv->due_at ? \Illuminate\Support\Carbon::parse($inv->due_at)->format('Y-m-d') : '',
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'invoices_export_' . date('Y-m-d') . '.csv', $headers);
    }

    public function restoreInvoice(int $id): void
    {
        $invoice = Invoice::withTrashed()->findOrFail($id);
        $invoice->restore();

        AuditLog::logAction('Invoice Restored', "Restored invoice statement {$invoice->invoice_number} from Trash", 'Invoice', $id);

        Notification::make()
            ->title('Invoice Restored')
            ->body("Statement {$invoice->invoice_number} has been restored.")
            ->success()
            ->send();
    }

    public function forceDeleteInvoice(int $id): void
    {
        $invoice = Invoice::withTrashed()->findOrFail($id);
        $num = $invoice->invoice_number;
        $invoice->forceDelete();

        AuditLog::logAction('Invoice Permanently Purged', "Permanently deleted invoice statement {$num}", 'Invoice', $id);

        Notification::make()
            ->title('Invoice Purged')
            ->body("Statement {$num} was permanently removed.")
            ->danger()
            ->send();
    }

    public function getStatsProperty(): array
    {
        $invoices = Invoice::all();

        // Dynamic Calculations
        $totalBilled = $invoices->sum('amount');
        $revenueCollected = $invoices->where('status', 'Paid')->sum('amount');
        $pendingCashflow = $invoices->whereIn('status', ['Draft', 'Sent'])->sum('amount');
        $arrearsOverdue = $invoices->where('status', 'Overdue')->sum('amount');

        return [
            'total_billed'      => 'KES ' . number_format($totalBilled),
            'revenue_collected' => 'KES ' . number_format($revenueCollected),
            'pending_cashflow'  => 'KES ' . number_format($pendingCashflow),
            'arrears_overdue'   => 'KES ' . number_format($arrearsOverdue),
        ];
    }

    public function getActiveInvoiceProperty(): ?Invoice
    {
        if (!$this->activeInvoiceId) return null;
        return Invoice::find($this->activeInvoiceId);
    }

    public function getQuoteSubmissionsProperty()
    {
        return QuoteSubmission::where('status', '!=', 'Converted')->latest()->get();
    }

    // ─── Auto-Fill Form from Quote ──────────────────────────────────────────────

    public function updatedQuoteSubmissionId($value): void
    {
        if (!$value) return;

        $quote = QuoteSubmission::find($value);
        if ($quote) {
            $this->projectType = $quote->service_type;
            $this->clientName = $quote->company ?? explode('@', $quote->user_email)[0];
            $this->clientEmail = $quote->user_email;
            $this->amount = (string) $quote->estimated_total;
            
            $features = implode(', ', $quote->selected_features ?? []);
            $addons = implode(', ', $quote->selected_addons ?? []);
            $this->projectBrief = "Complexity: {$quote->complexity}. Timeline: {$quote->timeline}.\nFeatures: {$features}.\nAddons: {$addons}.";
        }
    }

    // ─── Manual Actions ────────────────────────────────────────────────────────

    public function manualReconcile(int $id): void
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update(['status' => 'Paid']);

        AuditLog::logAction('Invoice Reconciled', "Manually reconciled statement {$invoice->invoice_number} to Paid status", 'Invoice', $invoice->id);

        Notification::make()
            ->title('Reconciliation Succeeded')
            ->body("Invoice {$invoice->invoice_number} marked as PAID.")
            ->success()
            ->send();
    }

    public function deleteInvoice(int $id): void
    {
        $invoice = Invoice::findOrFail($id);
        $invoiceNumber = $invoice->invoice_number;
        $invoice->delete();

        AuditLog::logAction('Invoice Deleted', "Deleted invoice statement {$invoiceNumber}", 'Invoice', $id);

        Notification::make()
            ->title('Invoice Deleted')
            ->body("Statement was successfully voided and removed.")
            ->warning()
            ->send();
    }

    // ─── Invoice Generation Forms ──────────────────────────────────────────────

    public function openCreateModal(): void
    {
        $this->resetForm();
        
        // Generate next invoice number
        $this->invoiceNumber = Invoice::generateNextNumber();

        $this->currentView = 'create';
    }

    public function createInvoice(): void
    {
        $this->validate([
            'invoiceNumber' => 'required|string|unique:invoices,invoice_number',
            'clientName'    => 'required|string|max:255',
            'clientEmail'   => 'required|email|max:255',
            'clientPhone'   => 'required|string',
            'amount'        => 'required|numeric|min:0',
            'projectBrief'  => 'required|string',
        ]);

        $invoice = Invoice::create([
            'invoice_number'      => $this->invoiceNumber,
            'project_type'        => $this->projectType,
            'client_name'         => $this->clientName,
            'client_email'        => $this->clientEmail,
            'client_phone'        => $this->clientPhone,
            'project_brief'       => $this->projectBrief,
            'amount'              => (int) $this->amount,
            'issued_at'           => $this->issuedAt,
            'due_at'              => $this->dueAt,
            'credit_terms'        => $this->creditTerms,
            'status'              => 'Sent', // Default to sent upon issuing
            'quote_submission_id' => $this->quoteSubmissionId ?: null,
        ]);

        AuditLog::logAction('Invoice Issued', "Issued invoice statement {$invoice->invoice_number} for KES {$invoice->amount} to {$invoice->client_name}", 'Invoice', $invoice->id);

        try {
            $pdfOutput = $this->renderInvoicePdf($invoice);
            Mail::to($invoice->client_email)->send(new InvoiceSentMail($invoice, $pdfOutput));
        } catch (\Exception $e) {
            // Log mail failure gracefully without aborting invoice creation
        }

        if ($this->quoteSubmissionId) {
            QuoteSubmission::find($this->quoteSubmissionId)?->update(['status' => 'Converted']);
        }

        $this->currentView = 'list';
        $this->resetForm();

        Notification::make()
            ->title('Invoice Issued')
            ->body('Statement generated and client notified via email.')
            ->success()
            ->send();
    }

    public function openEditModal(int $id): void
    {
        $invoice = Invoice::findOrFail($id);
        $this->editingInvoiceId = $id;
        $this->invoiceNumber = $invoice->invoice_number;
        $this->projectType = $invoice->project_type;
        $this->clientName = $invoice->client_name;
        $this->clientEmail = $invoice->client_email;
        $this->clientPhone = $invoice->client_phone;
        $this->projectBrief = $invoice->project_brief;
        $this->amount = (string) $invoice->amount;
        $this->creditTerms = $invoice->credit_terms;
        $this->issuedAt = $invoice->issued_at ? \Carbon\Carbon::parse($invoice->issued_at)->format('Y-m-d') : '';
        $this->dueAt = $invoice->due_at ? \Carbon\Carbon::parse($invoice->due_at)->format('Y-m-d') : '';
        $this->status = $invoice->status;
        $this->quoteSubmissionId = $invoice->quote_submission_id;

        $this->currentView = 'edit';
    }

    public function updateInvoice(): void
    {
        $this->validate([
            'clientName'   => 'required|string|max:255',
            'clientEmail'  => 'required|email|max:255',
            'clientPhone'  => 'required|string',
            'amount'       => 'required|numeric|min:0',
            'projectBrief' => 'required|string',
        ]);

        $invoice = Invoice::findOrFail($this->editingInvoiceId);
        $invoice->update([
            'project_type'  => $this->projectType,
            'client_name'   => $this->clientName,
            'client_email'  => $this->clientEmail,
            'client_phone'  => $this->clientPhone,
            'project_brief' => $this->projectBrief,
            'amount'        => (int) $this->amount,
            'issued_at'     => $this->issuedAt,
            'due_at'        => $this->dueAt,
            'credit_terms'  => $this->creditTerms,
            'status'        => $this->status,
        ]);

        AuditLog::logAction('Invoice Updated', "Updated invoice details for statement {$invoice->invoice_number} (Status: {$invoice->status})", 'Invoice', $invoice->id);

        $this->currentView = 'list';
        $this->resetForm();

        Notification::make()
            ->title('Invoice Updated')
            ->body('Billing ledger entry has been updated.')
            ->success()
            ->send();
    }

    // ─── M-Pesa Push Simulator ────────────────────────────────────────────────

    public function sendMpesaPush(int $id): void
    {
        $invoice = Invoice::findOrFail($id);
        $this->mpesaInvoiceId = $id;
        $this->mpesaPhone = $invoice->client_phone ?: '+254700000000';
        $this->mpesaPin = '';
        $this->isPhonePrompterActive = true;
        $this->isPaymentSuccessActive = false;
        $this->currentView = 'mpesa';
    }

    public function triggerSTKPush(): void
    {
        $this->validate([
            'mpesaPhone' => 'required|string|min:10',
        ]);

        // Proceed to PIN prompt screen
        $this->isPhonePrompterActive = false;
    }

    public function authorizeMpesaPayment(): void
    {
        $this->validate([
            'mpesaPin' => 'required|string|min:4|max:4',
        ]);

        $invoice = Invoice::findOrFail($this->mpesaInvoiceId);
        $invoice->update(['status' => 'Paid']);

        AuditLog::logAction('M-Pesa Payment Received', "M-Pesa payment authorized and verified for invoice {$invoice->invoice_number} (KES " . number_format($invoice->amount) . ")", 'Invoice', $invoice->id);

        $this->isPaymentSuccessActive = true;

        Notification::make()
            ->title('Payment Verified')
            ->body("Safaricom M-Pesa payment of KES " . number_format($invoice->amount) . " received successfully.")
            ->success()
            ->send();
    }

    public function closeMpesaModal(): void
    {
        $this->currentView = 'list';
        $this->mpesaInvoiceId = null;
        $this->mpesaPhone = '';
        $this->mpesaPin = '';
    }

    public function openStatementView(int $id): void
    {
        $this->activeInvoiceId = $id;
        $this->currentView = 'statement';
    }

    public function closeStatementView(): void
    {
        $this->activeInvoiceId = null;
        $this->currentView = 'list';
    }

    // ─── Simulate Inbound Lead / Statement ────────────────────────────────────

    public function simulateInboundLead(): void
    {
        $clientNames = ['Amina Abdi', 'David Ndii', 'Purity Muthoni', 'James Gikera', 'Sylvia Wanjiku'];
        $emails      = ['amina@equity.ke', 'ndii@consultancy.co.ke', 'purity@kengen.co.ke', 'james@nakuru-millers.co.ke', 'sylvia@expeditions.ke'];
        $phones      = ['+254712000101', '+254712000102', '+254712000103', '+254712000104', '+254712000105'];
        $briefs      = [
            'Enterprise API integrations with payment gateways.',
            'Corporate business forecasting dashboard and portal.',
            'KenGen custom supervisory control panel interface.',
            'Point of sale integration and central database setup.',
            'Tour booking platform and interactive safari itinerary builder.'
        ];
        $projectTypes = [
            'API Gateway Integration',
            'Business Intelligence Portal',
            'Custom Software Development',
            'Point of Sale Software',
            'Mobile Application Development'
        ];
        $amounts = [450000, 890000, 2400000, 520000, 1150000];

        $i = array_rand($clientNames);

        // Generate next invoice number
        $invNum = Invoice::generateNextNumber();

        Invoice::create([
            'invoice_number' => $invNum,
            'project_type'   => $projectTypes[$i],
            'client_name'    => $clientNames[$i],
            'client_email'   => $emails[$i],
            'client_phone'   => $phones[$i],
            'project_brief'  => $briefs[$i],
            'amount'         => $amounts[$i],
            'status'         => 'Sent',
            'issued_at'      => now()->format('Y-m-d'),
            'due_at'         => now()->addDays(14)->format('Y-m-d'),
            'credit_terms'   => 'Standard Net-14',
        ]);

        Notification::make()
            ->title('Simulated Inbound Invoice Generated')
            ->body("New invoice {$invNum} generated for {$clientNames[$i]} under 'Sent' status.")
            ->success()
            ->send();
    }

    private function resetForm(): void
    {
        $this->editingInvoiceId = null;
        $this->invoiceNumber = '';
        $this->projectType = 'Dynamic Web Applications';
        $this->clientName = '';
        $this->clientEmail = '';
        $this->clientPhone = '';
        $this->projectBrief = '';
        $this->amount = '';
        $this->creditTerms = 'Standard Net-14';
        $this->issuedAt = now()->format('Y-m-d');
        $this->dueAt = now()->addDays(14)->format('Y-m-d');
        $this->status = 'Draft';
        $this->quoteSubmissionId = null;
    }
}
