@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title . ' | Waveron Technologies')
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('meta')
    <!-- Open Graph Data -->
    <meta property="og:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta property="og:description" content="{{ $post->meta_description ?? $post->excerpt }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if($post->featured_image)
    <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @endif
    
    <!-- Twitter Card Data -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->meta_title ?? $post->title }}">
    <meta name="twitter:description" content="{{ $post->meta_description ?? $post->excerpt }}">
    @if($post->featured_image)
    <meta name="twitter:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @endif

    <!-- Schema.org JSON-LD for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ url()->current() }}"
      },
      "headline": "{{ $post->title }}",
      "description": "{{ $post->meta_description ?? $post->excerpt }}",
      @if($post->featured_image)
      "image": "{{ asset('storage/' . $post->featured_image) }}",
      @endif
      "author": {
        "@type": "Organization",
        "name": "Waveron Technologies"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Waveron Technologies",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('img/logo.png') }}"
        }
      },
      "datePublished": "{{ $post->published_at->toIso8601String() }}",
      "dateModified": "{{ $post->updated_at->toIso8601String() }}"
    }
    </script>
@endsection

@section('content')
<article class="container py-5 mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-success text-decoration-none">Blog</a></li>
                    @if($post->category)
                    <li class="breadcrumb-item"><a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" class="text-success text-decoration-none">{{ $post->category->name }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">Post</li>
                </ol>
            </nav>

            <!-- Post Header -->
            <header class="mb-5">
                <h1 class="display-4 fw-bold mb-3">{{ $post->title }}</h1>
                <div class="d-flex align-items-center text-muted mb-4">
                    <div class="me-4">
                        <i class="bi bi-calendar-event me-2"></i>{{ $post->published_at->format('F j, Y') }}
                    </div>
                    @if($post->category)
                    <div>
                        <i class="bi bi-tag me-2"></i>{{ $post->category->name }}
                    </div>
                    @endif
                </div>
            </header>

            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-5 rounded-4 overflow-hidden shadow-sm">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid w-100" style="max-height: 500px; object-fit: cover;">
                </div>
            @endif

            <!-- Post Content -->
            <div class="post-content fs-5" style="line-height: 1.8;">
                {!! $post->content !!}
            </div>

            <!-- Share Buttons -->
            <div class="mt-5 pt-4 border-top">
                <h5 class="fw-bold mb-3">Share this article:</h5>
                <div class="d-flex gap-2">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-secondary rounded-circle">
                        <i class="bi bi-twitter-x"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-secondary rounded-circle">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-outline-secondary rounded-circle">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="bg-light py-5">
    <div class="container">
        <h3 class="fw-bold mb-4">Related Articles</h3>
        <div class="row g-4">
            @foreach($relatedPosts as $related)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden transition-hover">
                        @if($related->featured_image)
                            <img src="{{ Storage::url($related->featured_image) }}" class="card-img-top" alt="{{ $related->title }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="bi bi-journal-text text-muted" style="font-size: 2rem;"></i>
                            </div>
                        @endif
                        <div class="card-body p-4 d-flex flex-column">
                            <h5 class="card-title fw-bold mb-3">
                                <a href="{{ route('blog.show', $related->slug) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ $related->title }}
                                </a>
                            </h5>
                            <p class="text-muted small mt-auto mb-0">{{ $related->published_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.post-content h2, .post-content h3, .post-content h4 {
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.post-content p {
    margin-bottom: 1.5rem;
}
.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 2rem 0;
}
.transition-hover {
    transition: all 0.3s ease;
}
.transition-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
</style>
@endsection
