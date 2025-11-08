<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $blogs = $user->blogs()
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        $stats = [
            'total_blogs' => $user->blogs()->count(),
            'total_views' => $user->blogs()->sum('views'),
            'recent_blogs' => $user->blogs()->latest()->take(5)->get(),
        ];

        return view('dashboard', compact('user', 'blogs', 'stats'));
    }
}
