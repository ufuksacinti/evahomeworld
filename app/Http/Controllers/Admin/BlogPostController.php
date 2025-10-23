<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('user', 'categories')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog-posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'is_published' => 'boolean',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'is_published' => $request->has('is_published'),
        ];

        if ($request->has('is_published') && $request->is_published) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $post = BlogPost::create($data);

        if ($request->has('categories')) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog yazısı başarıyla oluşturuldu.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::all();
        $blogPost->load('categories');
        return view('admin.blog-posts.edit', compact('blogPost', 'categories'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'is_published' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'excerpt' => $request->excerpt,
            'is_published' => $request->has('is_published'),
        ];

        if ($request->has('is_published') && $request->is_published && !$blogPost->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($blogPost->featured_image) {
                Storage::disk('public')->delete($blogPost->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blogPost->update($data);

        if ($request->has('categories')) {
            $blogPost->categories()->sync($request->categories);
        }

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog yazısı güncellendi.');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->featured_image) {
            Storage::disk('public')->delete($blogPost->featured_image);
        }

        $blogPost->delete();

        return redirect()->route('admin.blog-posts.index')
            ->with('success', 'Blog yazısı silindi.');
    }

    public function publish(BlogPost $blogPost)
    {
        $blogPost->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Blog yazısı yayınlandı.');
    }
}
