<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $latestRecipes = Recipe::query()
            ->with('category')
            ->latest()
            ->take(9)
            ->get();

        $videoRecipes = Recipe::query()
            ->whereNotNull('video_path')
            ->orWhereNotNull('video_url')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('latestRecipes', 'videoRecipes'));
    }
}