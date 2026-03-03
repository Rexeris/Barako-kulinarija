<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();

        $recipes = Recipe::query()
            ->with('category')
            ->when($q, fn($query) =>
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
            )
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('recipes.index', compact('recipes', 'q'));
    }

    public function show(Recipe $recipe)
    {
        $recipe->load('category');
        return view('recipes.show', compact('recipe'));
    }
}