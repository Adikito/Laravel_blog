@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<div class="max-w-4xl mx-auto px-6">
    <article class="border border-gray-800 rounded-lg overflow-hidden bg-gray-900/50">
        @if($blog->image)
            <img 
                src="{{ Storage::url($blog->image) }}" 
                srcset="{{ Storage::url($blog->image) }} 1x"
                alt="{{ $blog->title }}"
                class="w-full h-80 object-cover"
                loading="lazy"
                sizes="100vw"
            >
        @endif
        
        <div class="p-10">
            <h1 class="text-4xl font-semibold text-white mb-6 tracking-tight leading-tight">
                {{ $blog->title }}
            </h1>
            
            <div class="flex items-center space-x-6 text-sm text-gray-400 mb-10 pb-6 border-b border-gray-800">
                <span class="font-medium text-gray-300">{{ $blog->user->name }}</span>
                <span>{{ $blog->published_at->format('M d, Y') }}</span>
                <span>{{ $blog->views }} views</span>
            </div>
            
            <div class="prose prose-invert max-w-none">
                <div class="text-gray-300 whitespace-pre-wrap leading-relaxed text-base">
                    {{ $blog->content }}
                </div>
            </div>
        </div>
    </article>

    <div class="mt-10 flex justify-between items-center">
        <a 
            href="{{ route('blogs.index') }}" 
            class="text-sm text-gray-400 hover:text-white transition-colors"
        >
            ← Back to Blogs
        </a>

        @auth
            @if($blog->user_id === Auth::id())
                <div class="flex items-center space-x-4">
                    <a 
                        href="{{ route('blogs.edit', $blog) }}" 
                        class="text-sm text-white bg-gray-800 hover:bg-gray-700 px-5 py-2.5 rounded-md transition-colors font-semibold tracking-tight"
                    >
                        Edit
                    </a>
                    <form method="POST" action="{{ route('blogs.destroy', $blog) }}" onsubmit="return confirm('Are you sure?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="text-sm text-gray-400 hover:text-white transition-colors"
                        style ="background:transparent; padding: 5px; border-radius: 5px;">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection
