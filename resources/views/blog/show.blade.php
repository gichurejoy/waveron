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
      "image": [
        "{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('images/w.svg') }}"
      ],
      "datePublished": "{{ $post->published_at->toIso8601String() }}",
      "dateModified": "{{ $post->updated_at->toIso8601String() }}",
      "author": {
        "@type": "Person",
        "name": "{{ $post->author->name ?? 'Admin User' }}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "Waveron Technologies",
        "logo": {
          "@type": "ImageObject",
          "url": "https://waverontechnologies.co.ke/images/w.svg"
        }
      },
      "description": "{{ $post->meta_description ?? $post->excerpt }}"
    }
    </script>
@endsection

@section('content')
<article class="container py-5 mt-4">
    <div class="row g-4">
        <!-- Main Content -->
        <div class="col-lg-8 pe-lg-5" style="min-height: 1200px;">
            
            <!-- Back Navigation -->
            <div class="mb-4">
                <a href="{{ route('blog.index') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none fw-semibold" style="color: var(--waveron-green, #00c853); font-size: 0.9rem;">
                    <i class="bi bi-arrow-left"></i> All Posts
                </a>
            </div>

            <!-- Featured Image -->
            @if($post->featured_image)
                <div class="mb-4 rounded overflow-hidden shadow-sm">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="img-fluid w-100" style="max-height: 480px; object-fit: cover;">
                </div>
            @endif

            <!-- Post Header -->
            <header class="mb-4">
                <div class="d-flex align-items-center mb-3 gap-2 text-uppercase fw-semibold" style="font-size: 0.8rem; letter-spacing: 1.5px;">
                    @if($post->categories->isNotEmpty())
                        <a href="{{ route('blog.index', ['category' => $post->categories->first()->slug]) }}" class="text-success text-decoration-none fw-bold">{{ $post->categories->first()->name }}</a>
                        <span class="text-muted">•</span>
                    @endif
                    <span class="text-muted">{{ $post->published_at->format('M d, Y') }}</span>
                </div>
                <h1 class="mb-3 fw-bold text-dark" style="font-size: 2.5rem; line-height: 1.2; letter-spacing: -0.5px;">{{ $post->title }}</h1>
            </header>

            <!-- Post Content -->
            <div class="post-content text-dark" style="font-size: 1.1rem; line-height: 1.8; color: #333;">
                {!! $post->content !!}
            </div>

            <!-- Share Buttons -->
            <div class="mt-5 pt-4 border-top">
                <h5 class="fw-bold mb-3 fs-6" style="letter-spacing: 0.5px;">SHARE THIS ARTICLE:</h5>
                <div class="d-flex gap-2">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-success rounded-circle"><i class="bi bi-twitter-x"></i></a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" target="_blank" class="btn btn-outline-success rounded-circle"><i class="bi bi-linkedin"></i></a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-outline-success rounded-circle"><i class="bi bi-facebook"></i></a>
                </div>
            </div>

            <!-- Comments List -->
            <div class="comments-wrap mt-5 pt-4 border-top">
                <h4 class="fw-bold mb-4 text-dark" style="font-size: 1.5rem;">
                    Comments ({{ $post->comments()->where('is_approved', true)->count() }})
                </h4>
                @php
                    $approvedComments = $post->comments()->where('is_approved', true)->latest()->get();
                @endphp
                @if($approvedComments->isEmpty())
                    <p class="text-muted">No comments yet. Be the first to share your thoughts!</p>
                @else
                    <div class="d-flex flex-column gap-3 mb-4">
                        @foreach($approvedComments as $comment)
                            <div class="p-3 rounded border" style="background-color: #f8f9fa;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px; font-size: 0.9rem; background-color: var(--waveron-green) !important;">
                                            {{ strtoupper(substr($comment->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark" style="font-size: 0.95rem;">{{ $comment->name }}</h6>
                                            <span class="text-muted small" style="font-size: 0.75rem;">{{ $comment->created_at->format('M d, Y \a\t g:i a') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-dark mb-0" style="font-size: 0.9rem; line-height: 1.5; white-space: pre-line;">{{ $comment->comment }}</p>

                                @if($comment->reply)
                                <div class="mt-3 p-3 rounded" style="background-color: #f0f9f4; border-left: 4px solid var(--waveron-green, #00c853); margin-left: 1rem;">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.75rem; background-color: #111; flex-shrink: 0;">W</div>
                                        <div>
                                            <h6 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2" style="font-size: 0.85rem;">
                                                Waveron Technologies
                                                <span class="badge text-white" style="font-size: 0.6rem; background-color: var(--waveron-green, #00c853);">Admin</span>
                                            </h6>
                                            <span class="text-muted" style="font-size: 0.72rem;">Reply from Waveron</span>
                                        </div>
                                    </div>
                                    <p class="text-dark mb-0" style="font-size: 0.85rem; line-height: 1.6; white-space: pre-line;">{{ $comment->reply }}</p>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Leave a Reply -->
            <div class="comment-form-wrap mt-4 pt-4 border-top">
                <h4 class="fw-bold mb-4 text-dark" style="font-size: 1.5rem;">Leave a Reply</h4>
                
                @if (session('comment_success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        {{ session('comment_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any() && old('comment'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('blog.comments.store', $post->slug) }}" method="POST" class="comment-form">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" id="name" name="name" class="form-control py-3 px-4" placeholder="Name*" required value="{{ old('name') }}" style="border-radius: 6px; border: 1px solid #dee2e6; font-size: 0.95rem;">
                        </div>
                        <div class="col-md-6">
                            <input type="email" id="email" name="email" class="form-control py-3 px-4" placeholder="Email*" required value="{{ old('email') }}" style="border-radius: 6px; border: 1px solid #dee2e6; font-size: 0.95rem;">
                        </div>
                        <div class="col-12">
                            <textarea id="comment" name="comment" rows="5" class="form-control py-3 px-4" placeholder="Your Comment*" required style="border-radius: 6px; border: 1px solid #dee2e6; font-size: 0.95rem;">{{ old('comment') }}</textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn fw-bold px-4 py-3 text-white btn-submit-comment" style="background-color: var(--waveron-green); border-color: var(--waveron-green); border-radius: 6px; font-size: 0.95rem;">
                                Submit Comment
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <!-- Right Sidebar -->
        <div class="col-lg-4 mt-5 mt-lg-0 position-sticky" style="top: 100px; align-self: flex-start; z-index: 10;">
                <!-- Author Widget -->
                <div class="text-center p-5 mb-5 rounded shadow-sm border" style="background-color: #f8f9fa;">
                    @php
                        $authorAvatar = $post->author && $post->author->avatar 
                            ? asset('storage/' . $post->author->avatar) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name ?? 'Admin User') . '&color=ffffff&background=006400';
                        $authorName = $post->author->name ?? 'Admin User';
                    @endphp
                    <img src="{{ $authorAvatar }}" alt="{{ $authorName }}" class="rounded-circle mb-4 shadow-sm" style="width: 120px; height: 120px; border: 4px solid #fff; object-fit: cover;">
                    <h4 class="fw-bold mb-1">{{ $authorName }}</h4>
                    <p class="text-success mb-3 fw-bold" style="font-size: 0.75rem; letter-spacing: 2px;">AUTHOR</p>
                    <p class="text-muted small mb-0 px-2" style="line-height: 1.8;">
                        Expert contributor and writer at Waveron Technologies. Delivering high-quality insights and technical analysis.
                    </p>
                </div>

                <!-- Categories Widget with background images -->
                @php
                    $allCategories = \App\Models\BlogCategory::has('posts')->withCount('posts')->get();
                @endphp
                <div class="mb-5">
                    <h4 class="fw-bold mb-4 text-dark">Categories</h4>
                    <div class="d-flex flex-column gap-3">
                        @foreach($allCategories as $cat)
                            @php
                                $categoryImages = [
                                    'technology' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=400&q=80',
                                    'design' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=400&q=80',
                                    'marketing' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=400&q=80',
                                    'development' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=400&q=80',
                                    'business' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=400&q=80',
                                ];
                                $slug = strtolower($cat->slug);
                                $bgImg = $categoryImages[$slug] ?? 'https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?auto=format&fit=crop&w=400&q=80';
                            @endphp
                            <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="text-decoration-none position-relative overflow-hidden rounded d-block waveron-category-item" style="height: 70px;">
                                <img src="{{ $bgImg }}" alt="{{ $cat->name }}" class="position-absolute start-0 top-0 w-100 h-100 object-fit-cover z-0 category-bg-img" style="transition: transform 0.5s ease; opacity: 0.65;">
                                <div class="position-absolute start-0 top-0 w-100 h-100 bg-dark opacity-50 z-0"></div>
                                
                                <div class="w-100 h-100 d-flex justify-content-between align-items-center px-4 text-white position-relative z-1">
                                    <span class="fw-bold fs-6">{{ $cat->name }}</span>
                                    <span class="badge bg-white text-dark rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 0.75rem;">
                                        {{ sprintf('%02d', $cat->posts_count) }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Top Stories Widget (Renamed from Recent Posts) -->
                @php
                    $recentPosts = \App\Models\BlogPost::where('is_published', true)
                        ->where('id', '!=', $post->id)
                        ->with(['categories'])
                        ->latest('published_at')
                        ->take(3)
                        ->get();
                @endphp
                @if($recentPosts->isNotEmpty())
                <div class="mb-5">
                    <h4 class="fw-bold mb-4 text-dark">Top Stories</h4>
                    <div class="d-flex flex-column gap-3">
                        @foreach($recentPosts as $recent)
                            <div class="d-flex gap-3 align-items-center">
                                <a href="{{ route('blog.show', $recent->slug) }}" style="width: 60px; height: 60px; flex-shrink: 0;">
                                    @if($recent->featured_image)
                                        <img src="{{ asset('storage/' . $recent->featured_image) }}" class="rounded-3" style="height: 60px; width: 60px; object-fit: cover;" alt="{{ $recent->title }}">
                                    @else
                                        <div class="bg-secondary rounded-3 d-flex align-items-center justify-content-center text-white" style="height: 60px; width: 60px;">
                                            <i class="bi bi-image" style="font-size: 1.2rem;"></i>
                                        </div>
                                    @endif
                                </a>
                                <div>
                                    <div class="text-uppercase fw-semibold mb-1 text-muted" style="font-size: 0.7rem; letter-spacing: 1px;">
                                        @if($recent->categories->isNotEmpty())
                                            <span class="text-success">{{ $recent->categories->first()->name }}</span>
                                            <span class="mx-1">•</span>
                                        @endif
                                        <span>{{ $recent->published_at->format('M d, Y') }}</span>
                                    </div>
                                    <h6 class="fw-bold mb-0" style="font-size: 0.9rem; line-height: 1.3;">
                                        <a href="{{ route('blog.show', $recent->slug) }}" class="text-dark text-decoration-none hover-green">{{ $recent->title }}</a>
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Subscribe Widget -->
                <div class="p-4 mb-5 rounded shadow-sm border text-center position-relative overflow-hidden" style="background-color: #fdfbf7;">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3 shadow-sm" style="width: 54px; height: 54px; background-color: #f9e498; color: #000;">
                        <i class="bi bi-envelope fs-4"></i>
                    </div>
                    <h4 class="fw-bold mb-2 text-dark" style="font-size: 1.25rem;">Subscribe to Waveron Blog</h4>
                    <p class="text-muted small mb-4">Get the latest articles, insights, and tech trends delivered directly to your inbox.</p>
                    
                    @if (session('newsletter_success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="font-size: 0.85rem;">
                            {{ session('newsletter_success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.5rem 0.5rem;"></button>
                        </div>
                    @endif

                    @if (session('newsletter_error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="font-size: 0.85rem;">
                            {{ session('newsletter_error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 0.5rem 0.5rem;"></button>
                        </div>
                    @endif

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="d-flex flex-column gap-2">
                        @csrf
                        <input type="email" name="email" placeholder="Your Email" required class="form-control text-center py-2" style="border-radius: 6px; border: 1px solid #dee2e6; font-size: 0.9rem;">
                        <button type="submit" class="btn fw-bold py-2 mt-1 btn-subscribe-widget" style="background-color: #f9e498; color: #000; border: none; border-radius: 6px; transition: background-color 0.2s;">
                            Subscribe
                        </button>
                    </form>
                </div>

                <!-- Promo Banner Widget -->
                <div class="mb-5 rounded overflow-hidden shadow-sm position-relative d-flex align-items-center" style="height: 350px; background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=400&q=80'); background-size: cover; background-position: center;">
                    <div class="position-absolute start-0 top-0 w-100 h-100 bg-dark opacity-75 z-0"></div>
                    <div class="position-relative z-1 p-4 text-center w-100 text-white d-flex flex-column h-100 justify-content-center align-items-center">
                        <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-50 px-3 py-1 rounded-pill mb-3 text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px; color: #4ade80 !important; border-color: #4ade80 !important;">GROW WITH WAVERON</span>
                        <h3 class="fw-bold mb-2 text-white" style="font-size: 1.5rem; line-height: 1.3;">Transform Your Business</h3>
                        <p class="small mb-4 opacity-75">Custom software development & AI solutions tailored for your growth.</p>
                        <a href="/contact" class="btn btn-success fw-bold px-4 py-2" style="background-color: var(--waveron-green); border-color: var(--waveron-green); border-radius: 6px; font-size: 0.9rem;">Book a Consultation</a>
                    </div>
                </div>

                <!-- Social Media Widget -->
                <div class="mb-5">
                    <h4 class="fw-bold mb-4 text-dark">Follow Us</h4>
                    <div class="d-flex flex-column gap-2">
                        <a href="https://www.facebook.com/61563241431145" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-between text-decoration-none px-4 py-3 rounded text-white" style="background-color: #3b5998; font-size: 0.85rem; font-weight: 500;">
                            <span><i class="bi bi-facebook me-2"></i> Facebook</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/waveron-technologies" target="_blank" rel="noopener" class="d-flex align-items-center justify-content-between text-decoration-none px-4 py-3 rounded text-white" style="background-color: #0077b5; font-size: 0.85rem; font-weight: 500;">
                            <span><i class="bi bi-linkedin me-2"></i> LinkedIn</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <a href="#" class="d-flex align-items-center justify-content-between text-decoration-none px-4 py-3 rounded text-white" style="background-color: #ac2bac; font-size: 0.85rem; font-weight: 500;">
                            <span><i class="bi bi-instagram me-2"></i> Instagram</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                        <a href="#" class="d-flex align-items-center justify-content-between text-decoration-none px-4 py-3 rounded text-white" style="background-color: #ff0000; font-size: 0.85rem; font-weight: 500;">
                            <span><i class="bi bi-youtube me-2"></i> Youtube</span>
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="py-5 border-top bg-light">
    <div class="container">
        <h3 class="fw-bold mb-5 text-center">Related Articles</h3>
        <div class="row g-4 justify-content-center">
            @foreach($relatedPosts as $related)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 waveron-blog-card">
                        <div class="position-relative overflow-hidden card-img-container">
                            @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" class="card-img-top" style="height: 200px; object-fit: cover; transition: transform 0.5s ease;" alt="{{ $related->title }}">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="bi bi-image text-white fs-1"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                @if($related->categories->isNotEmpty())
                                    <span class="badge bg-success bg-opacity-10 text-success text-uppercase fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">
                                        {{ $related->categories->first()->name }}
                                    </span>
                                @endif
                                <span class="text-muted small">•</span>
                                <span class="text-muted small"><i class="bi bi-clock me-1"></i> {{ rand(5, 15) }} Min Read</span>
                            </div>
                            
                            <h5 class="card-title fw-bold mb-3" style="font-size: 1.1rem; line-height: 1.4;">
                                <a href="{{ route('blog.show', $related->slug) }}" class="text-dark text-decoration-none hover-primary-color">{{ $related->title }}</a>
                            </h5>
                            
                            <hr class="text-muted opacity-25 my-3 mt-auto">
                            
                            <div class="d-flex align-items-center mt-auto">
                                @php
                                    $relatedAuthorAvatar = $related->author && $related->author->avatar 
                                        ? asset('storage/' . $related->author->avatar) 
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($related->author->name ?? 'Admin') . '&color=ffffff&background=006400';
                                @endphp
                                <img src="{{ $relatedAuthorAvatar }}" class="rounded-circle me-2" width="28" height="28" alt="{{ $related->author->name ?? 'Admin' }}">
                                <div>
                                    <p class="mb-0 fw-semibold text-dark" style="font-size: 0.75rem;">{{ $related->author->name ?? 'Admin User' }}</p>
                                    <p class="mb-0 text-muted" style="font-size: 0.7rem;">{{ $related->published_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif



<style>
/* Rich Text Formatting Styles */
.post-content table {
    width: 100%;
    margin-bottom: 1.5rem;
    border-collapse: collapse;
    background-color: #fff;
}
.post-content table th,
.post-content table td {
    padding: 0.75rem;
    vertical-align: top;
    border: 1px solid #dee2e6;
}
.post-content table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
    background-color: #f8f9fa;
    font-weight: 600;
}
.post-content blockquote {
    padding: 1.5rem 2rem;
    margin: 2rem 0;
    font-size: 1.2rem;
    border: 1px solid #111;
    border-left: 4px solid var(--waveron-green, #00c853);
    background-color: #eefbf3;
    color: #1a5c8c;
    font-style: italic;
}
.post-content blockquote p {
    margin-bottom: 0.5rem;
    color: inherit;
}
.post-content blockquote cite {
    display: block;
    font-size: 0.95rem;
    color: #666;
    font-style: normal;
    margin-top: 0.5rem;
}
.post-content ul, .post-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}
.post-content li {
    margin-bottom: 0.5rem;
}
.post-content img {
    border-radius: 8px;
    margin: 2rem 0;
    max-width: 100%;
    height: auto;
}

.waveron-category-item {
    transition: transform 0.3s ease;
}

.waveron-category-item:hover {
    transform: translateY(-2px);
}

.waveron-category-item:hover .category-bg-img {
    transform: scale(1.1) !important;
}

.hover-green {
    transition: color 0.2s ease;
}

.hover-green:hover {
    color: var(--waveron-green) !important;
}

.btn-submit-comment:hover {
    background-color: var(--waveron-dark-green) !important;
    border-color: var(--waveron-dark-green) !important;
}

.btn-subscribe-widget:hover {
    background-color: #f5d475 !important;
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
</style>
@endsection
