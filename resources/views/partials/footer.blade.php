<footer class="footer py-5" style="background-color: #f8f9fa;">
    <div class="container-fluid px-lg-5 px-4">
        <div class="row gy-4">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-primary mb-3 fw-bold">WAVERON</h5>
                <p class="text-muted mb-2">Custom software and websites for businesses everywhere. Built in Nairobi, Kenya.</p>
                <p class="text-muted small mb-3">Working with clients worldwide.</p>
                <div class="social-links">
                    <a href="https://www.linkedin.com/company/waveron-technologies" target="_blank" rel="noopener" class="me-3" aria-label="Waveron on LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="me-3" aria-label="Waveron on Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="https://www.facebook.com/61563241431145" target="_blank" rel="noopener" class="me-3" aria-label="Waveron on Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-3" aria-label="Waveron on Instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="mb-3 fw-bold text-dark">Quick Links</h6>
                <ul class="list-unstyled mb-0 footer-links-list">
                    <li class="mb-2"><a href="{{ route('home') }}">Home</a></li>
                    <li class="mb-2"><a href="{{ route('blog.index') }}">Blog</a></li>
                    <li class="mb-2"><a href="{{ route('careers') }}">Careers</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}">About</a></li>
                    <li class="mb-2"><a href="{{ route('portfolio') }}">Portfolio</a></li>
                    <li class="mb-2"><a href="{{ route('tools.index') }}">Tools</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
                    <li class="mb-2"><a href="{{ route('quote') }}">Request Quote</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="mb-3 fw-bold text-dark">Services</h6>
                <ul class="list-unstyled mb-0 footer-links-list">
                    <li class="mb-2"><a href="{{ route('services.software') }}">Custom Software</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}">Websites &amp; E-commerce</a></li>
                    <li class="mb-2"><a href="{{ route('services.software') }}">Business Systems</a></li>
                    <li class="mb-2"><a href="{{ route('services.design') }}">Branding &amp; Design</a></li>
                    <li class="mb-2"><a href="{{ route('services.marketing') }}">SEO &amp; Digital Marketing</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6 class="mb-3 fw-bold text-dark">Contact Us</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2 text-primary"></i>Westlands, Nairobi</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2 text-primary"></i><a href="tel:+254798717800" class="text-secondary text-decoration-none">+254798717800</a></li>
                    <li class="mb-2"><i class="bi bi-whatsapp me-2 text-success"></i><a href="https://wa.me/254798717800?text=Hi%20Waveron%2C%20I%27d%20like%20to%20discuss%20a%20project." target="_blank" rel="noopener" aria-label="Chat with Waveron on WhatsApp" class="text-secondary text-decoration-none">WhatsApp: +254 798 717 800</a></li>
                    <li class="mb-2 text-wrap"><i class="bi bi-envelope me-2 text-primary"></i><a href="mailto:info@waverontechnologies.co.ke" class="text-secondary text-decoration-none">info@waverontechnologies.co.ke</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h6 class="mb-3 fw-bold text-dark">Newsletter</h6>
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
                <p class="mb-0 text-muted">&copy; {{ date('Y') }} Waveron Technologies. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('privacy-policy') }}" class="text-muted text-decoration-none me-3 hover-green">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}" class="text-muted text-decoration-none hover-green">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<style>
    footer.footer {
        background-color: #f8f9fa !important;
        color: #333 !important;
    }

    footer.footer a {
        color: #64748b !important;
        text-decoration: none !important;
        transition: color 0.2s ease;
    }

    footer.footer a:hover {
        color: var(--waveron-green, #006400) !important;
        text-decoration: none !important;
    }

    footer.footer .social-links a {
        color: #64748b !important;
        font-size: 1.2rem;
        display: inline-block;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    footer.footer .social-links a:hover {
        color: var(--waveron-green, #006400) !important;
        transform: translateY(-2px);
    }

    footer.footer .hover-green:hover {
        color: var(--waveron-green, #006400) !important;
    }

    .newsletter-form .input-group {
        max-width: 100%;
    }
</style>