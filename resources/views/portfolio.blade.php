@extends('layouts.app')

@section('title', 'Portfolio - Waveron Technologies')

@section('content')
<div class="portfolio-hero position-relative overflow-hidden">
    <div class="hero-particles"></div>
    <div class="hero-glow"></div>
    <div class="container position-relative">
        <div class="row min-vh-50 align-items-center py-5">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold text-white mb-4">Our Portfolio</h1>
                <p class="lead text-white-50">Discover our successful projects and digital innovations that have helped businesses grow.</p>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-filters py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="filters-wrapper d-flex justify-content-center flex-wrap gap-3">
                    <button class="filter-btn active" data-filter="all">All Projects</button>
                    <button class="filter-btn" data-filter="web">Web Development</button>
                    <button class="filter-btn" data-filter="mobile">Mobile Apps</button>
                    <button class="filter-btn" data-filter="ecommerce">E-Commerce</button>
                    <button class="filter-btn" data-filter="enterprise">Enterprise</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-grid py-5">
    <div class="container">
        <div class="row g-4">
            <!-- E-Commerce Project -->
            <div class="col-md-6 col-lg-4 portfolio-item" data-category="ecommerce">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="placeholder-image">
                            <i class="bi bi-cart3"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="overlay-content">
                                <span class="project-category">E-Commerce</span>
                                <a href="#" class="view-project">View Project</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h3>Modern E-Commerce Platform</h3>
                        <p>A full-featured online shopping platform with advanced features and seamless user experience.</p>
                        <div class="tech-stack">
                            <span>Laravel</span>
                            <span>Vue.js</span>
                            <span>MySQL</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile App Project -->
            <div class="col-md-6 col-lg-4 portfolio-item" data-category="mobile">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="placeholder-image">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="overlay-content">
                                <span class="project-category">Mobile App</span>
                                <a href="#" class="view-project">View Project</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h3>Health & Fitness App</h3>
                        <p>A comprehensive mobile application for tracking health metrics and workout routines.</p>
                        <div class="tech-stack">
                            <span>Flutter</span>
                            <span>Firebase</span>
                            <span>Node.js</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enterprise Project -->
            <div class="col-md-6 col-lg-4 portfolio-item" data-category="enterprise">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="placeholder-image">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="overlay-content">
                                <span class="project-category">Enterprise</span>
                                <a href="#" class="view-project">View Project</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h3>Enterprise Resource Planning</h3>
                        <p>Custom ERP solution for streamlining business operations and improving efficiency.</p>
                        <div class="tech-stack">
                            <span>Java</span>
                            <span>Spring Boot</span>
                            <span>PostgreSQL</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Web App Project -->
            <div class="col-md-6 col-lg-4 portfolio-item" data-category="web">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="placeholder-image">
                            <i class="bi bi-window-desktop"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="overlay-content">
                                <span class="project-category">Web Platform</span>
                                <a href="#" class="view-project">View Project</a>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-content">
                        <h3>Learning Management System</h3>
                        <p>Modern e-learning platform with interactive courses and real-time collaboration.</p>
                        <div class="tech-stack">
                            <span>React</span>
                            <span>Node.js</span>
                            <span>MongoDB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- More portfolio items can be added here -->
        </div>
    </div>
</div>

@include('partials.footer')
@endsection

@push('styles')
<style>
    .portfolio-hero {
        background: linear-gradient(180deg, #1a1a1a 0%, #2d2d2d 100%);
        min-height: 40vh;
        position: relative;
    }

    .filter-btn {
        background: rgba(26, 26, 26, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: rgba(0, 255, 157, 0.1);
        border-color: #00ff9d;
        color: #00ff9d;
    }

    .portfolio-card {
        background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
        border-radius: 16px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 255, 157, 0.15);
    }

    .portfolio-image {
        position: relative;
        overflow: hidden;
        aspect-ratio: 16/9;
        background: linear-gradient(145deg, #1a1a1a, #2d2d2d);
    }

    .placeholder-image {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(45deg, rgba(0, 255, 157, 0.1), rgba(0, 255, 157, 0.05));
        transition: transform 0.3s ease;
    }

    .placeholder-image i {
        font-size: 3rem;
        color: #00ff9d;
        opacity: 0.5;
    }

    .portfolio-card:hover .placeholder-image {
        transform: scale(1.05);
    }

    .portfolio-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(26, 26, 26, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-card:hover .portfolio-overlay {
        opacity: 1;
    }

    .overlay-content {
        text-align: center;
    }

    .project-category {
        display: block;
        color: #00ff9d;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }

    .view-project {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: #00ff9d;
        color: #1a1a1a;
        text-decoration: none;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .view-project:hover {
        background: #fff;
        transform: scale(1.05);
    }

    .portfolio-content {
        padding: 1.5rem;
    }

    .portfolio-content h3 {
        color: #fff;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .portfolio-content p {
        color: #a0a0a0;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .tech-stack {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tech-stack span {
        background: rgba(0, 255, 157, 0.1);
        color: #00ff9d;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        border: 1px solid rgba(0, 255, 157, 0.2);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            portfolioItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
