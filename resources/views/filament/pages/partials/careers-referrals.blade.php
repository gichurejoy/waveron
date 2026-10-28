<div class="space-y-6">
    <div class="space-y-1">
        <h3 class="text-base font-bold text-slate-800">Corporate Client Referral &amp; Payout Pipeline</h3>
        <p class="text-xs text-slate-500">Track and manage visitor submissions from the "Refer a Client" system, promote verified prospects into the active Leads Inbox, and oversee financial payout ledgers.</p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden flex flex-col">
        {{-- FILTERS PANEL --}}
        <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row gap-3 items-center justify-between">
            <div class="relative flex-1 w-full">
                <input wire:model.live="referralSearch" placeholder="Filter by referrer, tracking code (e.g. WVRN-), or client company..." class="w-full pl-9 pr-4 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm placeholder-slate-400 focus:outline-none transition-all duration-150" type="text">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-3 h-4 w-4 text-slate-400" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
            </div>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-funnel h-4 w-4 text-slate-400" aria-hidden="true"><path d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"></path></svg>
                <select wire:model.live="referralStatusFilter" class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl py-2 px-3 text-sm text-slate-700 focus:outline-none transition-all">
                    <option value="All">All Pipelines</option>
                    @foreach(App\Models\ClientReferral::STATUSES as $s)
                        <option value="{{ $s }}">{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- TABLE PIPELINE --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] uppercase font-bold tracking-wider text-slate-500">
                        <th class="p-4 pl-6">Referrer &amp; Tracking Code</th>
                        <th class="p-4">Client Lead / Organization</th>
                        <th class="p-4">Scope &amp; Pitched Services</th>
                        <th class="p-4">Stipulated Commission</th>
                        <th class="p-4">Payout Ledger</th>
                        <th class="p-4 text-right pr-6 w-56">Pipeline &amp; Lead Conversion</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($this->referrals as $ref)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="p-4 pl-6 align-top">
                            <div class="font-bold text-slate-800 text-sm">{{ $ref->referrer_name }}</div>
                            <div class="text-xs text-slate-500 font-mono mt-0.5">{{ $ref->referrer_contact }}</div>
                            <div class="mt-2 flex items-center gap-1.5">
                                <span class="font-mono text-[10px] font-bold px-2 py-0.5 rounded bg-cyan-50 text-cyan-700 border border-cyan-200/70">{{ $ref->referral_code }}</span>
                                <span class="text-[10px] text-slate-400 font-mono">{{ $ref->created_at->format('M d, Y') }}</span>
                            </div>
                        </td>
                        <td class="p-4 align-top">
                            <div class="font-bold text-slate-800 text-sm">{{ $ref->client_name }}</div>
                            @if($ref->client_contact_person)
                                <div class="text-xs text-slate-600 font-medium mt-0.5">👤 {{ $ref->client_contact_person }}</div>
                            @endif
                            <div class="flex flex-col gap-0.5 mt-1 text-[11px] text-slate-500 font-mono">
                                @if($ref->client_email)
                                    <a href="mailto:{{ $ref->client_email }}" class="text-cyan-600 hover:underline">✉ {{ $ref->client_email }}</a>
                                @endif
                                @if($ref->client_phone)
                                    <a href="tel:{{ $ref->client_phone }}" class="text-slate-600 hover:underline">✆ {{ $ref->client_phone }}</a>
                                @endif
                            </div>
                        </td>
                        <td class="p-4 align-top text-slate-600 max-w-[240px] text-xs leading-normal">
                            <div class="font-medium text-slate-700">{{ Str::limit($ref->services_needed ?: 'General Enterprise Technology Pitch', 100) }}</div>
                            @if($ref->notes)
                                <div class="text-[11px] text-slate-500 italic mt-1 bg-slate-50 p-2 rounded border border-slate-150">"{{ Str::limit($ref->notes, 120) }}"</div>
                            @endif
                        </td>
                        <td class="p-4 align-top font-mono">
                            <div class="flex items-center gap-1.5 text-xs text-slate-800 font-bold">
                                <span class="text-slate-500">KES</span>
                                <input class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-lg py-1 px-2 w-24 text-slate-800 font-bold font-mono focus:outline-none transition-all text-xs" 
                                    type="number" 
                                    value="{{ $ref->commission_amount }}" 
                                    wire:change="updateCommission({{ $ref->id }}, $event.target.value)"
                                    title="Edit Commission Amount (KES)">
                            </div>
                            <span class="text-[10px] text-slate-400 mt-1 block">Earned on settlement</span>
                        </td>
                        <td class="p-4 align-top">
                            <select class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl py-1 px-2.5 text-xs font-semibold focus:outline-none transition-all" 
                                wire:change="updatePayoutStatus({{ $ref->id }}, $event.target.value)">
                                @foreach(App\Models\ClientReferral::PAYOUT_STATUSES as $ps)
                                    <option value="{{ $ps }}" {{ $ref->payout_status === $ps ? 'selected' : '' }}>{{ $ps }}</option>
                                @endforeach
                            </select>
                            <div class="mt-1.5">
                                @php
                                    $badgeClass = match($ref->payout_status) {
                                        'Pending'     => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'In Progress' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                                        'Paid'        => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'Declined'    => 'bg-rose-50 text-rose-700 border-rose-200',
                                        default       => 'bg-amber-50 text-amber-700 border-amber-200',
                                    };
                                @endphp
                                <span class="px-2 py-0.5 border rounded-full text-[9px] font-mono font-bold uppercase tracking-wide {{ $badgeClass }}">{{ $ref->payout_status }}</span>
                            </div>
                        </td>
                        <td class="p-4 align-top text-right pr-6 whitespace-nowrap space-y-2">
                            <div>
                                <select class="bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 rounded-xl py-1 px-2.5 text-xs font-semibold focus:outline-none transition-all w-full max-w-[170px]" 
                                    wire:change="updateReferralStatus({{ $ref->id }}, $event.target.value)">
                                    @foreach(App\Models\ClientReferral::STATUSES as $s)
                                        <option value="{{ $s }}" {{ $ref->status === $s ? 'selected' : '' }}>{{ $s }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                @if($ref->promoted_to_lead)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-[11px] font-bold" title="Lead created in Leads Inbox">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><polyline points="20 6 9 17 4 12"/></svg>
                                        In Leads Pipeline
                                    </span>
                                @else
                                    <button wire:click="promoteReferralToLead({{ $ref->id }})" 
                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-cyan-600 hover:bg-cyan-700 text-white text-[11px] font-semibold transition-all shadow-sm cursor-pointer"
                                        title="Push this client referral into the Leads & Inquiries Inbox">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>
                                        Promote to Lead
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-xs text-slate-500 italic">No corporate client referrals found in pipeline.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
