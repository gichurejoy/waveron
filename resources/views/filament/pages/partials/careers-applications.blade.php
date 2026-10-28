<div class="space-y-6" id="job-applications-pane">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="space-y-1">
            <h3 class="text-base font-bold text-slate-800">Active Job Applications &amp; Candidate Dossiers</h3>
            <p class="text-xs text-slate-500">Review submitted technical resumes, cover letters, experience logs, and append administrative annotations.</p>
        </div>
        <div class="flex items-center gap-2">
            <button wire:click="exportCandidatesCsv" class="flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold py-2 px-4 rounded-xl border border-slate-200 shadow-sm transition-all duration-150 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-emerald-600"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                Export Candidates CSV
            </button>
            <button wire:click="simulateCandidateSubmission" class="flex items-center justify-center gap-2 bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold py-2 px-4 rounded-xl shadow-sm transition-all duration-150 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus h-4 w-4" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                Simulate Candidate Submission
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- LEFT PANEL: Candidate List --}}
        <div class="lg:col-span-5 space-y-4">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 space-y-3">
                <div class="relative">
                    <input wire:model.live="appSearch" placeholder="Search name, email, skills..." class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-xs placeholder-slate-400 focus:outline-none transition-all duration-150" type="text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-2.5 h-3.5 w-3.5 text-slate-455" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
                </div>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-funnel h-3.5 w-3.5 text-slate-455" aria-hidden="true"><path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"></path></svg>
                    <select wire:model.live="appStatusFilter" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-700 rounded-xl py-1.5 px-2.5 text-xs focus:outline-none transition-all">
                        <option value="All">All Statuses</option>
                        @foreach(App\Models\JobApplication::STATUSES as $s)
                            <option value="{{ $s }}">{{ $s }}</option>
                        @endforeach
                        <option value="Trashed">Trash (Soft Deleted)</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2 max-h-[500px] overflow-y-auto pr-1">
                @forelse($this->applications as $app)
                @php
                    $isSelected = $selectedApplicationId === $app->id;
                    $badgeClass = match($app->status) {
                        'New'       => 'bg-blue-50 text-blue-600 border-blue-100',
                        'Reviewing' => 'bg-amber-50 text-amber-600 border-amber-100',
                        'Interview' => 'bg-indigo-50 text-indigo-605 border-indigo-105',
                        'Hired'     => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                        'Rejected'  => 'bg-rose-50 text-rose-600 border-rose-100',
                        default     => 'bg-blue-50 text-blue-600 border-blue-105',
                    };
                @endphp
                <div wire:click="selectApplication({{ $app->id }})" class="p-4 rounded-2xl border transition-all duration-150 cursor-pointer text-left {{ $isSelected ? 'bg-cyan-50/50 border-cyan-300 shadow-sm' : 'bg-white hover:bg-slate-50/50 border-slate-100' }}">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <h4 class="font-bold text-slate-800 text-sm">{{ $app->name }}</h4>
                            <p class="text-xs font-semibold text-slate-700 mt-0.5">{{ $app->careerRole?->title ?? 'General Application' }}</p>
                            <div class="flex items-center gap-1.5 text-[10px] text-slate-500 font-mono mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar h-3 w-3 text-slate-405" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                                {{ $app->created_at->format('n/j/Y') }}
                            </div>
                        </div>
                        <span class="px-2 py-0.5 border rounded-full text-[9px] font-mono font-bold uppercase tracking-wide shrink-0 {{ $badgeClass }}">{{ $app->status }}</span>
                    </div>
                    <div class="mt-2 flex items-center justify-between text-[10px] text-slate-500">
                        <span class="flex items-center gap-1 font-mono">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-3.5 w-3.5 text-slate-405" aria-hidden="true"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>
                            {{ $app->years_exp }} Years Exp
                        </span>
                        @if(count($app->internal_notes ?? []) > 0)
                            <span class="bg-slate-50 border border-slate-100 text-slate-605 px-2 py-0.5 rounded-full text-[9px] font-medium">{{ count($app->internal_notes) }} internal notes</span>
                        @endif
                    </div>
                </div>
                @empty
                <div class="text-center text-xs text-slate-500 py-12 italic font-sans">No applications found.</div>
                @endforelse
            </div>
        </div>

        {{-- RIGHT PANEL: Dossier Details --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-6 text-left">
                @if($this->selectedApplication)
                @php $sel = $this->selectedApplication; @endphp
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-5 border-b border-slate-100">
                    <div>
                        <h4 class="text-lg font-bold text-slate-800">{{ $sel->name }}</h4>
                        <p class="text-xs font-semibold text-slate-600">{{ $sel->careerRole?->title ?? 'General Application' }}</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        @if($sel->status !== 'Hired')
                            <button wire:click="openHireModal" class="flex items-center gap-1.5 bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-bold py-1.5 px-3.5 rounded-xl shadow-sm transition-all duration-150 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                                Convert to Employee
                            </button>
                        @else
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1.5 bg-emerald-50 border border-emerald-100 text-emerald-600 px-2.5 py-1 rounded-full text-xs font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                                    Hired Employee
                                </div>
                                @php
                                    $hiredUser = \App\Models\User::where('job_application_id', $sel->id)->first();
                                @endphp
                                @if($hiredUser)
                                    <a href="{{ \App\Filament\Resources\Employees\EmployeeResource::getUrl('view', ['record' => $hiredUser]) }}" class="flex items-center gap-1 bg-cyan-50 hover:bg-cyan-100 text-cyan-700 font-sans text-xs font-semibold py-1 px-2.5 rounded-xl border border-cyan-200 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                        View Employee Profile
                                    </a>
                                @endif
                            </div>
                        @endif
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-500 font-mono">Status:</span>
                            <select class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl py-1 px-2.5 text-xs font-bold text-slate-800 focus:outline-none transition-all" wire:change="updateApplicationStatus({{ $sel->id }}, $event.target.value)">
                                @foreach(App\Models\JobApplication::STATUSES as $s)
                                    <option value="{{ $s }}" {{ $sel->status === $s ? 'selected' : '' }}>{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-mono">
                    <div class="space-y-1">
                        <span class="text-slate-505">Email Address:</span>
                        <div class="flex items-center gap-1.5 text-slate-808 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail h-3.5 w-3.5 text-slate-400" aria-hidden="true"><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path><rect width="20" height="16" x="2" y="4" rx="2"></rect></svg>
                            @if(str_contains($sel->contact, '@'))
                                <a href="mailto:{{ $sel->contact }}" class="hover:underline text-cyan-600">{{ $sel->contact }}</a>
                            @else
                                <a href="mailto:candidate@waverontechnologies.co.ke" class="hover:underline text-cyan-600">candidate@waverontechnologies.co.ke</a>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-1">
                        <span class="text-slate-505">Phone Contact:</span>
                        <div class="flex items-center gap-1.5 text-slate-808 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone h-3.5 w-3.5 text-slate-455" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            @if(!str_contains($sel->contact, '@'))
                                <span>{{ $sel->contact }}</span>
                            @else
                                <span>+254712009988</span>
                            @endif
                        </div>
                    </div>
                    <div class="space-y-1">
                        <span class="text-slate-505">Experience Profile:</span>
                        <div class="flex items-center gap-1.5 text-slate-808 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-3.5 w-3.5 text-slate-455" aria-hidden="true"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>
                            <span>{{ $sel->years_exp }} Years Professional</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <span class="text-slate-505">External Portfolio:</span>
                        <div class="flex items-center gap-1.5 text-slate-808 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link h-3.5 w-3.5 text-slate-455" aria-hidden="true"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
                            @if(isset($sel->portfolio_url) && $sel->portfolio_url)
                                <a href="{{ $sel->portfolio_url }}" target="_blank" rel="noreferrer" class="text-cyan-600 hover:underline flex items-center gap-0.5 text-xs font-sans font-semibold">View Portfolio</a>
                            @else
                                <span class="text-slate-500 italic font-bold">None Provided</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <h5 class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono">Cover Letter Pitch</h5>
                    <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100 text-xs text-slate-700 leading-relaxed font-sans whitespace-pre-line">{{ $sel->why_fit }}</div>
                </div>

                @php
                    $isSales = true;
                    if ($sel->careerRole) {
                        $titleLower = strtolower($sel->careerRole->title);
                        if (!str_contains($titleLower, 'sales') && !str_contains($titleLower, 'general')) {
                            $isSales = false;
                        }
                    }
                    
                    $q1Title = $isSales ? 'What is the largest deal you have personally closed?' : 'What is the largest or most complex technical system you have architected/delivered?';
                    $q2Title = $isSales ? 'Describe a sale you are particularly proud of.' : 'Describe a technical achievement or system migration you are particularly proud of.';
                    $q3Title = $isSales ? 'If hired, how would you find your first three potential clients for Waveron Technologies within the first 30 days?' : 'If hired, what is your 30-day plan to integrate and start contributing to Waveron\'s technical stack?';
                @endphp

                <div class="space-y-4 border-t border-slate-100 pt-5">
                    <h5 class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono">Application Questionnaire</h5>
                    
                    <div class="space-y-3">
                        <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100 space-y-1">
                            <span class="text-slate-500 font-mono text-[9px] font-bold block tracking-wider uppercase">{{ $q1Title }}</span>
                            <p class="text-xs text-slate-700 leading-relaxed font-sans whitespace-pre-line">{{ $sel->largest_deal }}</p>
                        </div>
                        
                        <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100 space-y-1">
                            <span class="text-slate-500 font-mono text-[9px] font-bold block tracking-wider uppercase">{{ $q2Title }}</span>
                            <p class="text-xs text-slate-700 leading-relaxed font-sans whitespace-pre-line">{{ $sel->proud_sale }}</p>
                        </div>
                        
                        <div class="bg-slate-50/70 rounded-xl p-4 border border-slate-100 space-y-1">
                            <span class="text-slate-500 font-mono text-[9px] font-bold block tracking-wider uppercase">{{ $q3Title }}</span>
                            <p class="text-xs text-slate-700 leading-relaxed font-sans whitespace-pre-line">{{ $sel->first_clients }}</p>
                        </div>
                    </div>
                </div>

                @if($sel->resume_path)
                <div class="space-y-2 border-t border-slate-100 pt-5">
                    <div class="flex items-center justify-between">
                        <h5 class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono">Candidate Technical Resume</h5>
                        <a href="{{ Storage::url($sel->resume_path) }}" target="_blank" class="text-xs font-bold text-cyan-600 hover:underline flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link h-3.5 w-3.5" aria-hidden="true"><path d="M15 3h6v6"></path><path d="M10 14 21 3"></path><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path></svg>
                            Open in New Tab
                        </a>
                    </div>
                    <div class="w-full h-[500px] border border-slate-100 rounded-xl overflow-hidden bg-slate-50 shadow-inner">
                        <iframe src="{{ Storage::url($sel->resume_path) }}" class="w-full h-full" frameborder="0"></iframe>
                    </div>
                </div>
                @else
                <div class="space-y-2 border-t border-slate-100 pt-5">
                    <h5 class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono">Candidate Technical Resume</h5>
                    <div class="w-full p-6 border border-dashed border-slate-200 rounded-xl bg-slate-50/50 text-center text-xs text-slate-500 italic">
                        No primary resume uploaded. Upload a document below and click "Set as Resume" to register it.
                    </div>
                </div>
                @endif

                {{-- DOCUMENT ATTACHMENTS SECTION --}}
                <div class="border-t border-slate-100 pt-5 space-y-4">
                    <h5 class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paperclip text-slate-455" aria-hidden="true"><path d="m21.44 11.05-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path></svg>
                        Candidate Dossier Files &amp; Credentials
                    </h5>

                    {{-- Attachment list --}}
                    @if(count($sel->attachments ?? []) > 0)
                        <div class="grid grid-cols-1 gap-2">
                            @foreach($sel->attachments as $idx => $file)
                                <div class="flex items-center justify-between p-3 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-100/50 transition-all text-xs">
                                    <div class="flex items-center gap-2.5 min-w-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file text-slate-400 shrink-0"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/></svg>
                                        <div class="truncate">
                                            <span class="font-semibold text-slate-800 block truncate" title="{{ $file['name'] }}">{{ $file['name'] }}</span>
                                            <span class="text-[10px] text-slate-500 font-mono">{{ number_format($file['size'] / 1024, 1) }} KB • Uploaded {{ \Carbon\Carbon::parse($file['uploaded_at'])->format('d M Y, H:i') }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 shrink-0 ml-2">
                                        @if($sel->resume_path !== $file['path'])
                                            <button wire:click="setAsResume({{ $idx }})" class="px-2.5 py-1 rounded-xl bg-cyan-50 hover:bg-cyan-100 border border-cyan-100 text-cyan-600 text-[10px] font-bold cursor-pointer transition-all duration-150">
                                                Set as Resume
                                            </button>
                                        @else
                                            <span class="px-2.5 py-1 rounded-xl bg-slate-50 border border-slate-100 text-slate-500 text-[10px] font-bold">
                                                Active Resume
                                            </span>
                                        @endif
                                        <a href="{{ Storage::url($file['path']) }}" target="_blank" class="p-1 text-slate-400 hover:text-slate-705 rounded hover:bg-slate-105 transition-all" title="Download file">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                                        </a>
                                        <button wire:click="deleteCandidateFile({{ $idx }})" wire:confirm="Are you sure you want to delete this file?" class="p-1 text-rose-500 hover:text-rose-700 rounded hover:bg-rose-50 transition-all cursor-pointer" title="Delete file">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-slate-500 italic">No additional files uploaded for this profile yet.</p>
                    @endif

                    {{-- Upload form --}}
                    <div class="flex flex-col gap-2 p-4 rounded-xl border border-slate-100 bg-slate-50/70">
                        <div class="text-[10px] uppercase font-bold text-slate-500 font-mono">Upload New Document</div>
                        <div class="flex items-center gap-3">
                            <input type="file" wire:model="uploadedFile" class="text-xs text-slate-505 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 cursor-pointer flex-1">
                            @error('uploadedFile') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            <button wire:click="uploadCandidateFile" wire:loading.attr="disabled" class="bg-cyan-600 hover:bg-cyan-700 text-white font-sans text-xs font-semibold py-1.5 px-3.5 rounded-xl shadow-sm transition-all cursor-pointer disabled:opacity-50">
                                <span wire:loading.remove wire:target="uploadedFile">Upload File</span>
                                <span wire:loading wire:target="uploadedFile">Uploading...</span>
                            </button>
                        </div>
                        <p class="text-[9px] text-slate-500 font-mono uppercase tracking-wider">Supported formats: PDF, DOCX, PNG, JPG (Max 10MB)</p>
                    </div>
                </div>

                <div class="border-t border-slate-100 pt-5 space-y-4">
                    <h5 class="text-[10px] font-bold uppercase tracking-wider text-slate-500 font-mono flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square h-3.5 w-3.5 text-slate-455" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        Administrative Review Notes
                    </h5>
                    <div class="space-y-2 max-h-40 overflow-y-auto pr-1">
                        @forelse($sel->internal_notes ?? [] as $note)
                            <div class="p-2.5 rounded-xl bg-amber-50/70 border border-amber-100/60 text-xs text-amber-800 leading-normal font-sans">{{ $note }}</div>
                        @empty
                            <p class="text-xs text-slate-500 italic font-sans">No review notes on file for this candidate yet.</p>
                        @endforelse
                    </div>
                    <div class="flex gap-2">
                        <input wire:model="newNote" placeholder="Type internal feedback or interview log..." class="flex-1 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl py-2 px-3 text-xs text-slate-800 placeholder-slate-400 focus:outline-none transition-all" type="text" wire:keydown.enter="addNote">
                        <button wire:click="addNote" class="bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-bold py-2 px-4 rounded-xl shadow-sm cursor-pointer whitespace-nowrap transition-colors">Add Note</button>
                    </div>
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-20 text-center gap-3">
                    <span class="text-4xl opacity-20">📄</span>
                    <h4 class="font-bold text-slate-500 text-sm">No Candidate Selected</h4>
                    <p class="text-xs text-slate-500 max-w-xs">Click a candidate in the directory on the left to inspect their dossier.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- HIRE EMPLOYEE CONVERSION MODAL --}}
    @if($showHireModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-2xl max-w-lg w-full p-6 space-y-4 text-left">
                <div class="flex justify-between items-center border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-bold uppercase font-mono text-slate-800 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-plus text-cyan-600"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" x2="19" y1="8" y2="14"/><line x1="22" x2="16" y1="11" y2="11"/></svg>
                        Onboard Candidate as Team Employee
                    </h3>
                    <button wire:click="$set('showHireModal', false)" class="text-slate-500 hover:text-slate-800 text-lg cursor-pointer">&times;</button>
                </div>
                
                <p class="text-xs text-slate-500 leading-relaxed">
                    Provision an employee account for <strong>{{ $this->selectedApplication->name }}</strong>, configure their commission structure, and send onboarding credentials.
                </p>

                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Company Email</label>
                            <input type="email" wire:model="employeeEmail" placeholder="name@waverontechnologies.co.ke" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                            @error('employeeEmail') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Phone (M-Pesa / Call)</label>
                            <input type="text" wire:model="employeePhone" placeholder="+254 7XX XXX XXX" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Role / Job Title</label>
                            <input type="text" wire:model="employeeRole" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                            @error('employeeRole') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Commission Rate (%)</label>
                            <div class="relative">
                                <input type="number" step="0.5" wire:model="employeeCommissionRate" placeholder="10.0" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                                <span class="absolute right-3 top-2.5 text-xs text-slate-400 font-bold">%</span>
                            </div>
                            @error('employeeCommissionRate') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Base Salary (KES, Optional)</label>
                            <input type="number" wire:model="employeeBaseSalary" placeholder="e.g. 50000" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                        </div>
                        <div>
                            <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Payout Channel</label>
                            <select wire:model="employeePayoutMethod" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2 text-xs text-slate-800 focus:outline-none transition-all">
                                <option value="M-Pesa">M-Pesa</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Payout Account (Phone / Bank Details)</label>
                        <input type="text" wire:model="employeePayoutAccount" placeholder="e.g. 0712345678 or KCB Bank / Acc: 123456789" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 focus:outline-none transition-all">
                    </div>

                    <div>
                        <label class="text-[10px] uppercase font-bold text-slate-500 font-mono block mb-1">Generated Login Password</label>
                        <input type="text" wire:model="employeePassword" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl p-2.5 text-xs text-slate-800 font-mono focus:outline-none transition-all">
                        @error('employeePassword') <span class="text-rose-500 text-[10px] block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" id="sendEmailChk" wire:model="employeeSendEmail" class="rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        <label for="sendEmailChk" class="text-xs text-slate-700 font-medium cursor-pointer">
                            Send welcome onboarding email with login credentials to candidate
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-2 pt-3 border-t border-slate-100">
                    <button wire:click="$set('showHireModal', false)" class="px-3.5 py-2 border border-slate-200 text-slate-600 rounded-xl text-xs font-semibold hover:bg-slate-50 transition-all cursor-pointer">
                        Cancel
                    </button>
                    <button wire:click="convertToEmployee" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-705 text-white rounded-xl text-xs font-bold shadow-sm transition-all cursor-pointer flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        Complete Onboarding
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
