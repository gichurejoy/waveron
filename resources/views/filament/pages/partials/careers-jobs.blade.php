<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="space-y-1">
            <h3 class="text-base font-bold text-slate-800">Open Recruitment Postings Directory</h3>
            <p class="text-xs text-slate-500">Edit open systems roles, compensation, locations, and technical prerequisites.</p>
        </div>
        <button wire:click="openPublishModal" class="bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-bold h-9 px-4 rounded-xl flex items-center gap-1.5 cursor-pointer shadow-sm transition-all duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus h-4 w-4" aria-hidden="true"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
            Publish Role
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($this->jobs as $role)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 flex flex-col justify-between {{ $role->status === 'Archived' ? 'opacity-60' : '' }}">
            <div class="space-y-4">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="text-[10px] text-slate-500 font-mono font-bold block uppercase">{{ $role->code }}</span>
                        <h4 class="font-bold text-slate-800 text-sm mt-0.5">{{ $role->title }}</h4>
                    </div>
                    <button class="p-1.5 rounded-xl border transition-all duration-200 bg-cyan-50 border-cyan-100/50 text-cyan-600 hover:bg-cyan-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye h-4 w-4" aria-hidden="true"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    </button>
                </div>
                <div class="flex items-center gap-3 text-xs text-slate-500 font-medium">
                    <span class="bg-slate-50 border border-slate-100 text-slate-600 py-0.5 px-2.5 rounded-full text-[10px] font-bold">{{ $role->employment_type }}</span>
                    <span class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin h-3.5 w-3.5 text-slate-400" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        {{ $role->location }}
                    </span>
                    @if($role->status === 'Archived')
                        <span class="bg-slate-100 text-slate-500 py-0.5 px-2.5 rounded-full text-[9px] font-bold uppercase font-mono">Archived</span>
                    @endif
                </div>
                <div class="p-3 bg-slate-50/70 border border-slate-100 rounded-xl text-xs">
                    <span class="text-[9px] font-mono text-slate-400 block font-bold uppercase tracking-wider">Compensation Scale</span>
                    <span class="font-bold font-mono text-slate-700">{{ $role->compensation }}</span>
                </div>
                @if(count($role->prerequisites ?? []) > 0)
                <div class="pt-2">
                    <span class="text-[9px] text-slate-500 font-mono block font-bold uppercase mb-1.5 tracking-wider">Prerequisites Checklist</span>
                    <div class="text-xs text-slate-600 line-clamp-3 leading-relaxed whitespace-pre-wrap">@foreach($role->prerequisites as $prereq)* {{ $prereq }}
@endforeach</div>
                </div>
                @endif
            </div>
            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button wire:click="openEditModal({{ $role->id }})" class="text-xs font-bold text-slate-500 hover:text-slate-800 cursor-pointer transition-colors">Edit Details</button>
                @if($role->status === 'Active')
                    <button wire:click="archiveRole({{ $role->id }})" class="text-xs font-bold text-rose-500 hover:text-rose-700 cursor-pointer transition-colors" wire:confirm="Archive this position?">Archive</button>
                @else
                    <button wire:click="restoreRole({{ $role->id }})" class="text-xs font-bold text-cyan-600 hover:text-cyan-800 cursor-pointer transition-colors">Restore</button>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-xs p-12 text-center flex flex-col items-center justify-center space-y-4">
            <div class="w-12 h-12 rounded-2xl bg-cyan-50 border border-cyan-100 flex items-center justify-center text-cyan-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
            </div>
            <div class="space-y-1 max-w-sm">
                <h4 class="text-sm font-bold text-slate-800">No Active Recruitment Postings</h4>
                <p class="text-xs text-slate-500">There are currently no open job positions configured in the directory.</p>
            </div>
            <button wire:click="openPublishModal" class="bg-cyan-600 hover:bg-cyan-700 text-white font-sans text-xs font-bold h-9 px-4 rounded-xl flex items-center gap-1.5 cursor-pointer shadow-xs transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M5 12h14"></path><path d="M12 5v14"></path></svg>
                Publish New Role
            </button>
        </div>
        @endforelse
    </div>
</div>

{{-- PUBLISH MODAL --}}
@if($showPublishModal)
<div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" wire:click.self="$set('showPublishModal',false)">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-2xl p-6 w-full max-w-lg max-h-[90vh] overflow-y-auto space-y-4">
        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 font-mono">Publish New Career Role</h3>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Role Code (e.g. SNR-SYSTEMS-DEV)</label>
            <input wire:model="roleCode" type="text" placeholder="SNR-SYSTEMS-DEV" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm placeholder-slate-400 focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Job Title</label>
            <input wire:model="roleTitle" type="text" placeholder="Senior Systems Developer (Rust/Go)" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm placeholder-slate-400 focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Employment Type</label>
            <select wire:model="roleEmploymentType" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl py-2 px-3 text-sm focus:outline-none transition-all">
                @foreach(App\Models\CareerRole::EMPLOYMENT_TYPES as $t)
                    <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Location</label>
            <input wire:model="roleLocation" type="text" placeholder="Nairobi, Kenya (Hybrid)" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm placeholder-slate-400 focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Compensation Scale</label>
            <input wire:model="roleCompensation" type="text" placeholder="KES 450,000 - 680,000 / Month + Tech Equity" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm placeholder-slate-400 focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Prerequisites (one per line)</label>
            <textarea wire:model="rolePrerequisites" rows="4" placeholder="5+ years Go/Rust experience&#10;Deep Linux kernel knowledge" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm placeholder-slate-400 focus:outline-none transition-all"></textarea>
        </div>
        <div class="flex gap-3 justify-end pt-3 border-t border-slate-100">
            <button wire:click="$set('showPublishModal',false)" class="text-xs font-semibold text-slate-500 hover:text-slate-800 cursor-pointer px-4 py-2 transition-colors">Cancel</button>
            <button wire:click="publishRole" class="bg-cyan-600 hover:bg-cyan-700 text-white font-sans text-xs font-bold py-2.5 px-4 rounded-xl shadow-sm cursor-pointer transition-colors">Publish Role</button>
        </div>
    </div>
</div>
@endif

{{-- EDIT MODAL --}}
@if($showEditModal)
<div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" wire:click.self="$set('showEditModal',false)">
    <div class="bg-white rounded-2xl border border-slate-100 shadow-2xl p-6 w-full max-w-lg max-h-[90vh] overflow-y-auto space-y-4">
        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 font-mono">Edit Career Role</h3>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Job Title</label>
            <input wire:model="roleTitle" type="text" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Employment Type</label>
            <select wire:model="roleEmploymentType" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl py-2 px-3 text-sm focus:outline-none transition-all">
                @foreach(App\Models\CareerRole::EMPLOYMENT_TYPES as $t)
                    <option value="{{ $t }}">{{ $t }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Location</label>
            <input wire:model="roleLocation" type="text" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Compensation Scale</label>
            <input wire:model="roleCompensation" type="text" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm focus:outline-none transition-all">
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Prerequisites (one per line)</label>
            <textarea wire:model="rolePrerequisites" rows="4" class="w-full px-3 py-2 bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl text-sm focus:outline-none transition-all"></textarea>
        </div>
        <div class="flex flex-col gap-1">
            <label class="text-[10px] text-slate-500 font-mono font-bold uppercase">Status</label>
            <select wire:model="roleStatus" class="w-full bg-white border border-slate-200/80 hover:border-slate-350 focus:border-cyan-500 text-slate-800 rounded-xl py-2 px-3 text-sm focus:outline-none transition-all">
                <option value="Active">Active</option>
                <option value="Archived">Archived</option>
            </select>
        </div>
        <div class="flex gap-3 justify-end pt-3 border-t border-slate-100">
            <button wire:click="$set('showEditModal',false)" class="text-xs font-semibold text-slate-500 hover:text-slate-800 cursor-pointer px-4 py-2 transition-colors">Cancel</button>
            <button wire:click="updateRole" class="bg-cyan-600 hover:bg-cyan-700 text-white font-sans text-xs font-bold py-2.5 px-4 rounded-xl shadow-sm cursor-pointer transition-colors">Save Changes</button>
        </div>
    </div>
</div>
@endif
