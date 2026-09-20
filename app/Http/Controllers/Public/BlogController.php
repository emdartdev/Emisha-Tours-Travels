<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Services\SeoService;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(
        protected SeoService $seoService
    ) {}

    public function index(\Illuminate\Http\Request $request): View
    {
        $categorySlug = $request->query('category');
        $search = $request->query('search');

        $query = BlogPost::published()
            ->with(['category', 'author'])
            ->latest('published_at');

        if ($categorySlug) {
            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9)->withQueryString();
        $categories = BlogCategory::where('status', 'active')->get();

        return view('public.blog.index', compact('posts', 'categories'));
    }

    public function show(string $slug): View
    {
        $post = BlogPost::published()
            ->where('slug', $slug)
            ->with(['category', 'author', 'destination'])
            ->firstOrFail();

        $recentPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        $schema = $this->seoService->generateArticleSchema($post);

        return view('public.blog.show', compact('post', 'recentPosts', 'schema'));
    }
}
