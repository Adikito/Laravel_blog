<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Blog') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
</head>
<body class="font-sans antialiased bg-gray-950 text-gray-100">
    <nav class="border-b border-gray-800 bg-gray-900/50 backdrop-blur-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-lg font-semibold text-white tracking-tight">
                        Bayu Blog
                    </a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('blogs.index') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                        All Blogs
                    </a>
                    
                    @auth
                        <a href="{{ route('blogs.create') }}" class="text-sm text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md transition-colors font-semibold tracking-tight">
                            Create
                        </a>
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" style="background:transparent; padding: 5px; border-radius: 5px;" class="text-sm text-gray-400 hover:text-white transition-colors">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="text-sm text-white bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md transition-colors font-semibold tracking-tight">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-gray-900 border border-gray-800 text-gray-100 px-4 py-3 rounded-md text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div class="bg-gray-900 border border-gray-800 text-gray-100 px-4 py-3 rounded-md text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <main class="py-12 min-h-screen">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800 bg-gray-900/50 mt-20">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <p class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Blog. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
