<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BlogAdminController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::with(['category', 'author'])
            ->latest('published_at')
            ->paginate(15);

        return view('admin.blog.index', compact('posts'));
    }

    public function create(): View
    {
        $categories = BlogCategory::where('status', 'active')->get();

        return view('admin.blog.form', [
            'post' => new BlogPost(),
            'categories' => $categories,
            'isEdit' => false
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_bn' => ['nullable', 'string', 'max:255'],
            'blog_category_id' => ['required', 'exists:blog_categories,id'],
            'featured_image' => ['nullable', 'string', 'max:500'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'excerpt_bn' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'content_bn' => ['nullable', 'string'],
            'reading_time' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:published,draft,archived'],
        ]);

        $data['slug'] = Str::slug($data['title']) . '-' . rand(100, 999);
        $data['author_id'] = Auth::id() ?? 1;
        $data['published_at'] = $data['status'] === 'published' ? now() : null;

        $post = BlogPost::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', "Article '{$post->title}' published successfully.");
    }

    public function edit(int $id): View
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::where('status', 'active')->get();

        return view('admin.blog.form', [
            'post' => $post,
            'categories' => $categories,
            'isEdit' => true
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $post = BlogPost::findOrFail($id);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_bn' => ['nullable', 'string', 'max:255'],
            'blog_category_id' => ['required', 'exists:blog_categories,id'],
            'featured_image' => ['nullable', 'string', 'max:500'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'excerpt_bn' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'content_bn' => ['nullable', 'string'],
            'reading_time' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:published,draft,archived'],
        ]);

        if ($data['status'] === 'published' && !$post->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', "Article '{$post->title}' updated successfully.");
    }

    public function destroy(int $id): RedirectResponse
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', "Article '{$post->title}' removed successfully.");
    }
}
