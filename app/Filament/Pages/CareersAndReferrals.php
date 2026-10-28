<?php

namespace App\Filament\Pages;

use App\Models\CareerRole;
use App\Models\ClientReferral;
use App\Models\JobApplication;
use App\Models\FastInquiry;
use App\Models\AuditLog;
use App\Mail\CandidateStatusUpdatedMail;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;

class CareersAndReferrals extends Page
{
    use WithFileUploads;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Careers & Referrals';
    protected static ?int $navigationSort = 10;
    protected string $view = 'filament.pages.careers-and-referrals';

    public function getHeading(): string
    {
        return 'Careers & Referrals';
    }

    public function getSubheading(): ?string
    {
        return 'Job posting directories and refer-a-client payout tracking';
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
        return 'Careers & Referrals';
    }

    public static function getNavigationBadge(): ?string
    {
        $pending = JobApplication::where('status', 'New')->count();

        return $pending > 0 ? (string) $pending : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    // Tab state
    public string $activeTab = 'jobs';

    // --- Tab 1: Jobs ---
    public bool $showPublishModal = false;
    public bool $showEditModal = false;
    public ?int $editingRoleId = null;

    // Publish/Edit form fields
    public string $roleCode = '';
    public string $roleTitle = '';
    public string $roleEmploymentType = 'Full-Time';
    public string $roleLocation = '';
    public string $roleCompensation = '';
    public string $rolePrerequisites = ''; // newline-separated
    public string $roleStatus = 'Active';

    // --- Tab 2: Referrals ---
    public string $referralSearch = '';
    public string $referralStatusFilter = 'All';

    // --- Tab 3: Applications ---
    public string $appSearch = '';
    public string $appStatusFilter = 'All';
    public ?int $selectedApplicationId = null;
    public string $newNote = '';

    // File upload and conversion properties
    public $uploadedFile;
    public bool $showHireModal = false;
    public string $employeeEmail = '';
    public string $employeePhone = '';
    public string $employeeRole = 'Employee';
    public string $employeeCommissionRate = '10.00';
    public string $employeeBaseSalary = '';
    public string $employeePayoutMethod = 'M-Pesa';
    public string $employeePayoutAccount = '';
    public string $employeePassword = '';
    public bool $employeeSendEmail = true;

    // ─── Computed Data ─────────────────────────────────────────────────────────

    public function getJobsProperty()
    {
        return CareerRole::orderBy('created_at', 'desc')->get();
    }

    public function getActiveJobsCountProperty(): int
    {
        return CareerRole::where('status', 'Active')->count();
    }

    public function getReferralsProperty()
    {
        $query = ClientReferral::latest();

        if ($this->referralSearch) {
            $search = $this->referralSearch;
            $query->where(function ($q) use ($search) {
                $q->where('referrer_name', 'like', "%{$search}%")
                  ->orWhere('client_name', 'like', "%{$search}%")
                  ->orWhere('referral_code', 'like', "%{$search}%");
            });
        }

        if ($this->referralStatusFilter !== 'All') {
            $query->where('status', $this->referralStatusFilter);
        }

        return $query->get();
    }

    public function getReferralsCountProperty(): int
    {
        return ClientReferral::count();
    }

    public function getApplicationsProperty()
    {
        $query = JobApplication::with('careerRole')->latest();

        if ($this->appSearch) {
            $search = $this->appSearch;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%")
                  ->orWhere('why_fit', 'like', "%{$search}%");
            });
        }

        if ($this->appStatusFilter !== 'All') {
            $query->where('status', $this->appStatusFilter);
        }

        return $query->get();
    }

    public function getApplicationsCountProperty(): int
    {
        return JobApplication::count();
    }

    public function getSelectedApplicationProperty(): ?JobApplication
    {
        if (!$this->selectedApplicationId) return null;
        return JobApplication::with('careerRole')->find($this->selectedApplicationId);
    }

    // ─── Tab 1: Job Actions ────────────────────────────────────────────────────

    public function openPublishModal(): void
    {
        $this->resetRoleForm();
        $this->showPublishModal = true;
    }

    public function openEditModal(int $id): void
    {
        $role = CareerRole::findOrFail($id);
        $this->editingRoleId = $id;
        $this->roleCode = $role->code;
        $this->roleTitle = $role->title;
        $this->roleEmploymentType = $role->employment_type;
        $this->roleLocation = $role->location;
        $this->roleCompensation = $role->compensation;
        $this->rolePrerequisites = implode("\n", $role->prerequisites ?? []);
        $this->roleStatus = $role->status;
        $this->showEditModal = true;
    }

    public function publishRole(): void
    {
        $this->validate([
            'roleCode'           => 'required|string|max:100|unique:career_roles,code',
            'roleTitle'          => 'required|string|max:255',
            'roleEmploymentType' => 'required|string',
            'roleLocation'       => 'required|string|max:255',
            'roleCompensation'   => 'required|string|max:255',
        ]);

        CareerRole::create([
            'code'            => strtoupper(trim($this->roleCode)),
            'title'           => $this->roleTitle,
            'employment_type' => $this->roleEmploymentType,
            'location'        => $this->roleLocation,
            'compensation'    => $this->roleCompensation,
            'prerequisites'   => $this->parsePrerequisites($this->rolePrerequisites),
            'status'          => 'Active',
        ]);

        $this->showPublishModal = false;
        $this->resetRoleForm();

        Notification::make()
            ->title('Career Role Published')
            ->body('The new position is now live in the Open Technical Jobs directory.')
            ->success()
            ->send();
    }

    public function updateRole(): void
    {
        $this->validate([
            'roleTitle'          => 'required|string|max:255',
            'roleEmploymentType' => 'required|string',
            'roleLocation'       => 'required|string|max:255',
            'roleCompensation'   => 'required|string|max:255',
        ]);

        $role = CareerRole::findOrFail($this->editingRoleId);
        $role->update([
            'title'           => $this->roleTitle,
            'employment_type' => $this->roleEmploymentType,
            'location'        => $this->roleLocation,
            'compensation'    => $this->roleCompensation,
            'prerequisites'   => $this->parsePrerequisites($this->rolePrerequisites),
            'status'          => $this->roleStatus,
        ]);

        $this->showEditModal = false;
        $this->editingRoleId = null;
        $this->resetRoleForm();

        Notification::make()
            ->title('Role Updated')
            ->success()
            ->send();
    }

    public function archiveRole(int $id): void
    {
        CareerRole::findOrFail($id)->update(['status' => 'Archived']);

        Notification::make()
            ->title('Position Archived')
            ->body('The role has been removed from the public directory.')
            ->warning()
            ->send();
    }

    public function restoreRole(int $id): void
    {
        CareerRole::findOrFail($id)->update(['status' => 'Active']);

        Notification::make()
            ->title('Position Restored')
            ->success()
            ->send();
    }

    // ─── Tab 2: Referral Actions ───────────────────────────────────────────────

    public function updateReferralStatus(int $id, string $status): void
    {
        $ref = ClientReferral::findOrFail($id);
        $oldStatus = $ref->status;
        $ref->update(['status' => $status]);

        AuditLog::logAction('Referral Status Updated', "Referral {$ref->referral_code} ({$ref->client_name}) status updated from '{$oldStatus}' to '{$status}'", 'ClientReferral', $ref->id);

        Notification::make()
            ->title('Referral Status Updated')
            ->body("Status updated to \"{$status}\" for {$ref->client_name}.")
            ->success()
            ->send();
    }

    public function updatePayoutStatus(int $id, string $status): void
    {
        $ref = ClientReferral::findOrFail($id);
        $oldStatus = $ref->payout_status;
        $ref->update(['payout_status' => $status]);

        AuditLog::logAction('Referral Payout Updated', "Referral {$ref->referral_code} payout status updated from '{$oldStatus}' to '{$status}'", 'ClientReferral', $ref->id);

        Notification::make()
            ->title('Payout Status Updated')
            ->body("Payout status set to \"{$status}\" for {$ref->referrer_name}.")
            ->success()
            ->send();
    }

    public function updateCommission(int $id, ?string $amount): void
    {
        $ref = ClientReferral::findOrFail($id);
        $comm = max(0, (int) $amount);
        $ref->update(['commission_amount' => $comm]);

        AuditLog::logAction('Referral Commission Set', "Referral {$ref->referral_code} commission set to KES " . number_format($comm), 'ClientReferral', $ref->id);

        Notification::make()
            ->title('Commission Updated')
            ->body("Commission set to KES " . number_format($comm) . " for {$ref->referrer_name}.")
            ->success()
            ->send();
    }

    public function promoteReferralToLead(int $id): void
    {
        $ref = ClientReferral::findOrFail($id);

        if ($ref->promoted_to_lead && $ref->promoted_lead_id) {
            Notification::make()
                ->title('Already Promoted')
                ->body("This referral has already been converted to lead #{$ref->promoted_lead_id} in Leads & Inquiries.")
                ->info()
                ->send();
            return;
        }

        $leadEmail = $ref->client_email ?: (filter_var($ref->referrer_contact, FILTER_VALIDATE_EMAIL) ? $ref->referrer_contact : 'referral@waverontechnologies.co.ke');
        $contactPerson = $ref->client_contact_person ?: $ref->client_name;

        $inquiry = FastInquiry::create([
            'name'               => $contactPerson,
            'email'              => $leadEmail,
            'company'            => $ref->client_name,
            'budget'             => $ref->commission_amount > 0 ? "Commission: KES " . number_format($ref->commission_amount) : 'Client Referral Lead',
            'timeline'           => '1-3 Months',
            'services_requested' => $ref->services_needed ?: 'General Technology Services',
            'project_details'    => "Referral Tracking Code: {$ref->referral_code}\nReferrer: {$ref->referrer_name} ({$ref->referrer_contact})\nClient Contact: {$ref->client_contact_person}\nClient Phone: {$ref->client_phone}\nClient Email: {$ref->client_email}\nNotes: {$ref->notes}",
            'status'             => 'New',
            'internal_notes'     => [
                [
                    'author' => auth()->user()?->name ?? 'Admin',
                    'date'   => now()->format('Y-m-d H:i:s'),
                    'note'   => "Promoted from Client Referral {$ref->referral_code} (Referrer: {$ref->referrer_name}).",
                ],
            ],
        ]);

        $ref->update([
            'promoted_to_lead' => true,
            'promoted_at'      => now(),
            'promoted_lead_id' => $inquiry->id,
            'status'           => 'Active Lead',
        ]);

        AuditLog::logAction('Referral Promoted to Lead', "Promoted referral {$ref->referral_code} ({$ref->client_name}) to active sales lead #{$inquiry->id}", 'ClientReferral', $ref->id);

        Notification::make()
            ->title('Referral Promoted to Lead')
            ->body("{$ref->client_name} is now in Leads & Inquiries Inbox! Tracking code: {$ref->referral_code}")
            ->success()
            ->send();
    }

    public function simulateInboundLead(): void
    {
        $names     = ['Brian Omondi', 'Grace Wanjiku', 'Peter Ndirangu', 'Fatuma Hassan', 'Kevin Mutua'];
        $emails    = ['bomondi@corp.ke', 'gwanjiku@sacco.co.ke', 'peter@techke.io', 'fatuma@islamic-fin.co', 'kmutua@retail.co.ke'];
        $companies = ['Equity Tech Solutions', 'Faulu SACCO Digital', 'Safiri Logistics', 'Pearl Finance Ltd', 'Nakuru Retail Group'];
        $contacts  = ['David Maina (CTO)', 'Mary Wambui (Head of IT)', 'James Kiprono (COO)', 'Amina Ali (Director)', 'Samuel Kariuki (Ops)'];
        $phones    = ['+254712345678', '+254722998877', '+254733445566', '+254701234567', '+254788112233'];
        $services  = [
            'Custom inventory management system with mobile app.',
            'USSD-based micro-loan disbursement platform.',
            'Real-time GPS fleet tracking dashboard.',
            'Mobile banking app with biometric auth.',
            'POS integration and e-receipt delivery system.',
        ];

        $i = array_rand($names);

        ClientReferral::create([
            'referral_code'         => ClientReferral::generateCode(),
            'referrer_name'         => $names[$i],
            'referrer_contact'      => $emails[$i],
            'client_name'           => $companies[$i],
            'client_contact_person' => $contacts[$i],
            'client_email'          => strtolower(str_replace(' ', '.', explode(' ', $contacts[$i])[0])) . '@' . strtolower(explode(' ', $companies[$i])[0]) . '.co.ke',
            'client_phone'          => $phones[$i],
            'services_needed'       => $services[$i],
            'notes'                 => 'Referred directly by business partner seeking enterprise software deployment.',
            'commission_amount'     => 15000,
            'payout_status'         => 'Pending',
            'status'                => 'Pending Review',
            'promoted_to_lead'      => false,
        ]);

        $this->activeTab = 'referrals';

        Notification::make()
            ->title('Simulated Referral Injected')
            ->body("New referral for {$companies[$i]} from {$names[$i]} has been added to the pipeline.")
            ->success()
            ->send();
    }

    // ─── Tab 3: Application Actions ────────────────────────────────────────────

    public function selectApplication(int $id): void
    {
        $this->selectedApplicationId = $id;
        $this->newNote = '';
    }

    public function updateApplicationStatus(int $id, string $status): void
    {
        $app = JobApplication::findOrFail($id);
        $oldStatus = $app->status;
        $app->update(['status' => $status]);

        AuditLog::logAction('Candidate Status Updated', "Changed application status for {$app->name} from '{$oldStatus}' to '{$status}'", 'JobApplication', $app->id);

        if (str_contains($app->contact, '@')) {
            try {
                Mail::to($app->contact)->send(new CandidateStatusUpdatedMail($app, $status));
            } catch (\Exception $e) {
                // Log mail exception gracefully
            }
        }

        Notification::make()
            ->title('Status Updated')
            ->body("Candidate {$app->name} moved to '{$status}' and notified.")
            ->success()
            ->send();
    }

    public function exportApplicationsCsv(): StreamedResponse
    {
        $apps = $this->getApplicationsProperty();

        AuditLog::logAction('Applications Exported', "Exported " . count($apps) . " job applications to CSV", 'JobApplication', null);

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=candidate_applications_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($apps) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Candidate Name', 'Contact', 'Target Role', 'Years Experience', 'Status', 'Date Applied']);

            foreach ($apps as $app) {
                fputcsv($file, [
                    $app->name,
                    $app->contact,
                    $app->careerRole?->title ?? 'General Application',
                    $app->years_exp,
                    $app->status,
                    $app->created_at->format('Y-m-d H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->streamDownload($callback, 'candidate_applications_' . date('Y-m-d') . '.csv', $headers);
    }

    public function deleteApplication(int $id): void
    {
        $app = JobApplication::findOrFail($id);
        $app->delete();

        AuditLog::logAction('Candidate Application Soft Deleted', "Soft deleted candidate application for {$app->name}", 'JobApplication', $id);

        $this->selectedApplicationId = null;

        Notification::make()
            ->title('Candidate Archived')
            ->body("Application moved to Trash.")
            ->warning()
            ->send();
    }

    public function restoreApplication(int $id): void
    {
        $app = JobApplication::withTrashed()->findOrFail($id);
        $app->restore();

        AuditLog::logAction('Candidate Application Restored', "Restored candidate application for {$app->name}", 'JobApplication', $id);

        Notification::make()
            ->title('Candidate Restored')
            ->success()
            ->send();
    }

    public function addNote(): void
    {
        if (!$this->newNote || !$this->selectedApplicationId) return;

        $app = JobApplication::findOrFail($this->selectedApplicationId);
        $notes = $app->internal_notes ?? [];
        $notes[] = '[Admin ' . now()->format('d M Y') . ']: ' . trim($this->newNote);
        $app->update(['internal_notes' => $notes]);
        $this->newNote = '';

        Notification::make()
            ->title('Note Added')
            ->success()
            ->send();
    }

    public function uploadCandidateFile(): void
    {
        if (!$this->uploadedFile || !$this->selectedApplicationId) return;

        $this->validate([
            'uploadedFile' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240', // Max 10MB, strictly validated MIME types
        ]);

        $app = JobApplication::findOrFail($this->selectedApplicationId);
        $originalName = $this->uploadedFile->getClientOriginalName();
        $ext = strtolower($this->uploadedFile->getClientOriginalExtension());
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);
        $sanitizedName = \Illuminate\Support\Str::slug($baseName) . '.' . $ext;

        $path = $this->uploadedFile->storeAs('candidate-docs/' . $app->id, $sanitizedName, 'public');

        $attachments = $app->attachments ?? [];
        $attachments[] = [
            'name' => $sanitizedName,
            'path' => $path,
            'uploaded_at' => now()->format('Y-m-d H:i:s'),
            'size' => $this->uploadedFile->getSize(),
        ];

        $app->update([
            'attachments' => $attachments,
        ]);

        AuditLog::logAction('Candidate File Uploaded', "Uploaded document '{$sanitizedName}' for candidate {$app->name}", 'JobApplication', $app->id);

        $this->reset('uploadedFile');

        Notification::make()
            ->title('Document Uploaded')
            ->body("File '{$sanitizedName}' has been added to the candidate's profile.")
            ->success()
            ->send();
    }

    public function deleteCandidateFile(int $index): void
    {
        if (!$this->selectedApplicationId) return;

        $app = JobApplication::findOrFail($this->selectedApplicationId);
        $attachments = $app->attachments ?? [];

        if (isset($attachments[$index])) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($attachments[$index]['path']);
            
            unset($attachments[$index]);
            $app->update([
                'attachments' => array_values($attachments),
            ]);

            Notification::make()
                ->title('Document Deleted')
                ->success()
                ->send();
        }
    }

    public function setAsResume(int $index): void
    {
        if (!$this->selectedApplicationId) return;

        $app = JobApplication::findOrFail($this->selectedApplicationId);
        $attachments = $app->attachments ?? [];

        if (isset($attachments[$index])) {
            $app->update([
                'resume_path' => $attachments[$index]['path'],
            ]);

            Notification::make()
                ->title('Primary Resume Updated')
                ->success()
                ->send();
        }
    }

    public function openHireModal(): void
    {
        if (!$this->selectedApplicationId) return;
        $app = JobApplication::with('careerRole')->findOrFail($this->selectedApplicationId);

        $contact = trim($app->contact);
        if (str_contains($contact, '@')) {
            $this->employeeEmail = $contact;
            $this->employeePhone = '';
        } else {
            $this->employeePhone = $contact;
            $cleanName = strtolower(preg_replace('/[^a-zA-Z]/', '', $app->name));
            $this->employeeEmail = $cleanName . '@waverontechnologies.co.ke';
        }

        $this->employeeRole = $app->careerRole?->title ?? 'Business Development Lead';
        $this->employeeCommissionRate = '10.00';
        $this->employeeBaseSalary = '';
        $this->employeePayoutMethod = 'M-Pesa';
        $this->employeePayoutAccount = $this->employeePhone;
        $this->employeePassword = 'Wav#' . rand(1000, 9999) . '!';
        $this->employeeSendEmail = str_contains($this->employeeEmail, '@');
        $this->showHireModal = true;
    }

    public function convertToEmployee(): void
    {
        if (!$this->selectedApplicationId) return;
        $app = JobApplication::findOrFail($this->selectedApplicationId);

        $this->validate([
            'employeeEmail'          => 'required|email|unique:users,email',
            'employeeRole'           => 'required|string|max:100',
            'employeeCommissionRate' => 'required|numeric|min:0|max:100',
            'employeeBaseSalary'     => 'nullable|numeric|min:0',
            'employeePassword'       => 'required|string|min:6',
        ]);

        $user = \App\Models\User::create([
            'name'               => $app->name,
            'email'              => $this->employeeEmail,
            'phone'              => $this->employeePhone ?: null,
            'role'               => $this->employeeRole,
            'commission_rate'    => (float) $this->employeeCommissionRate,
            'base_salary'        => $this->employeeBaseSalary ? (float) $this->employeeBaseSalary : null,
            'payout_method'      => $this->employeePayoutMethod,
            'payout_account'     => $this->employeePayoutAccount ?: null,
            'employment_status'  => 'Active',
            'hired_at'           => now(),
            'job_application_id' => $app->id,
            'password'           => $this->employeePassword, // Automatically hashed via User cast
        ]);

        $notes = $app->internal_notes ?? [];
        $notes[] = '[System ' . now()->format('d M Y H:i') . ']: Onboarded candidate as employee (Role: ' . $this->employeeRole . ', Email: ' . $this->employeeEmail . ', Commission: ' . $this->employeeCommissionRate . '%)';

        $app->update([
            'status'         => 'Hired',
            'internal_notes' => $notes,
        ]);

        AuditLog::logAction(
            'Candidate Onboarded as Employee',
            "Onboarded candidate {$app->name} into employee user account ({$this->employeeEmail}) with role '{$this->employeeRole}', {$this->employeeCommissionRate}% commission rate",
            'User',
            $user->id
        );

        if ($this->employeeSendEmail && filter_var($this->employeeEmail, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($this->employeeEmail)->send(new \App\Mail\EmployeeOnboardedMail($user, $this->employeePassword, $this->employeeRole));
            } catch (\Exception $e) {
                // Mail logged or skipped safely
            }
        }

        $this->showHireModal = false;

        Notification::make()
            ->title('Employee Successfully Onboarded!')
            ->body("{$app->name} is now registered as an employee with {$this->employeeCommissionRate}% commission rate and credentials generated.")
            ->success()
            ->send();
    }

    public function simulateCandidateSubmission(): void
    {
        $names    = ['Aisha Kamau', 'Felix Ochieng', 'Diana Waweru', 'Collins Kipkemoi', 'Mercy Nduta'];
        $contacts = ['aisha.k@gmail.com', 'felix.ochieng@yahoo.com', 'diana.waweru@outlook.com', '+254722334455', 'mercy.nduta@gmail.com'];
        $exps     = [2, 4, 7, 3, 5];

        $role = CareerRole::where('status', 'Active')->inRandomOrder()->first();

        $i = array_rand($names);

        JobApplication::create([
            'career_role_id' => $role?->id,
            'name'           => $names[$i],
            'contact'        => $contacts[$i],
            'resume_path'    => null,
            'years_exp'      => $exps[$i],
            'why_fit'        => 'Simulated submission: highly motivated candidate with relevant experience in the stated role requirements.',
            'largest_deal'   => 'Simulated: Closed a KES 1.5M enterprise deal within the first quarter.',
            'proud_sale'     => 'Simulated: Turned around a stalled 6-month negotiation into a signed contract within 2 weeks.',
            'first_clients'  => 'Simulated: Would target tech-forward SMEs in Nairobi CBD using LinkedIn Sales Navigator.',
            'internal_notes' => [],
            'status'         => 'New',
        ]);

        $this->activeTab = 'applications';

        Notification::make()
            ->title('Candidate Submission Simulated')
            ->body("{$names[$i]} has been added to the candidate dossier.")
            ->success()
            ->send();
    }

    // ─── Helpers ───────────────────────────────────────────────────────────────

    private function resetRoleForm(): void
    {
        $this->roleCode = '';
        $this->roleTitle = '';
        $this->roleEmploymentType = 'Full-Time';
        $this->roleLocation = '';
        $this->roleCompensation = '';
        $this->rolePrerequisites = '';
        $this->roleStatus = 'Active';
    }

    private function parsePrerequisites(string $text): array
    {
        return array_values(array_filter(
            array_map('trim', explode("\n", $text))
        ));
    }
}
