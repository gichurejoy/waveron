<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/w.svg') }}">
    <title>@yield('title', 'Waveron')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Google Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
        :root {
            --waveron-green: #006400;
            --waveron-dark-green: #004d00;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            zoom: 0.8;
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <script src="https://unpkg.com/lucide@latest"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    lucide.createIcons();
  });
</script>

</body>

</html>