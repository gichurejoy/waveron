@extends('layouts.app')

@section('title', 'Blog | Waveron Technologies')
@section('meta_description', 'Insights, tutorials, and news on software development, digital marketing, and design from the experts at Waveron Technologies.')

@section('meta')
    <meta property="og:title" content="Blog | Waveron Technologies">
    <meta property="og:description" content="Insights, tutorials, and news on software development, digital marketing, and design from the experts at Waveron Technologies.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Blog",
      "url": "{{ url()->current() }}",
      "name": "Waveron Technologies Blog",
      "publisher": {
        "@type": "Organization",
        "name": "Waveron Technologies"
      }
    }
    </script>
@endsection

@section('content')
<div class="container py-5 mt-5">
    <div class="row mb-5 text-center">
        <div class="col-12">
            <h1 class="display-4 fw-bold mb-3">Our <span class="text-success">Blog</span></h1>
            <p class="lead text-muted max-w-2xl mx-auto">Latest insights and trends in software development, design, and digital marketing.</p>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('blog.index') }}" class="btn {{ !$currentCategory ? 'btn-success' : 'btn-outline-secondary' }} rounded-pill px-4">All Posts</a>
                @foreach($categories as $category)
                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}" 
                       class="btn {{ $currentCategory === $category->slug ? 'btn-success' : 'btn-outline-secondary' }} rounded-pill px-4">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Blog Grid -->
    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                    @if($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 240px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 240px;">
                            <i class="bi bi-card-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    <div class="card-body p-4 d-flex flex-column">
                        @if($post->category)
                            <div class="mb-2">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">{{ $post->category->name }}</span>
                            </div>
                        @endif
                        <h4 class="card-title fw-bold mb-3">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none text-dark stretched-link">
                                {{ $post->title }}
                            </a>
                        </h4>
                        <p class="card-text text-muted mb-4 flex-grow-1">
                            {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <small class="text-muted fw-medium">{{ $post->published_at->format('M d, Y') }}</small>
                            <span class="text-success fw-bold small">Read More <i class="bi bi-arrow-right ms-1"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="display-1 text-muted mb-3"><i class="bi bi-journal-x"></i></div>
                <h3 class="fw-bold">No posts found</h3>
                <p class="text-muted">Check back later for new insights!</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>

<style>
.transition-hover {
    transition: all 0.3s ease;
}
.transition-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
</style>
@endsection
