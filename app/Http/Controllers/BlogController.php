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
                ->with('category')
                ->latest('published_at');

            if ($categorySlug) {
                $query->whereHas('category', function ($q) use ($categorySlug) {
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
                ->with('category')
                ->firstOrFail();
        });

        // Get related posts by category (excluding current)
        $relatedPosts = Cache::remember('related_posts_' . $post->id, now()->addHours(24), function () use ($post) {
            return BlogPost::where('blog_category_id', $post->blog_category_id)
                ->where('id', '!=', $post->id)
                ->where('is_published', true)
                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view('blog.show', compact('post', 'relatedPosts'));
    }
}
