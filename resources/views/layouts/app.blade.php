<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/w.svg') }}">
    <title>@yield('title', 'Waveron Technologies')</title>
    <meta name="description" content="@yield('meta_description', 'Waveron Technologies is a leading software development, design, and digital marketing agency in Nairobi, Kenya.')">
    {{-- Canonical URL: prevents duplicate content issues. Uses the page-specific og_url if set, otherwise the current URL. --}}
    <link rel="canonical" href="{{ $__env->yieldContent('og_url') ?: url()->current() }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="{{ $__env->yieldContent('og_title') ?: $__env->yieldContent('title', 'Waveron Technologies') }}">
    <meta property="og:description" content="{{ $__env->yieldContent('og_description') ?: $__env->yieldContent('meta_description', 'Waveron Technologies is a leading software development, design, and digital marketing agency in Nairobi, Kenya.') }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:site_name" content="Waveron Technologies">
    <meta property="og:locale" content="en_KE">

    {{-- Twitter / X Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@waverontech">
    <meta name="twitter:title" content="{{ $__env->yieldContent('og_title') ?: $__env->yieldContent('title', 'Waveron Technologies') }}">
    <meta name="twitter:description" content="{{ $__env->yieldContent('og_description') ?: $__env->yieldContent('meta_description', 'Waveron Technologies is a leading software development, design, and digital marketing agency in Nairobi, Kenya.') }}">
    <meta name="twitter:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    @yield('meta')
    <!-- Resource Hints: DNS prefetch & preconnect for external CDNs -->
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//unpkg.com">
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Bootstrap CSS (critical, high priority) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" fetchpriority="high">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts (Inter) — display=swap prevents render blocking -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Schema.org JSON-LD Metadata -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Waveron Technologies",
      "url": "https://waverontechnologies.co.ke",
      "logo": "https://waverontechnologies.co.ke/images/w.svg",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+254798717800",
        "contactType": "customer service",
        "areaServed": "KE",
        "availableLanguage": "English"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Waveron Technologies",
      "url": "https://waverontechnologies.co.ke"
    }
    </script>
    @if(config('services.google.analytics_id'))
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google.analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config("services.google.analytics_id") }}');
        </script>
    @endif
    <!-- Google AdSense (deferred — non-critical) -->
    <script async defer src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3555921222521764"
        crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        :root {
            --waveron-green: #006400;
            --waveron-dark-green: #004d00;
        }

        html, body {
            overflow-x: clip;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            zoom: 0.87;
        }

        .btn-primary {
            background-color: var(--waveron-green);
            border-color: var(--waveron-green);
        }

        .btn-primary:hover {
            background-color: var(--waveron-dark-green);
            border-color: var(--waveron-dark-green);
        }

        .text-primary {
            color: var(--waveron-green) !important;
        }

        .bg-primary {
            background-color: var(--waveron-green) !important;
        }

        .btn-outline-primary {
            color: var(--waveron-green);
            border-color: var(--waveron-green);
        }

        .btn-outline-primary:hover {
            background-color: var(--waveron-green);
            border-color: var(--waveron-green);
            color: white;
        }
    </style>
    @stack('styles')
</head>

<body>
    <header>
        @include('partials.navbar')
    </header>

    <main>
        @yield('content')
    </main>

    <!-- AI Chatbot Widget -->
    @include('partials.chatbot')

    <!-- Blog Newsletter Popup -->
    @if(request()->routeIs('blog.*'))
        @include('components.newsletter-popup')
    @endif

    <!-- Global Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 2000;">
        <!-- Success Toast -->
        <div id="globalSuccessToast" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span id="globalSuccessToastMessage">Success!</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        
        <!-- Error Toast -->
        <div id="globalErrorToast" class="toast align-items-center text-white bg-danger border-0 rounded-3 shadow" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <span id="globalErrorToastMessage">An error occurred.</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Global Toast Helper Script -->
    <script>
        window.showToast = function(message, type = 'success') {
            if (type === 'success') {
                const toastMessage = document.getElementById('globalSuccessToastMessage');
                if (toastMessage) {
                    toastMessage.textContent = message;
                    const toastEl = document.getElementById('globalSuccessToast');
                    const toast = new bootstrap.Toast(toastEl, { delay: 6000 });
                    toast.show();
                }
            } else {
                const toastMessage = document.getElementById('globalErrorToastMessage');
                if (toastMessage) {
                    toastMessage.textContent = message;
                    const toastEl = document.getElementById('globalErrorToast');
                    const toast = new bootstrap.Toast(toastEl, { delay: 6000 });
                    toast.show();
                }
            }
        };

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                window.showToast("{{ session('success') }}", 'success');
            @endif
            @if(session('error'))
                window.showToast("{{ session('error') }}", 'error');
            @endif
            @if(session('newsletter_success'))
                window.showToast("{{ session('newsletter_success') }}", 'success');
            @endif
            @if(session('newsletter_error'))
                window.showToast("{{ session('newsletter_error') }}", 'error');
            @endif
        });
    </script>
    @stack('scripts')
    <!-- Lucide Icons (deferred — non-critical) -->
    <script defer src="https://unpkg.com/lucide@latest"></script>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        if (window.lucide) lucide.createIcons();
        // Fallback: retry after a short delay in case lucide loads late
        setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 800);
      });
    </script>

</body>

</html>