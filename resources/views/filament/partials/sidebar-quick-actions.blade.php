<div class="px-4 py-1.5 sticky top-0 z-10 bg-[#fbfbfb]">
    <button onclick="document.querySelector('.fi-global-search input, div.fi-global-search-field input, input[placeholder*=\'Search\']')?.focus()" class="flex items-center justify-between w-full px-3 py-2 bg-slate-100/80 hover:bg-slate-100 border border-slate-200/50 rounded-lg text-slate-700 transition-all duration-150 cursor-pointer shadow-sm">
        <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
            </svg>
            <span class="text-xs font-medium">Quick actions</span>
        </div>
        <kbd class="text-[10px] font-semibold text-slate-600 bg-white border border-slate-200 px-1.5 py-0.5 rounded shadow-sm">⌘ K</kbd>
    </button>
</div>

<script>
    document.addEventListener('keydown', function(e) {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            document.querySelector('.fi-global-search input, div.fi-global-search-field input, input[placeholder*="Search"]')?.focus();
        }
    });
</script>
