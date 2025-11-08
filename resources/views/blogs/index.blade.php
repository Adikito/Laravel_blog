@extends('layouts.app')

@section('title', 'All Blogs')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="mb-12">
        <h1 class="text-4xl font-semibold text-white mb-3 tracking-tight">All Blogs</h1>
        <p class="text-gray-400 text-lg">Temukan Berbagai Cerita di Blog Saya</p>
    </div>

    @if($blogs->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <article class="group border border-gray-800 rounded-lg overflow-hidden bg-gray-900/50 hover:border-gray-700 transition-all duration-200">
                    @if($blog->image)
                        <a href="{{ route('blogs.show', $blog) }}" class="block">
                            <img 
                                src="{{ Storage::url($blog->image) }}" 
                                srcset="{{ Storage::url($blog->image) }} 1x"
                                alt="{{ $blog->title }}"
                                class="w-full h-56 object-cover group-hover:opacity-90 transition-opacity"
                                loading="lazy"
                                sizes="(max-width: 768px) 100vw, (max-width: 1024px) 50vw, 33vw"
                            >
                        </a>
                    @else
                        <div class="w-full h-56 bg-gradient-to-br from-gray-800 to-gray-900"></div>
                    @endif
                    
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-white mb-3 line-clamp-2 group-hover:text-gray-300 transition-colors">
                            <a href="{{ route('blogs.show', $blog) }}">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        
                        <p class="text-gray-400 text-sm mb-5 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($blog->content), 120) }}
                        </p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-500 pt-4 border-t border-gray-800">
                            <span class="font-medium">{{ $blog->user->name }}</span>
                            <span>{{ $blog->published_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-12">
            {{ $blogs->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <p class="text-gray-400 mb-6 text-lg">No blogs yet.</p>
            @auth
                <a href="{{ route('blogs.create') }}" class="inline-block text-sm text-white bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-md transition-colors font-semibold tracking-tight">
                    Create Blog
                </a>
            @endauth
        </div>
    @endif
</div>
@endsection
