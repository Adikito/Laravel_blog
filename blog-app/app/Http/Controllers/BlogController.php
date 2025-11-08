<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of all blogs.
     */
    public function index()
    {
        $blogs = Blog::with('user')
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created blog in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'published_at' => ['required', 'date'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blog-images', 'public');
        }

        $validated['user_id'] = Auth::id();
        $validated['published_at'] = \Carbon\Carbon::parse($validated['published_at']);

        Blog::create($validated);

        return redirect()->route('dashboard')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified blog.
     */
    public function show(Blog $blog)
    {
        $blog->load('user');
        
        // Increment view count (only if not the author)
        if (Auth::id() !== $blog->user_id) {
            $blog->incrementViews();
        }

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified blog.
     */
    public function edit(Blog $blog)
    {
        // Authorization check
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified blog in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        // Authorization check
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'published_at' => ['required', 'date'],
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blog-images', 'public');
        } else {
            // Keep existing image if no new image uploaded
            $validated['image'] = $blog->image;
        }

        $validated['published_at'] = \Carbon\Carbon::parse($validated['published_at']);

        $blog->update($validated);

        return redirect()->route('dashboard')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified blog from storage.
     */
    public function destroy(Blog $blog)
    {
        // Authorization check
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete image if exists
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('dashboard')->with('success', 'Blog deleted successfully!');
    }
}
