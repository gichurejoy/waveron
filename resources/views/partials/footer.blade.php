<footer class="footer py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <h5 class="text-primary mb-3">WAVERON</h5>
                <p class="text-muted">Empowering businesses through innovative technology solutions.</p>
                <div class="social-links">
                    <a href="#" class="me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h6 class="mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h6 class="mb-3">Contact Us</h6>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt me-2"></i>Westlands, Nairobi</li>
                    <li><i class="bi bi-telephone me-2"></i>+1 630-480-4540</li>
                    <li><i class="bi bi-envelope me-2"></i>info@waveron.com</li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-4">
                <h6 class="mb-3">Newsletter</h6>
                <p class="text-muted mb-3">Stay updated with our latest news and updates.</p>
                <form class="newsletter-form">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
        <hr class="my-4">
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-0">&copy; {{ date('Y') }} Waveron. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted me-3">Privacy Policy</a>
                <a href="#" class="text-muted">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    footer {
        background-color: #f8f9fa;
    }

    footer a {
        color: #666;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    footer a:hover {
        color: var(--waveron-green);
    }

    .social-links a {
        font-size: 1.2rem;
    }

    .newsletter-form .input-group {
        max-width: 300px;
    }
</style>
@endpush
