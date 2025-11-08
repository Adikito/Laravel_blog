@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6">
    <div class="mb-12">
        <h1 class="text-4xl font-semibold text-white mb-3 tracking-tight">Dashboard</h1>
        <p class="text-gray-400 text-lg">Welcome back, <span class="text-white font-medium">{{ $user->name }}</span></p>
    </div>

    <!-- Profile Section -->
    <div class="border border-gray-800 rounded-lg bg-gray-900/50 overflow-hidden mb-12">
        <div class="px-6 py-5 border-b border-gray-800">
            <h2 class="text-xl font-semibold text-white tracking-tight">Profile Settings</h2>
        </div>
        <div class="p-6">
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-3">
                            Name
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $user->name) }}"
                            required 
                            class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                            placeholder="Your name"
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-3">
                            Email
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $user->email) }}"
                            required
                            class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                            placeholder="your@email.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-800">
                    <button 
                        type="submit" 
                        class="text-sm text-white bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-md transition-colors font-semibold tracking-tight"
                    >
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="border border-gray-800 rounded-lg p-6 bg-gray-900/50">
            <p class="text-sm text-gray-400 mb-2 font-medium">Total Blogs</p>
            <p class="text-3xl font-semibold text-white tracking-tight">{{ $stats['total_blogs'] }}</p>
        </div>

        <div class="border border-gray-800 rounded-lg p-6 bg-gray-900/50">
            <p class="text-sm text-gray-400 mb-2 font-medium">Total Views</p>
            <p class="text-3xl font-semibold text-white tracking-tight">{{ number_format($stats['total_views']) }}</p>
        </div>

        <div class="border border-gray-800 rounded-lg p-6 bg-gray-900/50">
            <p class="text-sm text-gray-400 mb-2 font-medium">Email</p>
            <p class="text-sm font-medium text-white truncate">{{ $user->email }}</p>
        </div>
    </div>

    <!-- Create Blog Button -->
    <div class="mb-8">
        <a 
            href="{{ route('blogs.create') }}" 
            class="inline-block text-sm text-white bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-md transition-colors font-semibold tracking-tight"
        >
            Create New Blog
        </a>
    </div>

    <!-- My Blogs -->
    <div class="border border-gray-800 rounded-lg bg-gray-900/50 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-800">
            <h2 class="text-xl font-semibold text-white">My Blogs</h2>
        </div>

        @if($blogs->count() > 0)
            <div class="divide-y divide-gray-800">
                @foreach($blogs as $blog)
                    <div class="p-6 hover:bg-gray-900/50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-white mb-2">
                                    <a href="{{ route('blogs.show', $blog) }}" class="hover:text-gray-300 transition-colors">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-400 text-sm mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($blog->content), 150) }}
                                </p>
                                <div class="flex items-center space-x-5 text-xs text-gray-500">
                                    <span>{{ $blog->published_at->format('M d, Y') }}</span>
                                    <span>{{ $blog->views }} views</span>
                                </div>
                            </div>
                            <div class="ml-6 flex items-center space-x-3">
                                <a 
                                    href="{{ route('blogs.edit', $blog) }}" 
                                    class="text-gray-400 hover:text-white p-2 transition-colors"
                                    title="Edit"
                                >
                                    <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 15 15">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('blogs.destroy', $blog) }}" onsubmit="return confirm('Are you sure?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="text-gray-400 hover:text-white p-2 transition-colors"
                                        title="Delete"
                                    style ="background:transparent; padding: 5px; border-radius: 5px;">
                                        <svg class="w-2 h-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="px-6 py-4 border-t border-gray-800">
                {{ $blogs->links() }}
            </div>
        @else
            <div class="p-16 text-center">
                <p class="text-gray-400 mb-6 text-lg">No blogs yet.</p>
                <a href="{{ route('blogs.create') }}" class="inline-block text-sm text-white bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-md transition-colors font-semibold tracking-tight">
                    Create Your First Blog
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
