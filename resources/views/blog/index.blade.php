@extends('layouts.app')

@section('title', 'Blog | Waveron Technologies')

@section('content')
<!-- Abstract Blog Hero Banner -->
<div class="position-relative overflow-hidden w-100 py-5 d-flex align-items-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); margin-top: 0px; min-height: 360px;">
    <!-- Morphing Motion Blobs -->
    <div class="shape-blob"></div>
    <div class="shape-blob2"></div>

    <!-- Grid Perspective Overlay -->
    <div class="position-absolute start-0 top-0 w-100 h-100 grid-perspective" style="pointer-events: none;"></div>
    
    <!-- SVG Frequency Waves (representing "Waveron" & Ideas Flow) -->
    <svg class="position-absolute end-0 bottom-0 h-100 w-50 opacity-25" style="pointer-events: none;" viewBox="0 0 600 300" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="animated-wave" d="M-100,150 C50,50 150,250 300,150 C450,50 550,250 700,150" stroke="#006400" stroke-width="2.5" stroke-dasharray="8 4" />
        <path d="M-100,180 C80,80 120,280 300,180 C480,80 520,280 700,180" stroke="#006400" stroke-width="1.5" />
        <path d="M-100,120 C30,20 180,220 300,120 C420,20 570,220 700,120" stroke="#004d00" stroke-width="1.0" opacity="0.5" />
        <!-- Glowing Data Nodes -->
        <circle cx="100" cy="115" r="4" fill="#006400" />
        <circle cx="300" cy="180" r="5" fill="#006400" />
        <circle cx="480" cy="100" r="4.5" fill="#004d00" />
        <circle cx="210" cy="205" r="3.5" fill="#006400" />
    </svg>

    <!-- Floating Concept Particles (isometric diamonds) -->
    <div class="position-absolute concept-diamond-1" style="top: 25%; left: 80%; width: 15px; height: 15px; background-color: rgba(0, 100, 0, 0.15); pointer-events: none;"></div>
    <div class="position-absolute concept-diamond-2" style="top: 70%; left: 63%; width: 22px; height: 22px; background-color: rgba(0, 100, 0, 0.1); pointer-events: none;"></div>
    <div class="position-absolute concept-diamond-3" style="top: 45%; left: 48%; width: 12px; height: 12px; background-color: rgba(0, 100, 0, 0.25); pointer-events: none;"></div>

    <div class="container position-relative z-1 py-4">
        <div class="row align-items-center">
            <div class="col-lg-7 text-start">
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill mb-3 text-uppercase fw-bold" style="letter-spacing: 1.5px; font-size: 0.75rem;">Waveron Insights</span>
                <h1 class="display-4 fw-bold text-dark mb-3" style="letter-spacing: -1px; line-height: 1.1;">Connecting Code,<br>Design & Strategy</h1>
                <p class="lead text-muted mb-4 fs-5" style="max-width: 650px; line-height: 1.6;">
                    Explore our latest thoughts, developer guides, and digital strategies driving modern software solutions and marketing growth.
                </p>
                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <a href="#posts-section" class="btn btn-success fw-bold px-4 py-2 me-2" style="background-color: var(--waveron-green); border-color: var(--waveron-green); border-radius: 6px;">
                        Read Articles
                    </a>
                    @if($categories->isNotEmpty())
                        <div class="d-flex flex-wrap gap-2 align-items-center ms-lg-2 mt-2 mt-lg-0">
                            <a href="{{ route('blog.index') }}" class="btn btn-sm rounded-pill px-3 {{ !$currentCategory ? 'btn-success' : 'btn-outline-success' }}" style="font-size: 0.8rem; font-weight: 500;">All</a>
                            @foreach($categories as $cat)
                                <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="btn btn-sm rounded-pill px-3 {{ $currentCategory === $cat->slug ? 'btn-success' : 'btn-outline-success' }}" style="font-size: 0.8rem; font-weight: 500;">{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- 3D Glassmorphic Featured Post Widget -->
            @php
                $featuredPost = \App\Models\BlogPost::where('is_published', true)->with(['author', 'categories'])->latest('published_at')->first();
            @endphp
            @if($featuredPost)
            <div class="col-lg-5 d-none d-lg-block">
                <div class="featured-3d-card p-4 rounded-4 position-relative border" style="background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-color: rgba(0, 100, 0, 0.2) !important; max-width: 400px; margin-left: auto;">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge text-uppercase fw-bold" style="font-size: 0.65rem; letter-spacing: 1px; background-color: var(--waveron-green); color: #fff;">Featured Story</span>
                        <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ rand(5, 12) }} Min Read</span>
                    </div>
                    
                    <h3 class="fw-bold text-dark mb-3" style="font-size: 1.35rem; line-height: 1.4;">{{ Str::limit($featuredPost->title, 60) }}</h3>
                    <p class="text-muted small mb-4" style="line-height: 1.6;">
                        {{ Str::limit($featuredPost->excerpt, 120) }}
                    </p>
                    
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            @php
                                $featuredAvatar = $featuredPost->author && $featuredPost->author->avatar 
                                    ? asset('storage/' . $featuredPost->author->avatar) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($featuredPost->author->name ?? 'Admin') . '&color=ffffff&background=006400';
                            @endphp
                            <img src="{{ $featuredAvatar }}" class="rounded-circle me-2" width="30" height="30" alt="Author">
                            <span class="fw-semibold text-dark small">{{ $featuredPost->author->name ?? 'Waveron Tech' }}</span>
                        </div>
                        <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold" style="font-size: 0.75rem;">
                            Read More <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="container py-5" id="posts-section">

    <!-- Posts Grid -->
    <div class="row g-4 justify-content-center">
        @foreach($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 waveron-blog-card">
                    <div class="position-relative overflow-hidden card-img-container">
                        @if($post->featured_image)
                            <img src="{{ Storage::url($post->featured_image) }}" class="card-img-top" style="height: 240px; object-fit: cover; transition: transform 0.5s ease;" alt="{{ $post->title }}">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 240px;">
                                <i class="bi bi-image text-white fs-1"></i>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            @if($post->categories->isNotEmpty())
                                <span class="badge bg-success bg-opacity-10 text-success text-uppercase fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                                    {{ $post->categories->first()->name }}
                                </span>
                            @endif
                            <span class="text-muted small">•</span>
                            <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ rand(5, 15) }} Min Read</span>
                        </div>
                        
                        <h4 class="card-title fw-bold mb-3" style="font-size: 1.25rem; line-height: 1.4;">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none hover-primary-color">{{ $post->title }}</a>
                        </h4>
                        
                        <p class="text-muted small mb-4 flex-grow-1" style="line-height: 1.6;">
                            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        
                        <hr class="text-muted opacity-25 my-3">
                        
                        <div class="d-flex align-items-center mt-auto">
                            @php
                                $authorAvatar = $post->author && $post->author->avatar 
                                    ? asset('storage/' . $post->author->avatar) 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name ?? 'Admin') . '&color=ffffff&background=006400';
                            @endphp
                            <img src="{{ $authorAvatar }}" class="rounded-circle me-3" width="36" height="36" alt="{{ $post->author->name ?? 'Admin' }}">
                            <div>
                                <p class="mb-0 fw-semibold text-dark" style="font-size: 0.85rem;">{{ $post->author->name ?? 'Admin User' }}</p>
                                <p class="mb-0 text-muted" style="font-size: 0.75rem;">{{ $post->published_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>

@include('partials.footer')

@push('styles')
<style>
    .shape-blob {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 300px;
        height: 300px;
        background: linear-gradient(45deg, #006400, #004d00);
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
        opacity: 0.08;
        animation: blob-animation 8s infinite;
        pointer-events: none;
    }
    .shape-blob2 {
        position: absolute;
        bottom: -50px;
        left: -50px;
        width: 250px;
        height: 250px;
        background: linear-gradient(45deg, #004d00, #003300);
        border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
        opacity: 0.08;
        animation: blob-animation 8s infinite reverse;
        pointer-events: none;
    }
    @keyframes blob-animation {
        0% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
        50% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
        100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
    }
    @keyframes wave-drift {
        0% { stroke-dashoffset: 0; }
        100% { stroke-dashoffset: 24; }
    }
    .animated-wave {
        animation: wave-drift 4s linear infinite;
    }
    .featured-3d-card {
        transform: perspective(1000px) rotateY(-12deg) rotateX(10deg) rotateZ(2deg);
        box-shadow: -20px 20px 40px rgba(0,0,0,0.1), 0 0 40px rgba(0, 100, 0, 0.08);
        transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.5s ease;
    }
    .featured-3d-card:hover {
        transform: perspective(1000px) rotateY(-3deg) rotateX(3deg) rotateZ(0deg);
        box-shadow: -10px 10px 25px rgba(0,0,0,0.08), 0 0 30px rgba(0, 100, 0, 0.15);
    }
    .grid-perspective {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: 
            linear-gradient(rgba(0, 100, 0, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 100, 0, 0.03) 1px, transparent 1px);
        background-size: 45px 45px;
        transform: perspective(600px) rotateX(60deg) rotateZ(-12deg) scale(2) translateY(-100px);
        transform-origin: top left;
        opacity: 0.85;
        pointer-events: none;
    }
    @keyframes float-slow {
        0% { transform: translateY(0px) rotate(45deg); }
        50% { transform: translateY(-10px) rotate(45deg); }
        100% { transform: translateY(0px) rotate(45deg); }
    }
    .concept-diamond-1 {
        animation: float-slow 6s ease-in-out infinite;
    }
    .concept-diamond-2 {
        animation: float-slow 8s ease-in-out infinite;
    }
    .concept-diamond-3 {
        animation: float-slow 5s ease-in-out infinite;
    }
    .waveron-blog-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }
    .waveron-blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08) !important;
    }
    .card-img-container {
        border-top-left-radius: var(--bs-card-inner-border-radius);
        border-top-right-radius: var(--bs-card-inner-border-radius);
    }
    .card-img-container img {
        transition: transform 0.5s ease;
    }
    .waveron-blog-card:hover .card-img-container img {
        transform: scale(1.05);
    }
    .hover-primary-color {
        transition: color 0.2s ease;
    }
    .hover-primary-color:hover {
        color: var(--waveron-green) !important;
    }
    .page-item.active .page-link {
        background-color: var(--waveron-green) !important;
        border-color: var(--waveron-green) !important;
    }
    .page-link {
        color: var(--waveron-green);
    }
    .page-link:hover {
        color: var(--waveron-dark-green);
    }
</style>
@endpush
@endsection
