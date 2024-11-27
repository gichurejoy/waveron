<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <span class="text-primary fw-bold h4 mb-0">WAVERON</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item ms-lg-3">
                    <a class="btn btn-primary rounded-pill px-4" href="#contact">Get Started</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Spacer for fixed navbar -->
<div class="navbar-spacer" style="height: 76px;"></div>

@push('styles')
<style>
    .navbar {
        transition: all 0.3s ease;
    }
    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
    }
    .nav-link {
        font-weight: 500;
        transition: color 0.3s ease;
    }
    .nav-link:hover {
        color: var(--primary-color);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    });
</script>
@endpush
