<?php

namespace App\Filament\Pages;

use App\Models\QuoteSubmission;
use App\Models\FastInquiry;
use App\Models\ContactSubmission;
use App\Models\AuditLog;
use App\Models\Invoice;
use App\Mail\QuoteEstimateGeneratedMail;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Livewire\Attributes\On;

class LeadsAndInquiries extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationLabel = 'Leads & Inquiries';
    protected static ?int $navigationSort = 5;
    protected string $view = 'filament.pages.leads-and-inquiries';

    public function getHeading(): string
    {
        return 'Lead & Inquiry Inbox';
    }

    public function getSubheading(): ?string
    {
        return 'Centralized inbound quote calculations, fast inquiries, and contacts';
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
        return 'Leads & Inquiries';
    }

    public static function getNavigationBadge(): ?string
    {
        $newCount = QuoteSubmission::where('status', 'New')->count()
                  + FastInquiry::where('status', 'New')->count()
                  + ContactSubmission::where('status', 'Unread')->count();

        return $newCount > 0 ? (string) $newCount : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    // Active Tab state: 'quotes', 'inquiries', 'contacts'
    public string $activeTab = 'quotes';

    // Global Search Query
    public string $search = '';

    // Filters
    public string $statusFilter = 'All'; // Global/Tab specific status filter
    public string $quoteOrigin = 'All'; // Tab 1 origin filter
    public string $quoteService = 'All'; // Tab 1 service filter

    // Details state
    public ?int $selectedQuoteId = null;
    public ?int $selectedInquiryId = null;

    // Internal Notes inputs
    public string $newQuoteNote = '';
    public string $newInquiryNote = '';

    // Auto-Responder SMTP configuration
    public bool $autoResponderEnabled = true;
    public string $smtpTemplateBody = "Dear {full_name},\n\nThank you for reaching out to Waveron Technologies.\n\nWe have received your message regarding \"{subject}\" and our team of systems architects is currently reviewing your request. We will be in touch within 24 hours.\n\nBest regards,\nWaveron Admin Engine";

    // ─── Computed Stats ───────────

    public function getStatsProperty(): array
    {
        $totalQuotes = QuoteSubmission::count();
        $totalInquiries = FastInquiry::count();
        $totalContacts = ContactSubmission::count();
        $accumulatedSubmissions = $totalQuotes + $totalInquiries + $totalContacts;

        $convertedQuotes = QuoteSubmission::where('status', 'Converted')->count();
        $conversionRate = $totalQuotes > 0 ? round(($convertedQuotes / $totalQuotes) * 100) : 0;

        $funnelValue = QuoteSubmission::where('status', 'Converted')->sum('estimated_total');

        $awaitingFollowUp = FastInquiry::where('status', 'New')->count() + ContactSubmission::where('status', 'Unread')->count();

        return [
            'accumulated' => $accumulatedSubmissions,
            'funnel_value' => $funnelValue,
            'conversion_rate' => $conversionRate,
            'awaiting_follow_up' => $awaitingFollowUp,
        ];
    }

    // ─── Data Accessors ───────────

    public function getQuotesProperty()
    {
        $query = QuoteSubmission::latest();

        if ($this->search) {
            $s = $this->search;
            $query->where(function ($q) use ($s) {
                $q->where('user_email', 'like', "%{$s}%")
                  ->orWhere('company', 'like', "%{$s}%")
                  ->orWhere('service_type', 'like', "%{$s}%");
            });
        }

        if ($this->statusFilter !== 'All') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->quoteService !== 'All') {
            $query->where('service_type', 'like', "%{$this->quoteService}%");
        }

        return $query->get();
    }

    public function getQuotesCountProperty(): int
    {
        return QuoteSubmission::count();
    }

    public function getInquiriesProperty()
    {
        $query = FastInquiry::latest();

        if ($this->search) {
            $s = $this->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('company', 'like', "%{$s}%")
                  ->orWhere('services_requested', 'like', "%{$s}%");
            });
        }

        if ($this->statusFilter !== 'All') {
            $query->where('status', $this->statusFilter);
        }

        return $query->get();
    }

    public function getInquiriesCountProperty(): int
    {
        return FastInquiry::count();
    }

    public function getContactsProperty()
    {
        $query = ContactSubmission::latest();

        if ($this->search) {
            $s = $this->search;
            $query->where(function ($q) use ($s) {
                $q->where('full_name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('company', 'like', "%{$s}%")
                  ->orWhere('subject', 'like', "%{$s}%");
            });
        }

        if ($this->statusFilter !== 'All') {
            $query->where('status', $this->statusFilter);
        }

        return $query->get();
    }

    public function getContactsCountProperty(): int
    {
        return ContactSubmission::count();
    }

    public function getSelectedQuoteProperty(): ?QuoteSubmission
    {
        if (!$this->selectedQuoteId) return null;
        return QuoteSubmission::find($this->selectedQuoteId);
    }

    public function getSelectedInquiryProperty(): ?FastInquiry
    {
        if (!$this->selectedInquiryId) return null;
        return FastInquiry::find($this->selectedInquiryId);
    }

    // ─── Actions ───────────

    public function selectTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->statusFilter = 'All';
        $this->search = '';
        $this->selectedQuoteId = null;
        $this->selectedInquiryId = null;
    }

    public function examineQuote(int $id): void
    {
        $this->selectedQuoteId = $id;
    }

    public function closeQuoteDetails(): void
    {
        $this->selectedQuoteId = null;
    }

    public function examineInquiry(int $id): void
    {
        $this->selectedInquiryId = $id;
        // Mark contacted automatically if new when reviewing
        $inquiry = FastInquiry::find($id);
        if ($inquiry && $inquiry->status === 'New') {
            $inquiry->update(['status' => 'Contacted']);
        }
    }

    public function closeInquiryDetails(): void
    {
        $this->selectedInquiryId = null;
    }

    public function updateQuoteStatus(int $id, string $status): void
    {
        $quote = QuoteSubmission::findOrFail($id);
        $quote->update(['status' => $status]);

        if ($status === 'Converted' && !Invoice::where('quote_submission_id', $quote->id)->exists()) {
            $invNum = Invoice::generateNextNumber();

            Invoice::create([
                'invoice_number'      => $invNum,
                'project_type'        => $quote->service_type ?: 'Dynamic Web Applications',
                'client_name'         => $quote->company ?: ($quote->user_email ? strtok($quote->user_email, '@') : 'Valued Client'),
                'client_email'        => $quote->user_email ?: 'client@waveron.co.ke',
                'client_phone'        => '+254 700 000 000',
                'project_brief'       => "Converted from Quote Run #{$quote->id} (" . implode(', ', $quote->selected_features ?: []) . ")",
                'amount'              => $quote->estimated_total,
                'status'              => 'Sent',
                'issued_at'           => now()->format('Y-m-d'),
                'due_at'              => now()->addDays(14)->format('Y-m-d'),
                'credit_terms'        => 'Standard Net-14',
                'quote_submission_id' => $quote->id,
            ]);

            AuditLog::logAction('Invoice Auto-Issued', "Auto-issued statement {$invNum} for converted Quote Run #{$quote->id}", 'Invoice', null);
        }

        AuditLog::logAction('Quote Status Updated', "Updated Quote Run #{$quote->id} status to '{$status}'", 'QuoteSubmission', $quote->id);

        Notification::make()
            ->title('Conversion State Updated')
            ->body("Quote status changed to {$status}.")
            ->success()
            ->send();
    }

    public function updateInquiryStatus(int $id, string $status): void
    {
        $inquiry = FastInquiry::findOrFail($id);
        $inquiry->update(['status' => $status]);

        AuditLog::logAction('Inquiry Status Updated', "Updated Fast Inquiry #{$inquiry->id} status to '{$status}'", 'FastInquiry', $inquiry->id);

        Notification::make()
            ->title('Pipeline State Updated')
            ->body("Inquiry status changed to {$status}.")
            ->success()
            ->send();
    }

    public function addQuoteNote(): void
    {
        if (!$this->newQuoteNote || !$this->selectedQuoteId) return;

        $quote = QuoteSubmission::findOrFail($this->selectedQuoteId);
        $notes = $quote->internal_notes ? $quote->internal_notes . "\n" : '';
        $notes .= '[Admin ' . now()->format('d/m/Y H:i') . ']: ' . trim($this->newQuoteNote);
        $quote->update(['internal_notes' => $notes]);
        $this->newQuoteNote = '';

        Notification::make()
            ->title('Internal Note Added')
            ->success()
            ->send();
    }

    public function addInquiryNote(): void
    {
        if (!$this->newInquiryNote || !$this->selectedInquiryId) return;

        $inquiry = FastInquiry::findOrFail($this->selectedInquiryId);
        $notes = $inquiry->internal_notes ?? [];
        $notes[] = '[Admin ' . now()->format('d M Y') . ']: ' . trim($this->newInquiryNote);
        $inquiry->update(['internal_notes' => $notes]);
        $this->newInquiryNote = '';

        Notification::make()
            ->title('Internal Note Added')
            ->success()
            ->send();
    }

    public function autoBindInquiry(int $quoteId): void
    {
        $quote = QuoteSubmission::findOrFail($quoteId);
        // Find inquiries from same email
        $inquiry = FastInquiry::where('email', $quote->user_email)->first();

        if ($inquiry) {
            // Bind together by appending note
            $qNotes = $quote->internal_notes ? $quote->internal_notes . "\n" : '';
            $qNotes .= '[System Bind ' . now()->format('d/m/Y H:i') . ']: Linked with Fast Inquiry #' . $inquiry->id;
            $quote->update(['internal_notes' => $qNotes]);

            $iNotes = $inquiry->internal_notes ?? [];
            $iNotes[] = '[System Bind ' . now()->format('d M Y') . ']: Linked with Quote Run #' . $quote->id;
            $inquiry->update(['internal_notes' => $iNotes]);

            AuditLog::logAction('Lead Bound', "Linked Quote Run #{$quote->id} with Fast Inquiry #{$inquiry->id} ({$inquiry->name})", 'QuoteSubmission', $quote->id);

            Notification::make()
                ->title('Lead Bound Successfully')
                ->body("Linked Quote Run #{$quote->id} with Fast Inquiry #{$inquiry->id} ({$inquiry->name}).")
                ->success()
                ->send();
        } else {
            Notification::make()
                ->title('No Matching Inquiry Found')
                ->body("Could not find a fast inquiry matching email: {$quote->user_email}")
                ->warning()
                ->send();
        }
    }

    public function toggleAutoResponder(): void
    {
        $this->autoResponderEnabled = !$this->autoResponderEnabled;
        Notification::make()
            ->title($this->autoResponderEnabled ? 'Auto-Responder Activated' : 'Auto-Responder Deactivated')
            ->info()
            ->send();
    }

    public function updateContactStatus(int $id, string $status): void
    {
        $contact = ContactSubmission::findOrFail($id);
        $contact->update(['status' => $status]);

        Notification::make()
            ->title('Contact Status Updated')
            ->success()
            ->send();
    }

    public function generateOfficialQuote(int $id): void
    {
        $inquiry = FastInquiry::findOrFail($id);

        // Map inquiry details to a QuoteSubmission
        // 1. Service Type mapping
        $serviceType = $inquiry->services_requested ?: 'Software Development (web/app platforms)';
        if (stripos($serviceType, 'Design') !== false) {
            $serviceType = 'Graphic / UI Design';
        } elseif (stripos($serviceType, 'Branding') !== false) {
            $serviceType = 'Branding & Strategy';
        } elseif (stripos($serviceType, 'Marketing') !== false) {
            $serviceType = 'Digital Marketing';
        }

        // 2. Pricing calculation: parse budget tier, or default if negotiation
        // Budget tier examples: "KES 1,500,000 - 3,000,000", "KES 800,000 - 1,500,000", "Over KES 3,000,000"
        $budget = $inquiry->budget ?: '';
        $estimatedTotal = 1500000; // default ballpark

        // Try to parse numbers from budget string
        preg_match_all('/\d[\d,.]*/', $budget, $matches);
        if (!empty($matches[0])) {
            // Clean formatting commas
            $nums = array_map(fn($val) => (int) str_replace(',', '', $val), $matches[0]);
            if (count($nums) >= 2) {
                // Mid-point
                $estimatedTotal = (int) (($nums[0] + $nums[1]) / 2);
            } else if (count($nums) === 1) {
                $estimatedTotal = $nums[0];
            }
        }

        // Create new QuoteSubmission
        $quote = QuoteSubmission::create([
            'service_type'      => $serviceType,
            'complexity'        => 'Standard MVP (Core flows)', // Default
            'timeline'          => $inquiry->timeline ?: 'Standard',
            'selected_features' => ['Core systems build', 'API endpoint configuration'], // Initial generic features
            'selected_addons'   => [],
            'estimated_total'   => $estimatedTotal,
            'user_email'        => $inquiry->email,
            'company'           => $inquiry->company,
            'status'            => 'New',
            'internal_notes'    => "[System converted " . now()->format('d/m/Y H:i') . "]: Generated from Fast Inquiry #{$inquiry->id}."
        ]);

        // Link/Bind them together
        $iNotes = $inquiry->internal_notes ?? [];
        $iNotes[] = '[System Convert ' . now()->format('d M Y') . ']: Converted into Quote Run #' . $quote->id;
        $inquiry->update([
            'status' => 'Qualified',
            'internal_notes' => $iNotes
        ]);

        // Select the newly generated quote and go to Tab 1
        $this->activeTab = 'quotes';
        $this->selectedQuoteId = $quote->id;
        $this->selectedInquiryId = null;

        AuditLog::logAction('Official Quote Generated', "Generated Quote Run #{$quote->id} (KES " . number_format($quote->estimated_total) . ") from Fast Inquiry #{$inquiry->id}", 'QuoteSubmission', $quote->id);

        try {
            Mail::to($quote->user_email)->send(new QuoteEstimateGeneratedMail($quote));
        } catch (\Exception $e) {
            // Log mail exception without crashing lead conversion
        }

        Notification::make()
            ->title('Official Quote Generated')
            ->body("Fast Inquiry #{$inquiry->id} has been converted to Quote Run #{$quote->id} and client notified via email.")
            ->success()
            ->send();
    }

    public function exportLeadsCsv(): StreamedResponse
    {
        $quotes = $this->getQuotesProperty();
        $inquiries = $this->getInquiriesProperty();

        AuditLog::logAction('Leads Exported', "Exported " . count($quotes) . " quotes and " . count($inquiries) . " inquiries to CSV", 'QuoteSubmission', null);

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=leads_export_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($quotes, $inquiries) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Type', 'ID / Ref', 'Name / Company', 'Email', 'Service / Scope', 'Estimate (KES)', 'Status', 'Date Submitted']);

            foreach ($quotes as $q) {
                fputcsv($file, [
                    'Quote Run',
                    '#QUO-' . $q->id,
                    $q->company ?: 'Client',
                    $q->user_email,
                    $q->service_type,
                    $q->estimated_total,
                    $q->status,
                    $q->created_at->format('Y-m-d H:i'),
                ]);
            }

            foreach ($inquiries as $inq) {
                fputcsv($file, [
                    'Fast Inquiry',
                    '#INQ-' . $inq->id,
                    $inq->name . ($inq->company ? " ({$inq->company})" : ''),
                    $inq->email,
                    $inq->services_requested,
                    $inq->budget,
                    $inq->status,
                    $inq->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'leads_export_' . date('Y-m-d') . '.csv', $headers);
    }

    public function deleteQuote(int $id): void
    {
        $quote = QuoteSubmission::findOrFail($id);
        $quote->delete();

        AuditLog::logAction('Quote Soft Deleted', "Soft deleted Quote Run #{$id}", 'QuoteSubmission', $id);

        $this->selectedQuoteId = null;

        Notification::make()
            ->title('Quote Archived')
            ->body("Quote Run #{$id} moved to Trash.")
            ->warning()
            ->send();
    }

    public function restoreQuote(int $id): void
    {
        $quote = QuoteSubmission::withTrashed()->findOrFail($id);
        $quote->restore();

        AuditLog::logAction('Quote Restored', "Restored Quote Run #{$id}", 'QuoteSubmission', $id);

        Notification::make()
            ->title('Quote Restored')
            ->success()
            ->send();
    }

    public function getQuoteBreakdown(QuoteSubmission $quote): array
    {
        $service = 'software';
        $serviceType = $quote->service_type;
        if (stripos($serviceType, 'Design') !== false) {
            $service = 'design';
        } elseif (stripos($serviceType, 'Branding') !== false) {
            $service = 'branding';
        } elseif (stripos($serviceType, 'Marketing') !== false) {
            $service = 'marketing';
        }

        $basePrice = 150000;
        if ($service === 'design') $basePrice = 85000;
        elseif ($service === 'branding') $basePrice = 65000;
        elseif ($service === 'marketing') $basePrice = 95000;

        $complexity = $quote->complexity ?: 'Standard';
        $complexityMultiplier = 1.0;
        if (stripos($complexity, 'Advanced') !== false || stripos($complexity, 'Multi-Platform') !== false || stripos($complexity, 'Complete Corporate') !== false || stripos($complexity, 'Multi-Channel') !== false) {
            if ($service === 'software') $complexityMultiplier = 1.35;
            elseif ($service === 'design') $complexityMultiplier = 1.4;
            elseif ($service === 'branding') $complexityMultiplier = 1.5;
            elseif ($service === 'marketing') $complexityMultiplier = 1.5;
        } elseif (stripos($complexity, 'Enterprise') !== false || stripos($complexity, 'Comprehensive') !== false || stripos($complexity, 'Global') !== false || stripos($complexity, 'Full Funnel') !== false) {
            if ($service === 'software') $complexityMultiplier = 1.8;
            elseif ($service === 'design') $complexityMultiplier = 1.9;
            elseif ($service === 'branding') $complexityMultiplier = 2.0;
            elseif ($service === 'marketing') $complexityMultiplier = 2.2;
        }

        $timeline = $quote->timeline ?: 'Standard';
        $timelineMultiplier = 1.0;
        if (stripos($timeline, 'Flexible') !== false) {
            $timelineMultiplier = 0.9;
        } elseif (stripos($timeline, 'Rush') !== false || stripos($timeline, 'Expedited') !== false) {
            $timelineMultiplier = 1.25;
        }

        $featuresCount = count($quote->selected_features ?? []);
        if ($featuresCount === 0) $featuresCount = 5; // default baseline
        $featureAdj = max(0.7, 1 + (($featuresCount - 5) * 0.06));

        $subtotal = round($basePrice * $complexityMultiplier * $timelineMultiplier * $featureAdj);

        $addons = [];
        $addonsTotal = 0;
        foreach ($quote->selected_addons ?? [] as $addonName) {
            $price = 0;
            if (stripos($addonName, 'Security') !== false || stripos($addonName, 'Patching') !== false) $price = 25000;
            elseif (stripos($addonName, 'Emergency') !== false || stripos($addonName, 'Support') !== false) $price = 20000;
            elseif (stripos($addonName, 'Behavioral') !== false || stripos($addonName, 'Analytics') !== false) $price = 15000;
            elseif (stripos($addonName, 'Testing') !== false || stripos($addonName, 'QA') !== false) $price = 30000;
            elseif (stripos($addonName, 'Lottie') !== false || stripos($addonName, 'Micro-Animations') !== false) $price = 15000;
            elseif (stripos($addonName, '3D') !== false || stripos($addonName, 'Illustrations') !== false) $price = 20000;
            elseif (stripos($addonName, 'A/B') !== false || stripos($addonName, 'abtesting') !== false) $price = 25000;
            elseif (stripos($addonName, 'Stationery') !== false || stripos($addonName, 'Pitch') !== false) $price = 15000;
            elseif (stripos($addonName, 'Motion') !== false || stripos($addonName, 'Animated') !== false) $price = 25000;
            elseif (stripos($addonName, 'Sonic') !== false || stripos($addonName, 'Jingle') !== false) $price = 30000;
            elseif (stripos($addonName, 'Backlink') !== false || stripos($addonName, 'SEO') !== false) $price = 30000;
            elseif (stripos($addonName, 'Influencer') !== false) $price = 35000;
            elseif (stripos($addonName, 'CRM') !== false || stripos($addonName, 'Funnel') !== false) $price = 20000;
            else $price = 15000; // sensible default for custom addons

            $addons[] = [
                'name' => $addonName,
                'price' => $price
            ];
            $addonsTotal += $price;
        }

        // Calculate discrepancy (if estimate was modified or because of rounding)
        $expectedTotal = $subtotal + $addonsTotal;
        $actualTotal = $quote->estimated_total;
        $adjustment = $actualTotal - $expectedTotal;

        return [
            'service' => $service,
            'base_price' => $basePrice,
            'complexity' => $complexity,
            'complexity_multiplier' => $complexityMultiplier,
            'timeline' => $timeline,
            'timeline_multiplier' => $timelineMultiplier,
            'features_count' => $featuresCount,
            'feature_adj' => $featureAdj,
            'subtotal' => $subtotal,
            'addons' => $addons,
            'addons_total' => $addonsTotal,
            'adjustment' => $adjustment,
            'total' => $actualTotal,
        ];
    }

    public function simulateInboundLead(): void
    {
        $type = rand(1, 3); // 1 = Quote, 2 = FastInquiry, 3 = Contact

        $companies = ['Safaricom Logistics', 'Equity Digital Labs', 'Nairobi Coffee Roasters', 'Savannah Safaris', 'Kilibox Cargo', 'Apex Brands East Africa'];
        $emails = ['tech-ops@safaricom-logistics.co.ke', 'labs@equitybank.co.ke', 'orders@nairobiroasters.co.ke', 'booking@savannahsafaris.com', 'founders@kilibox.co', 'info@apexbrands.co.ke'];
        $names = ['James Mwangi', 'Sylvia Wanjiku', 'David Ombati', 'Faith Chepngetich', 'Michael Ndwiga', 'Grace Mutua'];

        $i = array_rand($companies);
        $company = $companies[$i];
        $email = $emails[$i];
        $name = $names[$i];

        if ($type === 1) {
            $services = [
                'Software Development (web/app platforms)',
                'Graphic / UI Design',
                'Branding & Strategy'
            ];
            $complexities = ['Advanced Platform', 'MVP Launch Package', 'High Fidelity UI Kit'];
            $totals = [1845000, 650000, 1200000, 450000, 950000];

            $quote = QuoteSubmission::create([
                'service_type' => $services[array_rand($services)],
                'complexity' => $complexities[array_rand($complexities)],
                'timeline' => '2 - 3 Months',
                'selected_features' => ['Real-Time Live WebSockets', 'Custom AI Model Integration', 'Role-Based RBAC'],
                'selected_addons' => ['Continuous Security Auditing', '24/7 SLA-Backed Support'],
                'estimated_total' => $totals[array_rand($totals)],
                'user_email' => $email,
                'company' => $company,
                'status' => 'New',
                'internal_notes' => 'Interactive cost calculator submission received on website.',
            ]);

            $this->activeTab = 'quotes';
            $this->selectedQuoteId = $quote->id;

            Notification::make()
                ->title('Lead Calculator Submission Simulated')
                ->body("New Quote Run generated by {$email} of {$company}.")
                ->success()
                ->send();

        } elseif ($type === 2) {
            $scopes = [
                'Enterprise Web Portal & Fleet Tracking Systems',
                'Custom AI Customer Agent Integration',
                'M-Pesa Express API Checkout and CRM Syncer'
            ];
            $budgets = ['KES 1,500,000 - 3,000,000', 'KES 800,000 - 1,500,000', 'Over KES 3,000,000'];

            $inquiry = FastInquiry::create([
                'name' => $name,
                'email' => $email,
                'company' => $company,
                'budget' => $budgets[array_rand($budgets)],
                'timeline' => '2 - 3 Months',
                'services_requested' => $scopes[array_rand($scopes)],
                'project_details' => 'Simulated fast specification inquiry. We require custom integration to bind our systems with real-time analytics.',
                'status' => 'New',
                'internal_notes' => ['[Simulated crawler webhook]: Ingested raw form payload successfully.'],
            ]);

            $this->activeTab = 'inquiries';
            $this->selectedInquiryId = $inquiry->id;

            Notification::make()
                ->title('High-Intent Fast Inquiry Simulated')
                ->body("New specification sheet received from {$name} ({$company}).")
                ->success()
                ->send();

        } else {
            $subjects = [
                'Partnership Proposal for Tech Incubation',
                'Urgent custom consulting request',
                'API endpoint integration details'
            ];
            $messages = [
                'Hello Waveron Team, I represent a Nairobi-based tech incubator and we love your Engineering as Marketing tools. We would like to discuss possible integrations.',
                'Hi, we would like to schedule a quick Zoom call to review system capability profiles.',
                'Does your custom software offer direct container deployment to our private on-premise cloud infrastructure?'
            ];

            $contact = ContactSubmission::create([
                'full_name' => $name,
                'email' => $email,
                'company' => $company,
                'subject' => $subjects[array_rand($subjects)],
                'message' => $messages[array_rand($messages)],
                'budget' => 'KES 1,500,000 - 3,000,000',
                'timeline' => '2 - 3 Months',
                'services' => 'Software Development',
                'status' => 'Unread',
            ]);

            $this->activeTab = 'contacts';

            Notification::make()
                ->title('General Contact Message Simulated')
                ->body("New contact submission from {$name} regarding: {$contact->subject}")
                ->success()
                ->send();
        }
    }
}
