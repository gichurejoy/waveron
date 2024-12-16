@extends('layouts.app')

@section('title', 'Graphic Design - Waveron Technologies')

@push('styles')
<style>
    :root {
        --color-1: #FF0F7B; /* Bright Pink */
        --color-2: #00FFE1; /* Cyan */
        --color-3: #01FF89; /* Neon Green */
        --color-4: #FFE600; /* Bright Yellow */
        --color-5: #4D4DFF; /* Electric Blue */
        --color-6: #FF3D00; /* Bright Orange */
    }

    /* Hero Section */
    .service-hero {
        background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
        position: relative;
        overflow: hidden;
        min-height: 80vh;
        perspective: 1000px;
    }

    .creative-bg {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: 
            radial-gradient(circle at 10% 20%, rgba(255, 15, 123, 0.15) 0%, transparent 20%),
            radial-gradient(circle at 90% 80%, rgba(0, 255, 225, 0.15) 0%, transparent 20%),
            radial-gradient(circle at 50% 50%, rgba(1, 255, 137, 0.15) 0%, transparent 30%);
        animation: bgPulse 10s ease-in-out infinite;
    }

    .creative-shapes {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 1;
        transform-style: preserve-3d;
    }

    .shape {
        position: absolute;
        opacity: 0.8;
        animation: float3d 20s infinite;
        transform-style: preserve-3d;
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .shape:nth-child(1) {
        width: 200px;
        height: 200px;
        top: 20%;
        right: 10%;
        background: linear-gradient(45deg, var(--color-1), var(--color-2));
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        animation-delay: 0s;
    }

    .shape:nth-child(2) {
        width: 150px;
        height: 150px;
        bottom: 20%;
        left: 15%;
        background: linear-gradient(45deg, var(--color-3), var(--color-4));
        clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
        animation-delay: -5s;
    }

    .shape:nth-child(3) {
        width: 100px;
        height: 100px;
        top: 30%;
        left: 30%;
        background: linear-gradient(45deg, var(--color-5), var(--color-6));
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        animation-delay: -10s;
    }

    @keyframes float3d {
        0%, 100% {
            transform: translateZ(0) rotateX(0) rotateY(0);
        }
        25% {
            transform: translateZ(100px) rotateX(45deg) rotateY(45deg);
        }
        50% {
            transform: translateZ(50px) rotateX(-45deg) rotateY(90deg);
        }
        75% {
            transform: translateZ(150px) rotateX(45deg) rotateY(-45deg);
        }
    }

    .hero-content {
        position: relative;
        z-index: 2;
        transform-style: preserve-3d;
    }

    .hero-title {
        font-size: 4.5rem;
        font-weight: 800;
        background: linear-gradient(45deg, var(--color-1), var(--color-2), var(--color-3));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
        display: inline-block;
        text-shadow: 0 0 30px rgba(255, 15, 123, 0.3);
        transform: translateZ(50px);
        letter-spacing: -2px;
    }

    .hero-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--color-1), var(--color-2), var(--color-3));
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .hero-title:hover::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    /* Creative Cards */
    .creative-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        transform-style: preserve-3d;
        transform: perspective(1000px) rotateX(0deg);
        height: 100%;
    }

    .creative-card:hover {
        transform: perspective(1000px) rotateX(10deg) translateY(-10px);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .creative-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, 
            rgba(var(--color-1-rgb), 0.1), 
            rgba(var(--color-2-rgb), 0.1));
        opacity: 0;
        transition: opacity 0.5s ease;
        z-index: 0;
    }

    .creative-card:hover::before {
        opacity: 1;
    }

    .creative-card-content {
        position: relative;
        z-index: 1;
        transform-style: preserve-3d;
    }

    .creative-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        position: relative;
        transform-style: preserve-3d;
        transform: translateZ(30px);
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .creative-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, var(--color-1), var(--color-3));
        border-radius: 24px;
        transform: translateZ(-10px);
        filter: blur(15px);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .creative-icon i {
        font-size: 2.5rem;
        color: #fff;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }

    .white-section .creative-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.5rem;
        position: relative;
        transform-style: preserve-3d;
        transform: translateZ(30px);
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(135deg, #00ff88, #00cc6a);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .white-section .creative-icon::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, #00ff88, #00cc6a);
        border-radius: 24px;
        transform: translateZ(-10px);
        filter: blur(15px);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .white-section .creative-icon i {
        font-size: 2.5rem;
        color: #fff;
        text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
        z-index: 1;
    }

    .white-section .creative-card:hover .creative-icon {
        transform: translateZ(50px) rotateY(360deg);
        background: linear-gradient(135deg, #00ff88, #00cc6a);
        box-shadow: 0 10px 30px rgba(0, 204, 106, 0.3);
    }

    .white-section .creative-card:hover .creative-icon::before {
        opacity: 0.8;
    }

    .white-section .section-title {
        color: #333 !important;
        text-shadow: 0 0 30px rgba(0, 204, 106, 0.2);
    }

    /* Tools Section */
    .tools-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
        perspective: 1000px;
    }

    .tool-item {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
        transform-style: preserve-3d;
    }

    .tool-item:nth-child(1) { --tool-color: var(--color-1); }
    .tool-item:nth-child(2) { --tool-color: var(--color-2); }
    .tool-item:nth-child(3) { --tool-color: var(--color-3); }
    .tool-item:nth-child(4) { --tool-color: var(--color-4); }

    .tool-item::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, var(--tool-color), transparent);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .tool-item:hover {
        transform: translateZ(20px) rotateX(10deg);
    }

    .tool-item:hover::before {
        opacity: 0.1;
    }

    .tool-icon {
        font-size: 3.5rem;
        color: var(--tool-color);
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
        text-shadow: 0 0 30px var(--tool-color);
        transition: all 0.5s ease;
    }

    .tool-item:hover .tool-icon {
        transform: scale(1.2) translateZ(30px);
        filter: drop-shadow(0 0 10px var(--tool-color));
    }

    .tool-name {
        font-size: 1.4rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
        transform: translateZ(20px);
    }

    .tool-description {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.7);
        position: relative;
        z-index: 1;
        transform: translateZ(10px);
    }

    .tool-features {
        margin-top: 1rem;
        height: 0;
        overflow: hidden;
        transition: height 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        z-index: 1;
    }

    .tool-item:hover .tool-features {
        height: 100px;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-list li {
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        transform: translateZ(15px);
    }

    body {
        background: #1a1a1a;
        color: #fff;
    }

    .section-title {
        color: #fff !important;
        text-shadow: 0 0 30px var(--color-1);
    }

    .lead {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .white-section {
        background: #fff;
        color: #333;
        position: relative;
        z-index: 2;
    }

    .white-section .section-title {
        color: #333 !important;
        text-shadow: 0 0 30px rgba(0, 204, 106, 0.2);
    }

    .white-section .lead {
        color: #666 !important;
    }

    .white-section .creative-card {
        background: #fff;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .white-section .creative-card:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), #fff);
    }

    .white-section .tool-item {
        background: #fff;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .white-section .tool-name {
        color: #333;
    }

    .white-section .tool-description {
        color: #666;
    }

    .white-section .feature-list li {
        color: #666;
    }

    .white-section .creative-card h3 {
        color: #333;
    }

    .white-section .creative-card p {
        color: #666;
    }
</style>
@endpush

@section('content')
<div class="service-hero d-flex align-items-center">
    <div class="creative-bg"></div>
    <div class="creative-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <div class="hero-content">
                    <h1 class="hero-title mb-4">Creative Design Solutions</h1>
                    <p class="lead mb-5">Transform your ideas into stunning visual experiences</p>
                    <a href="/services/graphic-design" class="btn btn-primary btn-lg" style="background: linear-gradient(45deg, var(--color-1), var(--color-3)); border: none; transform: translateZ(20px); box-shadow: 0 0 30px rgba(255, 15, 123, 0.3);">Start Your Project</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="white-section">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title mb-4">Our Design Services</h2>
                <p class="lead">Professional design solutions tailored to your needs</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="creative-card">
                    <div class="creative-card-content">
                        <div class="creative-icon">
                            <i class="bi bi-brush"></i>
                        </div>
                        <h3>Logo Design</h3>
                        <p>Create a memorable brand identity with our custom logo design services.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="creative-card">
                    <div class="creative-card-content">
                        <div class="creative-icon">
                            <i class="bi bi-layout-text-window-reverse"></i>
                        </div>
                        <h3>Print Design</h3>
                        <p>Professional brochures, business cards, and marketing materials.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="creative-card">
                    <div class="creative-card-content">
                        <div class="creative-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        <h3>Digital Design</h3>
                        <p>Social media graphics, web banners, and digital marketing assets.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tools Section -->
<div class="white-section">
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-8 text-center">
                <h2 class="section-title mb-4">Design Tools</h2>
                <p class="lead">Industry-standard software for professional results</p>
            </div>
        </div>
        <div class="tools-grid">
            <div class="tool-item">
                <i class="bi bi-bezier2 tool-icon"></i>
                <h4 class="tool-name">Adobe Illustrator</h4>
                <p class="tool-description">Vector graphics and logo design</p>
                <div class="tool-features">
                    <ul class="feature-list">
                        <li>Vector Illustration</li>
                        <li>Logo Design</li>
                        <li>Brand Assets</li>
                    </ul>
                </div>
            </div>
            <div class="tool-item">
                <i class="bi bi-layers tool-icon"></i>
                <h4 class="tool-name">Adobe Photoshop</h4>
                <p class="tool-description">Image editing and manipulation</p>
                <div class="tool-features">
                    <ul class="feature-list">
                        <li>Photo Editing</li>
                        <li>Digital Art</li>
                        <li>Web Graphics</li>
                    </ul>
                </div>
            </div>
            <div class="tool-item">
                <i class="bi bi-file-earmark-pdf tool-icon"></i>
                <h4 class="tool-name">Adobe InDesign</h4>
                <p class="tool-description">Print and digital publication</p>
                <div class="tool-features">
                    <ul class="feature-list">
                        <li>Page Layout</li>
                        <li>Print Design</li>
                        <li>Digital Publishing</li>
                    </ul>
                </div>
            </div>
            <div class="tool-item">
                <i class="bi bi-pencil-square tool-icon"></i>
                <h4 class="tool-name">Figma</h4>
                <p class="tool-description">UI/UX and web design</p>
                <div class="tool-features">
                    <ul class="feature-list">
                        <li>Interface Design</li>
                        <li>Prototyping</li>
                        <li>Collaboration</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer')

@endsection