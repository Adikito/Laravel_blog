@extends('layouts.app')

@section('title', 'Edit Blog')

@section('content')
<div class="max-w-3xl mx-auto px-6">
    <div class="mb-10">
        <h1 class="text-4xl font-semibold text-white mb-3 tracking-tight">Edit Blog</h1>
        <p class="text-gray-400">Update your blog post</p>
    </div>

    <div class="border border-gray-800 rounded-lg p-8 bg-gray-900/50">
        <form method="POST" action="{{ route('blogs.update', $blog) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-3">
                    Title
                </label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    value="{{ old('title', $blog->title) }}"
                    required 
                    autofocus
                    class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    placeholder="Enter blog title"
                >
                @error('title')
                    <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-300 mb-3">
                    Content
                </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="14"
                    required
                    class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all resize-none"
                    placeholder="Write your blog content here..."
                >{{ old('content', $blog->content) }}</textarea>
                @error('content')
                    <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-300 mb-3">
                        Featured Image
                    </label>
                    @if($blog->image)
                        <div class="mb-4">
                            <img 
                                src="{{ Storage::url($blog->image) }}" 
                                srcset="{{ Storage::url($blog->image) }} 1x"
                                alt="Current image"
                                class="w-full h-48 object-cover rounded-md border border-gray-800 mb-2"
                                loading="lazy"
                                sizes="(max-width: 768px) 100vw, 50vw"
                            >
                            <p class="text-xs text-gray-500">Current image</p>
                        </div>
                    @endif
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        accept="image/*"
                        class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-gray-800 file:text-white hover:file:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    >
                    <p class="mt-2 text-xs text-gray-500">Max 2MB. Leave empty to keep current image.</p>
                    @error('image')
                        <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-300 mb-3">
                        Published Date & Time
                    </label>
                    <input 
                        type="datetime-local" 
                        name="published_at" 
                        id="published_at" 
                        value="{{ old('published_at', $blog->published_at->format('Y-m-d\TH:i')) }}"
                        required
                        class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    >
                    @error('published_at')
                        <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-800">
                <a 
                    href="{{ route('dashboard') }}" 
                    class="px-6 py-3 text-sm text-gray-400 hover:text-white transition-colors"
                >
                    Cancel
                </a>
                <button 
                    type="submit" 
                    class="px-6 py-3 text-sm text-white bg-gray-800 hover:bg-gray-700 rounded-md transition-colors font-semibold tracking-tight"
                >
                    Update Blog
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
