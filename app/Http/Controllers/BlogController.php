<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->query('category');

        $cacheKey = 'blog_index_page_' . ($request->get('page', 1)) . '_' . ($categorySlug ?? 'all');

        $data = Cache::remember($cacheKey, now()->addHours(1), function () use ($categorySlug) {
            $query = BlogPost::where('is_published', true)
                ->where('published_at', '<=', now())
                ->with(['categories', 'author'])
                ->latest('published_at');

            if ($categorySlug) {
                $query->whereHas('categories', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            }

            return [
                'posts' => $query->paginate(9),
                'categories' => BlogCategory::has('posts')->get(),
            ];
        });

        return view('blog.index', [
            'posts' => $data['posts'],
            'categories' => $data['categories'],
            'currentCategory' => $categorySlug
        ]);
    }

    public function show($slug)
    {
        $cacheKey = 'blog_post_' . $slug;

        $post = Cache::remember($cacheKey, now()->addHours(24), function () use ($slug) {
            return BlogPost::where('slug', $slug)
                ->where('is_published', true)
                ->where('published_at', '<=', now())
                ->with(['categories', 'author'])
                ->firstOrFail();
        });

        // Get related posts by category (excluding current)
        $relatedPosts = Cache::remember('related_posts_' . $post->id, now()->addHours(24), function () use ($post) {
            $categoryIds = $post->categories->pluck('id')->toArray();
            return BlogPost::whereHas('categories', function ($q) use ($categoryIds) {
                    $q->whereIn('blog_categories.id', $categoryIds);
                })
                ->where('id', '!=', $post->id)
                ->where('is_published', true)
                ->with(['categories', 'author'])
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function storeComment(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $post = BlogPost::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $post->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'is_approved' => true, // Approved by default for immediate visibility
        ]);

        // Clear cache for this blog post
        Cache::forget('blog_post_' . $slug);

        return back()->with('comment_success', 'Comment submitted successfully!');
    }
}

