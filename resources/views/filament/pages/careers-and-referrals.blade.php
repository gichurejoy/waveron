<x-filament-panels::page>
<div class="space-y-6" id="careers-module-container">
    {{-- TABS BAR --}}
    <div class="border-b border-gray-200 dark:border-gray-800 flex gap-2">
        <button wire:click="$set('activeTab', 'jobs')" class="pb-3 px-4 text-sm font-semibold relative cursor-pointer whitespace-nowrap transition-colors {{ $activeTab === 'jobs' ? 'text-cyan-600 font-bold border-b-2 border-cyan-500' : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200' }}">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase h-4 w-4" aria-hidden="true"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
                Open Technical Jobs ({{ $this->activeJobsCount }})
            </div>
        </button>
        <button wire:click="$set('activeTab', 'referrals')" class="pb-3 px-4 text-sm font-semibold relative cursor-pointer whitespace-nowrap transition-colors {{ $activeTab === 'referrals' ? 'text-cyan-600 font-bold border-b-2 border-cyan-500' : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200' }}">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users h-4 w-4" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><path d="M16 3.128a4 4 0 0 1 0 7.744"></path><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Client Referral Pipeline ({{ $this->referralsCount }})
            </div>
        </button>
        <button wire:click="$set('activeTab', 'applications')" class="pb-3 px-4 text-sm font-semibold relative cursor-pointer whitespace-nowrap transition-colors {{ $activeTab === 'applications' ? 'text-cyan-600 font-bold border-b-2 border-cyan-500' : 'text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200' }}">
            <div class="flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-check h-4 w-4" aria-hidden="true"><path d="m16 11 2 2 4-4"></path><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Job Applications ({{ $this->applicationsCount }})
            </div>
        </button>
    </div>

    {{-- ACTIVE TAB VIEW CONTENT --}}
    @if($activeTab === 'jobs')
        @include('filament.pages.partials.careers-jobs')
    @elseif($activeTab === 'referrals')
        @include('filament.pages.partials.careers-referrals')
    @elseif($activeTab === 'applications')
        @include('filament.pages.partials.careers-applications')
    @endif
</div>

<style>
/* Base Scrollbars */
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
.glowing-badge,
.glowing-badge-blue {
  box-shadow: 0 0 12px rgba(0, 209, 255, 0.15);
}
</style>
</x-filament-panels::page>
