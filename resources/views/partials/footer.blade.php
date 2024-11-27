<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h4 class="text-primary fw-bold mb-4">WAVERON</h4>
                <p class="text-muted mb-4">Leading the wave of technological advancement, empowering businesses to thrive in the digital age and beyond.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-muted hover-primary"><i class="bi bi-linkedin fs-5"></i></a>
                    <a href="#" class="text-muted hover-primary"><i class="bi bi-twitter fs-5"></i></a>
                    <a href="#" class="text-muted hover-primary"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#" class="text-muted hover-primary"><i class="bi bi-instagram fs-5"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="text-white mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#about" class="text-muted text-decoration-none hover-primary">About Us</a></li>
                    <li class="mb-2"><a href="#services" class="text-muted text-decoration-none hover-primary">Services</a></li>
                    <li class="mb-2"><a href="#contact" class="text-muted text-decoration-none hover-primary">Contact</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-primary">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4">
                <h5 class="text-white mb-4">Services</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-primary">Software Development</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-primary">Graphic Design</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-primary">Digital Marketing</a></li>
                    <li class="mb-2"><a href="#" class="text-muted text-decoration-none hover-primary">Branding</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4">
                <h5 class="text-white mb-4">Contact Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        <span class="text-muted">123 Innovation Street, Tech City, TC 12345</span>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-envelope text-primary me-2"></i>
                        <a href="mailto:contact@waveron.com" class="text-muted text-decoration-none hover-primary">contact@waveron.com</a>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-telephone text-primary me-2"></i>
                        <a href="tel:+1234567890" class="text-muted text-decoration-none hover-primary">+1 (234) 567-890</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="mb-md-0 text-muted">&copy; {{ date('Y') }} Waveron Technologies. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-muted text-decoration-none me-3">Terms of Service</a>
                <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

@push('styles')
<style>
    .hover-primary {
        transition: color 0.3s ease;
    }
    .hover-primary:hover {
        color: var(--primary-color) !important;
    }
</style>
@endpush
