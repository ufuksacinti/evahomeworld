<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->with('user', 'categories')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = BlogCategory::withCount('posts')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->with('user', 'categories')
            ->firstOrFail();

        // Increment view count
        $post->incrementViewCount();

        // Related posts
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->whereHas('categories', function ($query) use ($post) {
                $query->whereIn('blog_categories.id', $post->categories->pluck('id'));
            })
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();

        $posts = $category->publishedPosts()
            ->with('user', 'categories')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('blog.category', compact('category', 'posts'));
    }
}
