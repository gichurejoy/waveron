<x-filament-panels::page>
<div class="space-y-6" id="leads-module-container">

        {{-- KPI STATS CARDS --}}
        <div class="leads-stats-grid">
            {{-- Card 1 --}}
            <div class="leads-stats-card bg-white border border-slate-100 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition-shadow duration-200">
                <div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold mb-1">Accumulated Submissions</div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-slate-800">{{ $this->stats['accumulated'] }}</span>
                        <span class="text-xs text-slate-500">total fills</span>
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-cyan-50 border border-cyan-100/50 flex items-center justify-center text-cyan-600">
                    <svg xmlns="http://www.w3.org/2050" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="leads-stats-card bg-white border border-slate-100 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition-shadow duration-200">
                <div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold mb-1">Interactive Funnel Value</div>
                    <div class="flex items-baseline gap-1 text-cyan-600 font-bold">
                        <span class="text-xs">KES</span>
                        <span class="text-2xl font-extrabold">{{ number_format($this->stats['funnel_value']) }}</span>
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-cyan-50 border border-cyan-100/50 flex items-center justify-center text-cyan-600">
                    <svg xmlns="http://www.w3.org/2000" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-flame"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="leads-stats-card bg-white border border-slate-100 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition-shadow duration-200">
                <div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold mb-1">Quote Conversion Rate</div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-slate-800">{{ $this->stats['conversion_rate'] }}%</span>
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-cyan-50 border border-cyan-100/50 flex items-center justify-center text-cyan-600">
                    <svg xmlns="http://www.w3.org/2000" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-square"><path d="m9 11 3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="leads-stats-card bg-white border border-slate-100 rounded-2xl p-6 flex justify-between items-center shadow-sm hover:shadow-md transition-shadow duration-200">
                <div>
                    <div class="text-[10px] uppercase tracking-wider text-slate-500 font-semibold mb-1">Awaiting Follow-Up</div>
                    <div class="flex items-baseline gap-2 text-amber-700 font-bold">
                        <span class="text-3xl font-extrabold text-amber-600">{{ $this->stats['awaiting_follow_up'] }}</span>
                        <span class="text-xs text-slate-550">leads</span>
                    </div>
                </div>
                <div class="h-10 w-10 rounded-xl bg-amber-50 border border-amber-100/50 flex items-center justify-center text-amber-600">
                    <svg xmlns="http://www.w3.org/2000" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
            </div>
        </div>

        {{-- TAB DIRECTORY CONTROLS --}}
        <div class="border-b border-slate-100 flex gap-2">
            <button wire:click="selectTab('quotes')" class="pb-4 px-4 font-sans text-sm font-semibold relative cursor-pointer whitespace-nowrap transition-all duration-200 {{ $activeTab === 'quotes' ? 'text-cyan-600 font-bold border-b-2 border-cyan-500' : 'text-slate-500 hover:text-slate-800' }}">
                Quotations &amp; Proposals ({{ $this->quotesCount }})
            </button>
            <button wire:click="selectTab('inquiries')" class="pb-4 px-4 font-sans text-sm font-semibold relative cursor-pointer whitespace-nowrap transition-all duration-200 {{ $activeTab === 'inquiries' ? 'text-cyan-600 font-bold border-b-2 border-cyan-500' : 'text-slate-500 hover:text-slate-800' }}">
                High-Intent Fast Inquiries ({{ $this->inquiriesCount }})
            </button>
            <button wire:click="selectTab('contacts')" class="pb-4 px-4 font-sans text-sm font-semibold relative cursor-pointer whitespace-nowrap transition-all duration-200 {{ $activeTab === 'contacts' ? 'text-cyan-600 font-bold border-b-2 border-cyan-500' : 'text-slate-500 hover:text-slate-800' }}">
                General Contact Inbox ({{ $this->contactsCount }})
            </button>
        </div>

        {{-- TAB VIEW PORT --}}
        @if($activeTab === 'quotes')
            {{-- TAB 1: QUOTES --}}
            @if($selectedQuoteId)
                {{-- DETAIL VIEW --}}
                <div class="space-y-6">
                    <div class="flex justify-between items-center bg-white border border-slate-100 rounded-2xl p-4">
                        <button wire:click="closeQuoteDetails" class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200/60 hover:bg-slate-50 text-xs text-slate-650 font-semibold cursor-pointer transition-colors duration-150">
                            &larr; BACK TO PROPOSALS
                        </button>
                        <div class="flex items-center gap-2 text-xs font-semibold">
                            <span class="text-slate-500">STATE:</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold font-mono border
                                @if($this->selectedQuote->status === 'New') bg-amber-50 text-amber-700 border-amber-100
                                @elseif($this->selectedQuote->status === 'In Review') bg-indigo-50 text-indigo-700 border-indigo-100
                                @elseif($this->selectedQuote->status === 'Converted') bg-emerald-50 text-emerald-700 border-emerald-100
                                @else bg-slate-50 text-slate-600 border-slate-100 @endif">
                                {{ $this->selectedQuote->status }}
                            </span>
                        </div>
                    </div>

                    <div class="leads-detail-grid">
                        {{-- Left Details Column --}}
                        <div class="lg:col-span-2 space-y-6">
                            {{-- SOW Summary card --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-6">
                                <div class="flex justify-between items-start border-b border-slate-100 pb-4">
                                    <div>
                                        <div class="text-[10px] font-mono text-cyan-600 uppercase tracking-wider font-bold mb-1">Statement of Work Summary</div>
                                        <h2 class="text-2xl font-bold text-slate-800 font-mono">qt-{{ 1000 + $this->selectedQuote->id }}</h2>
                                        <p class="text-xs text-slate-500">Submitted on {{ $this->selectedQuote->created_at->format('d/m/Y, H:i:s') }}</p>
                                    </div>
                                    <div class="h-10 w-10 text-slate-500 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calculator"><rect width="16" height="20" x="4" y="2" rx="2"/><line x1="8" x2="16" y1="6" y2="6"/><line x1="16" x2="16" y1="14" y2="18"/><path d="M16 10h.01"/><path d="M12 10h.01"/><path d="M8 10h.01"/><path d="M12 14h.01"/><path d="M8 14h.01"/><path d="M12 18h.01"/><path d="M8 18h.01"/></svg>
                                    </div>
                                </div>

                                <div class="leads-info-grid">
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">User / Client Email</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedQuote->user_email }}</div>
                                    </div>
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Service Catalog Type</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedQuote->service_type }}</div>
                                    </div>
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Complexity Layer</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedQuote->complexity ?? 'Standard' }}</div>
                                    </div>
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Speed Priority</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedQuote->timeline ?? 'Standard' }}</div>
                                    </div>
                                </div>

                                <div class="space-y-4 pt-4 border-t border-slate-100">
                                    <label class="text-[10px] uppercase font-semibold text-cyan-600 tracking-wider block">Requested Systems &amp; Architectural Features:</label>
                                    <div class="leads-features-grid">
                                        @forelse($this->selectedQuote->selected_features ?? [] as $feature)
                                            <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 text-xs text-slate-650 font-mono flex items-center gap-2">
                                                <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span>
                                                {{ $feature }}
                                            </div>
                                        @empty
                                            <div class="text-xs text-slate-500 italic">No custom systems requested.</div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="space-y-4 pt-4 border-t border-slate-100">
                                    <label class="text-[10px] uppercase font-semibold text-cyan-600 tracking-wider block">SLA Support &amp; Continuity Addons:</label>
                                    <div class="leads-features-grid">
                                         @forelse($this->selectedQuote->selected_addons ?? [] as $addon)
                                             @php
                                                 $addonPrice = 15000;
                                                 if (stripos($addon, 'Security') !== false || stripos($addon, 'Patching') !== false) $addonPrice = 25000;
                                                 elseif (stripos($addon, 'Emergency') !== false || stripos($addon, 'Support') !== false) $addonPrice = 20000;
                                                 elseif (stripos($addon, 'Behavioral') !== false || stripos($addon, 'Analytics') !== false) $addonPrice = 15000;
                                                 elseif (stripos($addon, 'Testing') !== false || stripos($addon, 'QA') !== false) $addonPrice = 30000;
                                                 elseif (stripos($addon, 'Lottie') !== false || stripos($addon, 'Micro-Animations') !== false) $addonPrice = 15000;
                                                 elseif (stripos($addon, '3D') !== false || stripos($addon, 'Illustrations') !== false) $addonPrice = 20000;
                                                 elseif (stripos($addon, 'A/B') !== false || stripos($addon, 'abtesting') !== false) $addonPrice = 25000;
                                                 elseif (stripos($addon, 'Stationery') !== false || stripos($addon, 'Pitch') !== false) $addonPrice = 15000;
                                                 elseif (stripos($addon, 'Motion') !== false || stripos($addon, 'Animated') !== false) $addonPrice = 25000;
                                                 elseif (stripos($addon, 'Sonic') !== false || stripos($addon, 'Jingle') !== false) $addonPrice = 30000;
                                                 elseif (stripos($addon, 'Backlink') !== false || stripos($addon, 'SEO') !== false) $addonPrice = 30000;
                                                 elseif (stripos($addon, 'Influencer') !== false) $addonPrice = 35000;
                                                 elseif (stripos($addon, 'CRM') !== false || stripos($addon, 'Funnel') !== false) $addonPrice = 20000;
                                             @endphp
                                             <div class="bg-emerald-50/40 border border-emerald-100/50 rounded-xl p-3 text-xs text-emerald-700 font-mono flex items-center justify-between gap-2">
                                                 <div class="flex items-center gap-2">
                                                     <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                     {{ $addon }}
                                                 </div>
                                                 <span class="font-bold text-[10px] bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded-md">KES {{ number_format($addonPrice) }}</span>
                                             </div>
                                         @empty
                                             <div class="text-xs text-slate-500 italic">No add-ons selected.</div>
                                         @endforelse
                                    </div>
                                </div>

                                <div class="space-y-4 pt-6 border-t border-slate-100">
                                    <label class="text-[10px] uppercase font-semibold text-cyan-600 tracking-wider block">Statement of Work Cost Breakdown</label>
                                    @php
                                        $breakdown = $this->getQuoteBreakdown($this->selectedQuote);
                                    @endphp
                                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 space-y-3 font-mono text-xs text-slate-700">
                                        <div class="flex justify-between items-center pb-2 border-b border-slate-200/50">
                                            <span class="text-slate-500">Base Price ({{ $this->selectedQuote->service_type }})</span>
                                            <span class="font-bold text-slate-800">KES {{ number_format($breakdown['base_price']) }}</span>
                                        </div>
                                         <div class="flex justify-between items-center text-slate-650">
                                             <span class="text-slate-500">&bull; Complexity Factor ({{ $breakdown['complexity'] }})</span>
                                             <span>
                                                 @php
                                                     $compDiff = round($breakdown['base_price'] * ($breakdown['complexity_multiplier'] - 1));
                                                 @endphp
                                                 &times; {{ number_format($breakdown['complexity_multiplier'], 2) }}
                                                 <span class="text-[10px] ml-1 text-slate-450 font-semibold">
                                                     ({{ $compDiff >= 0 ? '+' : '-' }} KES {{ number_format(abs($compDiff)) }})
                                                 </span>
                                             </span>
                                         </div>
                                         <div class="flex justify-between items-center text-slate-650">
                                             <span class="text-slate-500">&bull; Timeline Urgency Factor ({{ $breakdown['timeline'] }})</span>
                                             <span>
                                                 @php
                                                     $timeDiff = round($breakdown['base_price'] * $breakdown['complexity_multiplier'] * ($breakdown['timeline_multiplier'] - 1));
                                                 @endphp
                                                 &times; {{ number_format($breakdown['timeline_multiplier'], 2) }}
                                                 <span class="text-[10px] ml-1 text-slate-450 font-semibold">
                                                     ({{ $timeDiff >= 0 ? '+' : '-' }} KES {{ number_format(abs($timeDiff)) }})
                                                 </span>
                                             </span>
                                         </div>
                                         <div class="flex justify-between items-center pb-2 border-b border-slate-200/50 text-slate-650">
                                             <span class="text-slate-500">&bull; Scope Feature Factor ({{ $breakdown['features_count'] }} key features)</span>
                                             <span>
                                                 @php
                                                     $featDiff = round($breakdown['base_price'] * $breakdown['complexity_multiplier'] * $breakdown['timeline_multiplier'] * ($breakdown['feature_adj'] - 1));
                                                 @endphp
                                                 &times; {{ number_format($breakdown['feature_adj'], 2) }}
                                                 <span class="text-[10px] ml-1 text-slate-450 font-semibold">
                                                     ({{ $featDiff >= 0 ? '+' : '-' }} KES {{ number_format(abs($featDiff)) }})
                                                 </span>
                                             </span>
                                         </div>
                                        <div class="flex justify-between items-center font-bold text-slate-800">
                                            <span>Subtotal</span>
                                            <span>KES {{ number_format($breakdown['subtotal']) }}</span>
                                        </div>

                                        @if(!empty($breakdown['addons']))
                                            <div class="pt-2 border-t border-slate-200/50 space-y-2">
                                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Continuity &amp; SLA Add-ons</div>
                                                @foreach($breakdown['addons'] as $addon)
                                                    <div class="flex justify-between items-center text-slate-650">
                                                        <span class="text-slate-500">&bull; {{ $addon['name'] }}</span>
                                                        <span>KES {{ number_format($addon['price']) }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                        @if($breakdown['adjustment'] != 0)
                                            <div class="flex justify-between items-center text-slate-650 pt-2 border-t border-slate-200/50">
                                                <span class="text-slate-500">Custom adjustment / discount</span>
                                                <span class="{{ $breakdown['adjustment'] < 0 ? 'text-red-650' : 'text-emerald-650' }}">
                                                    {{ $breakdown['adjustment'] < 0 ? '-' : '+' }} KES {{ number_format(abs($breakdown['adjustment'])) }}
                                                </span>
                                            </div>
                                        @endif

                                        <div class="flex justify-between items-center pt-3 border-t border-slate-200 font-extrabold text-sm text-emerald-600 bg-emerald-50/40 p-2.5 rounded-xl border border-emerald-100/50">
                                            <span>Estimated Total</span>
                                            <span>KES {{ number_format($breakdown['total']) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Configuration Column --}}
                        <div class="space-y-6">
                            {{-- Card 1: Valuation --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                                <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Estimated Project Valuation</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-4 text-center">
                                    <div class="text-[10px] text-emerald-600 font-mono font-bold mb-1">Auto-Calculated Output</div>
                                    <div class="text-2xl font-extrabold text-emerald-600 font-mono">KES {{ number_format($this->selectedQuote->estimated_total) }}</div>
                                </div>
                            </div>
                            {{-- Card 2: Proposal Actions --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-3">
                                <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider block">Proposal Actions</label>
                                
                                <button onclick="window.printQuote({{ json_encode([
                                    'id' => $this->selectedQuote->id,
                                    'id_prefix' => $this->selectedQuote->id_prefix,
                                    'created_at' => $this->selectedQuote->created_at->toIso8601String(),
                                    'status' => $this->selectedQuote->status,
                                    'user_email' => $this->selectedQuote->user_email,
                                    'company' => $this->selectedQuote->company,
                                    'service_type' => $this->selectedQuote->service_type,
                                    'selected_features' => $this->selectedQuote->selected_features,
                                    'selected_addons' => $this->selectedQuote->selected_addons
                                ]) }}, {{ json_encode($breakdown) }})" class="w-full bg-slate-50 hover:bg-slate-100 border border-slate-200/80 text-slate-700 rounded-xl py-2.5 text-xs font-bold transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-printer"><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><path d="M6 9V3a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v6"/><rect x="6" y="14" width="12" height="8" rx="1"/></svg>
                                    Print SOW Proposal
                                </button>

                                <a href="/admin/financial-ledger?quote_id={{ $this->selectedQuote->id }}" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white rounded-xl py-2.5 text-xs font-bold transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                                    Convert to Invoice
                                </a>
                            </div>

                            {{-- Card 2: Convert/State --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                                <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Update Conversion State</label>
                                <select wire:change="updateQuoteStatus({{ $this->selectedQuote->id }}, $event.target.value)" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl px-3 py-2 text-sm outline-none transition-all">
                                    @foreach(App\Models\QuoteSubmission::STATUSES as $status)
                                        <option value="{{ $status }}" {{ $this->selectedQuote->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Card 3: Linkage --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                                <div class="flex items-center gap-1.5 text-[10px] uppercase font-semibold text-cyan-600 tracking-wider">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles"><path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z"/><path d="M20 2v4"/><path d="M22 4h-4"/><circle cx="4" cy="20" r="2"/></svg>
                                    Conversion Linkage
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed">You can link this quote run with an existing inquiry submission to bind budgets and specs together.</p>
                                <button wire:click="autoBindInquiry({{ $this->selectedQuote->id }})" class="w-full bg-cyan-50 hover:bg-cyan-100/85 border border-cyan-100 text-cyan-700 rounded-xl py-2.5 text-xs font-bold transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                                    Search &amp; Auto-Bind Inquiries
                                </button>
                            </div>

                            {{-- Card 4: Internal Notes --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                                <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider block">Internal Staff Notes</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 max-h-48 overflow-y-auto text-xs font-mono text-slate-650 space-y-2">
                                    @if($this->selectedQuote->internal_notes)
                                        {!! nl2br(e($this->selectedQuote->internal_notes)) !!}
                                    @else
                                        <span class="text-slate-400 italic">No notes logged.</span>
                                    @endif
                                </div>
                                <div class="space-y-2">
                                    <textarea wire:model="newQuoteNote" rows="2" placeholder="Append staff progress note..." class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl p-2.5 text-xs outline-none transition-all"></textarea>
                                    <button wire:click="addQuoteNote" class="w-full bg-slate-800 hover:bg-slate-900 text-white rounded-xl py-2 text-xs font-semibold cursor-pointer transition-all duration-200">
                                        Log Internal Note
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- LIST VIEW --}}
                <div class="space-y-6">
                    <div class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        {{-- Search Input --}}
                        <div class="relative flex-1 max-w-xl">
                            <input wire:model.live="search" type="text" placeholder="Search all submissions by client name, email, company, or services requested..." class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3.5 top-3.5 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        {{-- Status Filter --}}
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Filter Status:</span>
                            <select wire:model.live="statusFilter" class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl px-3 py-2 text-xs font-semibold outline-none transition-all">
                                <option value="All">ALL LEADS</option>
                                @foreach(App\Models\QuoteSubmission::STATUSES as $status)
                                    <option value="{{ $status }}">{{ strtoupper($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- SUB-FILTER BAR --}}
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-6">
                            <div class="text-sm font-bold text-slate-800">Quotations &amp; SOW Proposals</div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Origin:</span>
                                    <select wire:model.live="quoteOrigin" class="bg-transparent text-slate-650 text-xs font-bold border-none focus:ring-0 outline-none cursor-pointer">
                                        <option value="All" class="bg-white">All Types</option>
                                        <option value="Calculator" class="bg-white">Web Calculator</option>
                                    </select>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[10px] text-slate-500 uppercase font-semibold">Service:</span>
                                    <select wire:model.live="quoteService" class="bg-transparent text-slate-650 text-xs font-bold border-none focus:ring-0 outline-none cursor-pointer">
                                        <option value="All" class="bg-white">All Services</option>
                                        <option value="Software" class="bg-white">Software Development</option>
                                        <option value="Design" class="bg-white">Graphic / UI Design</option>
                                        <option value="Branding" class="bg-white">Branding &amp; Strategy</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button wire:click="exportLeadsCsv" class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200/60 hover:bg-slate-50 text-[10px] font-bold text-slate-650 font-mono tracking-wider cursor-pointer transition-all duration-250">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                            EXPORT TO CSV
                        </button>
                    </div>

                    {{-- TABLE CONTAINER --}}
                    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/50 text-[10px] uppercase font-bold text-slate-500 tracking-wider">
                                    <th class="py-4 px-6">Client Email</th>
                                    <th class="py-4 px-6">Service &amp; Scale</th>
                                    <th class="py-4 px-6">Price Estimate</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($this->quotes as $quote)
                                    <tr class="hover:bg-slate-50/70 transition-all duration-150 text-xs">
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-slate-800 text-sm font-mono">{{ $quote->user_email }}</div>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[9px] font-bold bg-cyan-50 text-cyan-600 border border-cyan-100/50">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-cyan-500"></span>
                                                    Web Calculator
                                                </span>
                                                <span class="text-[10px] text-slate-500 font-mono">{{ $quote->created_at->format('j/n/Y \a\t h:i A') }}</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-50 text-slate-650 border border-slate-150 font-mono mb-1">{{ $quote->service_type }}</span>
                                            <div class="text-[10px] text-cyan-600 font-mono">{{ $quote->complexity ?? 'Standard' }} &bull; {{ $quote->timeline ?? 'Standard' }}</div>
                                        </td>
                                        <td class="py-4 px-6 font-mono text-sm text-slate-800 font-bold">
                                            KES {{ number_format($quote->estimated_total) }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold font-mono border
                                                @if($quote->status === 'New') bg-amber-50 text-amber-700 border-amber-100
                                                @elseif($quote->status === 'In Review') bg-indigo-50 text-indigo-700 border-indigo-100
                                                @elseif($quote->status === 'Converted') bg-emerald-50 text-emerald-700 border-emerald-100
                                                @else bg-slate-50 text-slate-600 border-slate-100 @endif">
                                                {{ $quote->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button wire:click="examineQuote({{ $quote->id }})" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 inline-flex items-center gap-1 cursor-pointer transition-colors duration-150">
                                                Examine Details &rarr;
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-500 italic">No quotations found matching your search.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        @elseif($activeTab === 'inquiries')
            {{-- TAB 2: INQUIRIES --}}
            @if($selectedInquiryId)
                {{-- DETAIL VIEW --}}
                    <div class="flex justify-between items-center bg-white border border-slate-100 rounded-2xl p-4">
                        <button wire:click="closeInquiryDetails" class="flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200/60 hover:bg-slate-50 text-xs text-slate-655 font-semibold cursor-pointer transition-colors duration-150">
                            &larr; BACK TO INQUIRIES
                        </button>
                        <div class="flex items-center gap-2 text-xs font-semibold">
                            <span class="text-slate-500">STATE:</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold font-mono border
                                @if($this->selectedInquiry->status === 'New') bg-amber-50 text-amber-700 border-amber-100
                                @elseif($this->selectedInquiry->status === 'Contacted') bg-indigo-50 text-indigo-700 border-indigo-100
                                @elseif($this->selectedInquiry->status === 'Qualified') bg-emerald-50 text-emerald-700 border-emerald-100
                                @else bg-slate-50 text-slate-600 border-slate-100 @endif">
                                {{ $this->selectedInquiry->status }}
                            </span>
                        </div>
                    </div>

                    <div class="leads-detail-grid">
                        {{-- Left Column --}}
                        <div class="lg:col-span-2 space-y-6">
                            {{-- Spec sheet card --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-6">
                                <div class="flex justify-between items-start border-b border-slate-100 pb-4">
                                    <div>
                                        <div class="text-[10px] font-mono text-cyan-600 uppercase tracking-wider font-bold mb-1">Enterprise Spec Sheet</div>
                                        <h2 class="text-2xl font-bold text-slate-800 font-sans">{{ $this->selectedInquiry->company ?? 'No Company Provided' }}</h2>
                                        <p class="text-xs text-slate-505">Submitted on {{ $this->selectedInquiry->created_at->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="h-10 w-10 text-cyan-600 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                    </div>
                                </div>

                                <div class="leads-info-grid">
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Lead Coordinator</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedInquiry->name }}</div>
                                    </div>
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Contact Channel</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedInquiry->email }}</div>
                                    </div>
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Stated Budget Tier</label>
                                        <div class="mt-1 text-sm text-emerald-700 font-mono bg-emerald-50/40 border border-emerald-100/50 rounded-xl p-3 font-bold">{{ $this->selectedInquiry->budget ?? 'Under negotiation' }}</div>
                                    </div>
                                    <div>
                                        <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">Timeline Constraints</label>
                                        <div class="mt-1 text-sm text-slate-700 font-mono bg-slate-50 border border-slate-100 rounded-xl p-3">{{ $this->selectedInquiry->timeline ?? 'Flexible' }}</div>
                                    </div>
                                </div>

                                <div class="space-y-2 pt-4 border-t border-slate-100">
                                    <label class="text-[10px] uppercase font-semibold text-cyan-600 tracking-wider block">Requested Services Scope</label>
                                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-3.5 text-xs text-slate-700 font-mono leading-relaxed">
                                        {{ $this->selectedInquiry->services_requested ?? 'General IT consultation required.' }}
                                    </div>
                                </div>

                                <div class="space-y-2 pt-4 border-t border-slate-100">
                                    <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider block">Detailed Scope Parameters</label>
                                    <div class="bg-slate-50 border border-slate-100 rounded-xl p-3.5 text-xs text-slate-750 font-sans leading-relaxed whitespace-pre-line">
                                        {{ $this->selectedInquiry->project_details ?? 'No additional details provided.' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div class="space-y-6">
                            {{-- CRM Pipeline Control --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                                <div class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider">CRM Pipeline Management</div>
                                <div class="space-y-2">
                                    <label class="text-[10px] text-slate-550 font-semibold uppercase">Update Status</label>
                                    <select wire:change="updateInquiryStatus({{ $this->selectedInquiry->id }}, $event.target.value)" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl px-3 py-2.5 text-sm outline-none transition-all">
                                        @foreach(App\Models\FastInquiry::STATUSES as $status)
                                            <option value="{{ $status }}" {{ $this->selectedInquiry->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button wire:click="generateOfficialQuote({{ $this->selectedInquiry->id }})" class="w-full bg-cyan-600 hover:bg-cyan-700 text-white rounded-xl py-2.5 text-xs font-bold transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                                    Generate Official Quote
                                </button>
                            </div>

                            {{-- Administrative Notes --}}
                            <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                                <label class="text-[10px] uppercase font-semibold text-slate-500 tracking-wider block">Administrative Thread Notes</label>
                                <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 max-h-48 overflow-y-auto text-xs font-mono text-slate-650 space-y-2">
                                    @forelse($this->selectedInquiry->internal_notes ?? [] as $note)
                                        <div class="pb-1 border-b border-slate-100 last:border-b-0">
                                            {!! nl2br(e($note)) !!}
                                        </div>
                                    @empty
                                        <span class="text-slate-400 italic">No progress notes registered.</span>
                                    @endforelse
                                </div>
                                <div class="space-y-2">
                                    <textarea wire:model="newInquiryNote" rows="2" placeholder="Write logs here..." class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl p-2.5 text-xs outline-none transition-all"></textarea>
                                    <button wire:click="addInquiryNote" class="w-full bg-slate-800 hover:bg-slate-900 text-white rounded-xl py-2 text-xs font-semibold cursor-pointer transition-all duration-200">
                                        Log Administrative Note
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- LIST VIEW --}}
                <div class="space-y-6">
                    <div class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        {{-- Search Input --}}
                        <div class="relative flex-1 max-w-xl">
                            <input wire:model.live="search" type="text" placeholder="Search inquiries by client name, email, company..." class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl pl-10 pr-4 py-2.5 text-sm outline-none transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3.5 top-3.5 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        {{-- Status Filter --}}
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Filter Status:</span>
                            <select wire:model.live="statusFilter" class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl px-3 py-2 text-xs font-semibold outline-none transition-all">
                                <option value="All">ALL LEADS</option>
                                @foreach(App\Models\FastInquiry::STATUSES as $status)
                                    <option value="{{ $status }}">{{ strtoupper($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-sm font-bold text-slate-800">Inbound High-Intent Fast Inquiries</div>

                    {{-- TABLE CONTAINER --}}
                    <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-slate-100 bg-slate-50/50 text-[10px] uppercase font-bold text-slate-500 tracking-wider">
                                    <th class="py-4 px-6">Client &amp; Enterprise</th>
                                    <th class="py-4 px-6">Estimated Budget</th>
                                    <th class="py-4 px-6">Requested Scope</th>
                                    <th class="py-4 px-6">Status</th>
                                    <th class="py-4 px-6 text-right">Manage</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($this->inquiries as $inq)
                                    <tr class="hover:bg-slate-50/70 transition-all duration-150 text-xs">
                                        <td class="py-4 px-6">
                                            <div class="font-bold text-slate-800 text-sm font-sans">{{ $inq->name }}</div>
                                            <div class="text-xs text-slate-500 mt-0.5">{{ $inq->company ?? 'No Company' }}</div>
                                            <div class="text-[10px] text-slate-500 font-mono mt-1">{{ $inq->created_at->format('j/n/Y') }}</div>
                                        </td>
                                        <td class="py-4 px-6 font-mono text-xs text-slate-750 font-bold">
                                            {{ $inq->budget ?? 'Under Negotiation' }}
                                        </td>
                                        <td class="py-4 px-6 text-xs text-slate-655 max-w-xs truncate">
                                            {{ $inq->services_requested }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold font-mono border
                                                @if($inq->status === 'New') bg-amber-50 text-amber-700 border-amber-100
                                                @elseif($inq->status === 'Contacted') bg-indigo-50 text-indigo-700 border-indigo-100
                                                @elseif($inq->status === 'Qualified') bg-emerald-50 text-emerald-700 border-emerald-100
                                                @else bg-slate-50 text-slate-600 border-slate-100 @endif">
                                                {{ $inq->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button wire:click="examineInquiry({{ $inq->id }})" class="text-xs font-bold text-cyan-600 hover:text-cyan-700 inline-flex items-center gap-1 cursor-pointer transition-colors duration-150">
                                                Review Specifications &rarr;
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-500 italic">No inquiries found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        @elseif($activeTab === 'contacts')
            {{-- TAB 3: CONTACT MESSAGE INBOX --}}
            <div class="leads-contact-grid">
                {{-- Left column --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white border border-slate-100 rounded-2xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        {{-- Search Input --}}
                        <div class="relative flex-1 max-w-md">
                            <input wire:model.live="search" type="text" placeholder="Search contacts..." class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl pl-10 pr-4 py-2 text-sm outline-none transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3.5 top-3 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        {{-- Status Filter --}}
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Filter:</span>
                            <select wire:model.live="statusFilter" class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl px-2.5 py-1.5 text-xs font-semibold outline-none transition-all">
                                <option value="All">ALL LEADS</option>
                                @foreach(App\Models\ContactSubmission::STATUSES as $status)
                                    <option value="{{ $status }}">{{ strtoupper($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                        <h3 class="text-sm font-bold text-slate-800">General Contact Us form inbox</h3>
                        <div class="space-y-4 max-h-[600px] overflow-y-auto pr-2">
                            @forelse($this->contacts as $contact)
                                <div class="bg-slate-50 border border-slate-100/70 rounded-2xl p-4 flex gap-4 transition-all duration-200 relative hover:border-slate-200/50">
                                    <div class="shrink-0">
                                        <div class="h-10 w-10 rounded-full flex items-center justify-center border
                                            @if($contact->status === 'Unread') bg-amber-50 text-amber-600 border-amber-100/50
                                            @elseif($contact->status === 'Replied') bg-cyan-50 text-cyan-600 border-cyan-100/50
                                            @else bg-slate-50 text-slate-500 border-slate-150 @endif">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                        </div>
                                    </div>
                                    <div class="flex-1 space-y-1 text-xs">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <span class="font-bold text-slate-800 text-sm">{{ $contact->full_name }}</span>
                                                @if($contact->company)
                                                    <span class="text-xs text-slate-500 font-mono ml-1.5">({{ $contact->company }})</span>
                                                @endif
                                            </div>
                                            <span class="text-[10px] text-slate-500 font-mono">{{ $contact->created_at->format('j/n/Y') }}</span>
                                        </div>
                                        <div class="text-xs font-semibold text-slate-650 font-mono">{{ $contact->subject }}</div>
                                        <p class="text-xs text-slate-600 leading-relaxed">{{ $contact->message }}</p>

                                        {{-- Actions bar --}}
                                        <div class="flex items-center justify-between pt-2 border-t border-slate-100 mt-2">
                                            <div class="flex items-center gap-2">
                                                @if($contact->status === 'Unread')
                                                    <button wire:click="updateContactStatus({{ $contact->id }}, 'Read')" class="text-[10px] text-slate-600 hover:text-slate-800 transition-colors cursor-pointer font-semibold">Mark Read</button>
                                                @endif
                                                @if($contact->status !== 'Replied')
                                                    <button wire:click="updateContactStatus({{ $contact->id }}, 'Replied')" class="text-[10px] text-cyan-600 hover:text-cyan-700 transition-colors cursor-pointer font-bold">Mark Replied</button>
                                                @endif
                                            </div>
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold font-mono border
                                                @if($contact->status === 'Unread') bg-amber-50 text-amber-700 border-amber-100
                                                @elseif($contact->status === 'Replied') bg-cyan-50 text-cyan-650 border-cyan-100
                                                @else bg-slate-50 text-slate-600 border-slate-100 @endif">
                                                {{ $contact->status }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="py-8 text-center text-slate-500 italic">No contact submissions found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Right column --}}
                <div class="space-y-6">
                    {{-- SMTP panel --}}
                    <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-4">
                        <div class="flex justify-between items-center border-b border-slate-100 pb-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings text-cyan-600"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                <span class="text-sm font-bold text-slate-800">Auto-Responder SMTP</span>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer select-none">
                                <input type="checkbox" wire:click="toggleAutoResponder" class="sr-only peer" {{ $autoResponderEnabled ? 'checked' : '' }}>
                                <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-slate-400 after:border-slate-400 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-cyan-500"></div>
                            </label>
                        </div>
                        <p class="text-[11px] text-slate-500 leading-relaxed">Automate standard confirmations upon contact. Use tags <span class="text-cyan-600 font-mono">{full_name}</span> and <span class="text-cyan-600 font-mono">{subject}</span>.</p>
                        <div class="space-y-1">
                            <label class="text-[9px] uppercase font-bold text-slate-500 font-mono tracking-wider block">SMTP Template Body</label>
                            <textarea wire:model="smtpTemplateBody" rows="7" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl p-2.5 text-xs font-mono outline-none transition-all leading-relaxed"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    <style>
    /* Custom layout styling to guarantee horizontal rendering without Tailwind compile dependencies */
    .leads-stats-grid {
      display: flex;
      flex-direction: row;
      gap: 1.5rem;
      width: 100%;
      margin-bottom: 2rem;
    }
    .leads-stats-card {
      flex: 1;
      min-width: 0;
    }
    .leads-detail-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 1.5rem;
      width: 100%;
    }
    .leads-contact-grid {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 1.5rem;
      width: 100%;
    }
    .leads-info-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1.5rem;
    }
    .leads-features-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
    }
    @media (max-width: 1024px) {
      .leads-stats-grid {
        flex-direction: column;
      }
      .leads-detail-grid {
        grid-template-columns: 1fr;
      }
      .leads-contact-grid {
        grid-template-columns: 1fr;
      }
    }
    @media (max-width: 640px) {
      .leads-info-grid {
        grid-template-columns: 1fr;
      }
      .leads-features-grid {
        grid-template-columns: 1fr;
      }
    }

    /* Base Reset & Scrollbars */
    ::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }

    ::-webkit-scrollbar-track {
      background: 0 0;
    }

    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }
    .dark ::-webkit-scrollbar-thumb {
      background: #1f2124;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
    .dark ::-webkit-scrollbar-thumb:hover {
      background: #2d3139;
    }

    /* Glass Panels */
    .glass-panel {
      -webkit-backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.75);
      border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .dark .glass-panel {
      background: #0f1012bf;
      border: 1px solid #1f2124cc;
    }

    .dark-glass-panel {
      -webkit-backdrop-filter: blur(16px);
      background: rgba(255, 255, 255, 0.95);
      border: 1px solid rgba(226, 232, 240, 0.5);
    }
    .dark .dark-glass-panel {
      background: #0f1012f2;
      border: 1px solid #1f212480;
    }

    /* Input & Form Elements Override */
    :is(#main-app-container) input,
    :is(#main-app-container) select,
    :is(#main-app-container) textarea {
      color: #1e293b !important;
      background-color: #ffffff !important;
      border-color: rgba(226, 232, 240, 0.8) !important;
    }
    .dark :is(#main-app-container) input,
    .dark :is(#main-app-container) select,
    .dark :is(#main-app-container) textarea {
      color: #1e293b !important;
      background-color: #ffffff !important;
      border-color: rgba(226, 232, 240, 0.8) !important;
    }

    :is(#main-app-container) input:focus,
    :is(#main-app-container) select:focus,
    :is(#main-app-container) textarea:focus {
      border-color: #06b6d4 !important;
      outline: none !important;
    }
    </style>

    @verbatim
    <script>
    window.printQuote = function(quote, breakdown) {
        const featuresHtml = (quote.selected_features || []).map(f => `<li>${f}</li>`).join('') || '<li>None selected</li>';
        const addonsHtml = (quote.selected_addons || []).map(a => `<li>${a}</li>`).join('') || '<li>None selected</li>';

        const fmt = (val) => 'KES ' + Number(val).toLocaleString();

        let addonsRows = '';
        if (breakdown.addons && breakdown.addons.length > 0) {
            addonsRows = `
            <tr>
                <td colspan="2" style="font-weight: bold; padding-top: 15px; border-bottom: 1px solid #eee; font-size: 11px; text-transform: uppercase; color: #0891b2; letter-spacing: 0.5px;">Continuity &amp; SLA Add-ons</td>
            </tr>
            ` + breakdown.addons.map(a => `
            <tr>
                <td style="padding: 8px 0; color: #555;">&bull; ${a.name}</td>
                <td style="padding: 8px 0; text-align: right; font-weight: bold; font-family: monospace;">${fmt(a.price)}</td>
            </tr>
            `).join('');
        }

        let adjRow = '';
        if (breakdown.adjustment !== 0) {
            const sign = breakdown.adjustment < 0 ? '-' : '+';
            adjRow = `
            <tr>
                <td style="padding: 8px 0; color: #555; border-top: 1px solid #eee;">Custom Adjustment / Discount</td>
                <td style="padding: 8px 0; text-align: right; color: ${breakdown.adjustment < 0 ? '#b91c1c' : '#059669'}; font-weight: bold; border-top: 1px solid #eee; font-family: monospace;">
                    ${sign} ${fmt(Math.abs(breakdown.adjustment))}
                </td>
            </tr>
            `;
        }

        const htmlContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Statement of Work - ${quote.id_prefix || 'QT'}-${quote.id}</title>
            <style>
                body { font-family: 'Inter', system-ui, sans-serif; color: #1e293b; line-height: 1.5; margin: 40px; }
                .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #0891b2; padding-bottom: 20px; margin-bottom: 30px; }
                .logo { font-size: 24px; font-weight: 800; color: #0891b2; letter-spacing: -0.5px; }
                .meta { text-align: right; font-size: 13px; color: #64748b; line-height: 1.6; }
                .title { font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px; }
                .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
                .card { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 8px; }
                .card-title { font-size: 11px; text-transform: uppercase; font-weight: 700; color: #0891b2; margin-bottom: 10px; letter-spacing: 0.5px; }
                .card-body { font-size: 13px; color: #334155; line-height: 1.6; }
                ul { padding-left: 20px; margin: 5px 0; }
                li { font-size: 13px; color: #334155; margin-bottom: 5px; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
                td { padding: 10px 0; font-size: 13px; }
                .subtotal-table td { padding: 8px 0; }
                .total-row { background: #ecfdf5; border-top: 2px solid #059669; border-bottom: 2px solid #059669; font-size: 15px; font-weight: 800; color: #059669; }
                .signatures { display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin-top: 65px; padding-top: 40px; border-top: 1px solid #e2e8f0; }
                .signature-line { border-bottom: 1px solid #94a3b8; height: 40px; margin-bottom: 10px; }
                .signature-label { font-size: 12px; color: #64748b; text-align: center; }
                @media print {
                    body { margin: 20px; }
                }
            <\/style>
        <\/head>
        <body>
            <div class="header">
                <div>
                    <div class="logo">WAVERON</div>
                    <div style="font-size: 12px; color: #64748b;">Waveron Technologies Limited</div>
                </div>
                <div class="meta">
                    <div>Proposal Reference: <strong>${quote.id_prefix || 'QT'}-${quote.id}</strong></div>
                    <div>Issued: ${new Date(quote.created_at).toLocaleDateString('en-KE', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                    <div>Status: ${quote.status}</div>
                </div>
            </div>

            <div class="title">Statement of Work &amp; Commercial Proposal</div>

            <div class="grid">
                <div class="card">
                    <div class="card-title">Client Details</div>
                    <div class="card-body">
                        <div><strong>Client Email:</strong> ${quote.user_email}</div>
                        <div><strong>Company:</strong> ${quote.company || 'N/A'}</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">Project Scale &amp; Timeline</div>
                    <div class="card-body">
                        <div><strong>Service Type:</strong> ${quote.service_type}</div>
                        <div><strong>Scale &amp; Complexity:</strong> ${breakdown.complexity} (${breakdown.complexity_multiplier.toFixed(2)}x)</div>
                        <div><strong>Timeline Urgency:</strong> ${breakdown.timeline} (${breakdown.timeline_multiplier.toFixed(2)}x)</div>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-bottom: 30px;">
                <div class="card-title">Requested Systems &amp; Architectural Scope</div>
                <ul style="margin: 0; padding-left: 20px;">
                    ${featuresHtml}
                </ul>
            </div>

            <div class="card" style="margin-bottom: 30px;">
                <div class="card-title">SLA Support &amp; Continuity Addons</div>
                <ul style="margin: 0; padding-left: 20px;">
                    ${addonsHtml}
                </ul>
            </div>

            <div style="font-size: 12px; font-weight: 700; color: #0891b2; margin-bottom: 12px; text-transform: uppercase; letter-spacing: 0.5px;">Commercial Breakdown</div>
            <table class="subtotal-table">
                <tbody>
                    <tr>
                        <td style="color: #64748b;">Base Contract Price</td>
                        <td style="text-align: right; font-weight: bold; font-family: monospace;">${fmt(breakdown.base_price)}</td>
                    </tr>
                    <tr>
                        <td style="color: #64748b;">&bull; Complexity Adjustment</td>
                        <td style="text-align: right; font-weight: bold; font-family: monospace;">
                            ${breakdown.complexity_multiplier >= 1 ? '+' : '-'} ${fmt(Math.abs(Math.round(breakdown.base_price * (breakdown.complexity_multiplier - 1))))}
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #64748b;">&bull; Timeline Urgency Adjustment</td>
                        <td style="text-align: right; font-weight: bold; font-family: monospace;">
                            ${breakdown.timeline_multiplier >= 1 ? '+' : '-'} ${fmt(Math.abs(Math.round(breakdown.base_price * breakdown.complexity_multiplier * (breakdown.timeline_multiplier - 1))))}
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #64748b; border-bottom: 1px solid #eee; padding-bottom: 15px;">&bull; Scope / Features Adjustment</td>
                        <td style="text-align: right; font-weight: border-bottom: 1px solid #eee; padding-bottom: 15px; font-family: monospace;">
                            ${breakdown.feature_adj >= 1 ? '+' : '-'} ${fmt(Math.abs(Math.round(breakdown.base_price * breakdown.complexity_multiplier * breakdown.timeline_multiplier * (breakdown.feature_adj - 1))))}
                        </td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; padding-top: 10px;">Subtotal</td>
                        <td style="text-align: right; font-weight: bold; padding-top: 10px; font-family: monospace;">${fmt(breakdown.subtotal)}</td>
                    </tr>
                    ${addonsRows}
                    ${adjRow}
                    <tr class="total-row">
                        <td style="padding: 12px; font-weight: 800;">Estimated Total SOW Cost</td>
                        <td style="padding: 12px; text-align: right; font-weight: 800; font-family: monospace;">${fmt(breakdown.total)}</td>
                    </tr>
                </tbody>
            </table>

            <div class="signatures">
                <div>
                    <div class="signature-line"></div>
                    <div class="signature-label">Prepared by Waveron Technologies</div>
                </div>
                <div>
                    <div class="signature-line"></div>
                    <div class="signature-label">Approved &amp; Accepted by Client</div>
                </div>
            </div>
        <\/body>
        <\/html>
        `;

        const printWindow = window.open('', '_blank');
        printWindow.document.write(htmlContent);
        printWindow.document.close();
        printWindow.focus();
        setTimeout(() => {
            printWindow.print();
        }, 500);
    };
    </script>
    @endverbatim
</div>
</x-filament-panels::page>
