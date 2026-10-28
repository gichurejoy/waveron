<style>
    /* Custom Resizable Sidebar Overrides */
    
    .sidebar-drag-handle {
        position: absolute;
        top: 0;
        right: -4px;
        width: 8px;
        height: 100%;
        cursor: col-resize;
        z-index: 50;
        background-color: transparent;
        transition: background-color 0.2s ease;
    }
    
    .sidebar-drag-handle:hover,
    .sidebar-drag-handle.is-dragging {
        background-color: rgba(16, 185, 129, 0.4) !important; /* emerald primary tint */
    }
    
    /* Disable text selection and enforce cursor globally during active drag */
    .is-dragging-sidebar, .is-dragging-sidebar * {
        user-select: none !important;
        cursor: col-resize !important;
    }
</style>

<script>
    (function() {
        // Apply saved width as early as possible to avoid layouts flicker
        const savedWidth = localStorage.getItem('filament-sidebar-width');
        if (savedWidth) {
            document.documentElement.style.setProperty('--sidebar-width', `${savedWidth}px`);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const setupDragResize = () => {
                const sidebar = document.querySelector('.fi-sidebar');
                if (!sidebar) return false;
                
                // Prevent duplicate handles
                if (sidebar.querySelector('.sidebar-drag-handle')) return true;
                
                const handle = document.createElement('div');
                handle.classList.add('sidebar-drag-handle');
                sidebar.appendChild(handle);
                
                let startX = 0;
                let startWidth = 0;
                
                const onMouseDown = (e) => {
                    // Check if sidebar is collapsed (should have fi-sidebar-open when expanded)
                    if (!sidebar.classList.contains('fi-sidebar-open')) return;
                    
                    startX = e.clientX;
                    startWidth = sidebar.getBoundingClientRect().width;
                    
                    handle.classList.add('is-dragging');
                    document.body.classList.add('is-dragging-sidebar');
                    
                    window.addEventListener('mousemove', onMouseMove);
                    window.addEventListener('mouseup', onMouseUp);
                };
                
                const onMouseMove = (e) => {
                    if (!sidebar.classList.contains('fi-sidebar-open')) {
                        onMouseUp();
                        return;
                    }
                    
                    const rect = sidebar.getBoundingClientRect();
                    const newWidth = Math.max(200, Math.min(600, e.clientX - rect.left));
                    
                    document.documentElement.style.setProperty('--sidebar-width', `${newWidth}px`);
                    localStorage.setItem('filament-sidebar-width', newWidth);
                };
                
                const onMouseUp = () => {
                    handle.classList.remove('is-dragging');
                    document.body.classList.remove('is-dragging-sidebar');
                    
                    window.removeEventListener('mousemove', onMouseMove);
                    window.removeEventListener('mouseup', onMouseUp);
                };
                
                handle.addEventListener('mousedown', onMouseDown);
                return true;
            };

            // Initial run
            setupDragResize();

            // Observe the DOM to re-inject handle on Livewire navigations
            const observer = new MutationObserver(() => {
                setupDragResize();
            });
            observer.observe(document.body, { childList: true, subtree: true });
        });
    })();
</script>
