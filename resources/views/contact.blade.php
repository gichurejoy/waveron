@extends('layouts.app')

@section('title', 'Contact Us - Waveron Technologies')

@section('content')
<!-- Contact Header -->
<div class="contact-header bg-primary text-white py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-4">Get In Touch</h1>
                <p class="lead mb-0">Have a question or project in mind? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section py-5">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h3 fw-bold mb-4">Send Us a Message</h2>
                        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                            id="name" name="name" required placeholder="John Doe"
                                            value="{{ old('name') }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                            id="email" name="email" required placeholder="john@example.com"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                            id="subject" name="subject" required placeholder="How can we help?"
                                            value="{{ old('subject') }}">
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" 
                                            id="message" name="message" rows="5" required 
                                            placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send me-2"></i>Send Message
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-lg-5">
                <div class="contact-info bg-light p-4 p-md-5 rounded-3 h-100">
                    <h3 class="fw-bold mb-4">Contact Information</h3>
                    <div class="d-flex mb-4">
                        <div class="contact-icon bg-primary text-white me-3">
                            <i class="bi bi-geo-alt"></i>
                        </div>
                        <div>
                            <h4 class="h5 mb-2">Our Location</h4>
                            <p class="text-muted mb-0">Westlands<br>Nairobi City, Kenya</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="contact-icon bg-primary text-white me-3">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <div>
                            <h4 class="h5 mb-2">Email Us</h4>
                            <p class="text-muted mb-0">
                                <a href="mailto:contact@waveron.com" class="text-decoration-none text-muted">contact@waveron.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="contact-icon bg-primary text-white me-3">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div>
                            <h4 class="h5 mb-2">Call Us</h4>
                            <p class="text-muted mb-0">
                                <a href="tel:+1234567890" class="text-decoration-none text-muted">+2547 98 717 800</a>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="contact-icon bg-primary text-white me-3">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div>
                            <h4 class="h5 mb-2">Working Hours</h4>
                            <p class="text-muted mb-0">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 7:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .contact-header {
        position: relative;
        overflow: hidden;
    }
    .contact-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0) 100%);
    }
    .contact-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    .form-control {
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-color-rgb), 0.25);
    }
    .contact-info {
        box-shadow: 0 0.5rem 1.5rem rgba(0,0,0,0.05);
    }
</style>
@endpush
@endsection
