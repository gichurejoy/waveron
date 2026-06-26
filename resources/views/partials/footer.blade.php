<footer class="footer py-5" style="background-color: #f8f9fa;">
    <div class="container-fluid px-lg-5 px-4">
        <div class="row gy-4">
            <div class="col-lg-2 col-md-6">
                <h5 class="text-primary mb-3">WAVERON</h5>
                <p class="text-muted">Empowering businesses through innovative technology solutions.</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/company/waveron-technologies" target="_blank" rel="noopener" class="me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.facebook.com/61563241431145" target="_blank" rel="noopener" class="me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="mb-3">Quick Links</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li><a href="{{ route('careers') }}">Careers</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                    <li><a href="{{ route('tools.index') }}">Tools</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    <li><a href="{{ route('quote') }}">Request Quote</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="mb-3">Services</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('services.software') }}">Software Development</a></li>
                    <li><a href="{{ route('services.design') }}">Graphic Design</a></li>
                    <li><a href="{{ route('services.branding') }}">Branding</a></li>
                    <li><a href="{{ route('services.marketing') }}">Digital Marketing</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="mb-3">Contact Us</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2 text-primary"></i>Westlands, Nairobi</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2 text-primary"></i>+254798717800</li>
                    <li class="mb-2 text-wrap"><i class="bi bi-envelope me-2 text-primary"></i>info@waverontechnologies.co.ke</li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="mb-3">Newsletter</h6>
                <p class="text-muted mb-3">Stay updated with our latest news and updates.</p>
                @if (session('newsletter_success'))
                    <div class="alert alert-success py-2 px-3 mb-2" role="alert" style="font-size: 0.8rem;">
                        {{ session('newsletter_success') }}
                    </div>
                @endif
                @if (session('newsletter_error'))
                    <div class="alert alert-danger py-2 px-3 mb-2" role="alert" style="font-size: 0.8rem;">
                        {{ session('newsletter_error') }}
                    </div>
                @endif
                <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
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
                <a href="{{ route('privacy-policy') }}" class="text-muted me-3">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}" class="text-muted">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

@push('styles')
    <style>
        footer.footer {
            background-color: #f8f9fa !important;
            color: #333 !important;
        }

        footer.footer a {
            color: #666 !important;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer.footer a:hover {
            color: var(--waveron-green) !important;
        }

        footer.footer .text-muted {
            color: #666 !important;
        }

        .social-links a {
            font-size: 1.2rem;
        }

        .newsletter-form .input-group {
            max-width: 100%;
        }
    </style>
@endpush