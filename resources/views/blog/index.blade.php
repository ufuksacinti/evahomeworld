@extends('layouts.main')

@section('title', 'Blog - EvaHome')

@section('content')
<div class="bg-gradient-to-b from-amber-50 to-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="font-serif text-4xl font-bold text-amber-900 mb-4">Blog</h1>
            <p class="text-amber-800/70 text-lg">Ev dekorasyonu ve mobilya hakkında ilham veren yazılar</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Blog Posts -->
            <div class="lg:col-span-2">
                <div class="space-y-8">
                    @forelse($posts as $post)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden border border-amber-100 hover:shadow-xl transition-all duration-300">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-64 object-cover"
                                     onerror="this.src='https://via.placeholder.com/800x256/F4E4C1/2C2416?text=Blog+Görseli'">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center gap-4 text-sm text-amber-600/70 mb-3">
                                    <span>{{ $post->published_at->format('d.m.Y') }}</span>
                                    <span>•</span>
                                    <span>{{ $post->user->name }}</span>
                                    <span>•</span>
                                    <span>{{ $post->view_count }} görüntülenme</span>
                                </div>

                                <h2 class="font-serif text-2xl font-bold text-amber-900 mb-3 hover:text-amber-700 transition-colors">
                                    <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                </h2>

                                <p class="text-amber-800/70 mb-4 line-clamp-3">{{ $post->getExcerpt() }}</p>

                                <div class="flex items-center justify-between">
                                    <div class="flex gap-2">
                                        @foreach($post->categories as $category)
                                            <span class="bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-sm">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <a href="{{ route('blog.show', $post->slug) }}" 
                                       class="text-amber-600 hover:text-amber-700 font-medium flex items-center gap-2">
                                        Devamını Oku
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 mx-auto text-amber-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                            <p class="text-amber-700 text-lg font-medium">Henüz blog yazısı yok</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="mt-8">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="space-y-6">
                <!-- Categories -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-amber-100">
                    <h3 class="font-serif text-xl font-bold text-amber-900 mb-4">Kategoriler</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.category', $category->slug) }}" 
                                   class="flex items-center justify-between text-amber-700 hover:text-amber-900 hover:bg-amber-50 px-3 py-2 rounded transition-colors">
                                    <span>{{ $category->name }}</span>
                                    <span class="bg-amber-100 text-amber-700 px-2 py-1 rounded-full text-xs">
                                        {{ $category->posts_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection






