<div x-data="{ clock: '' }" x-init="clock = new Date().toLocaleTimeString('en-US', {timeZone:'Africa/Nairobi'}); setInterval(() => { clock = new Date().toLocaleTimeString('en-US', {timeZone:'Africa/Nairobi'}) }, 1000)" class="inline-flex items-center gap-2">
    <div class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg border border-gray-200 bg-white text-xs text-gray-600 font-mono shadow-xs dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300" title="Force flush system caches & database sync">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path><path d="M21 3v5h-5"></path><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path><path d="M8 16H3v5"></path></svg>
        <span>Sync: <span class="text-cyan-600 font-bold">0.4ms</span></span>
    </div>
    <div class="inline-flex items-center gap-1.5 h-9 px-3 rounded-lg border border-gray-200 bg-white text-xs text-gray-600 font-mono shadow-xs dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M12 6v6l4 2"></path><circle cx="12" cy="12" r="10"></circle></svg>
        <span>Nairobi: <span class="text-gray-900 font-semibold dark:text-gray-100" x-text="clock"></span></span>
    </div>
</div>
