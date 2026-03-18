<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('category')->latest()->paginate(15);
        return view('admin.recipes.index', compact('recipes'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.recipes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'prep_time' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'cook_time' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'servings' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'difficulty' => ['nullable', 'string', 'max:50'],
            'price_level' => ['nullable', 'string', 'max:10'],

            // video:
            'video_url' => ['nullable', 'string', 'max:2048'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:512000'], // 50MB
        ]);

        $data['slug'] = Str::slug($data['title']);

        // jei slug jau yra – pridedam -2, -3...
        $base = $data['slug'];
        $i = 2;
        while (Recipe::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i++;
        }

        if ($request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')->store('recipe-videos', 'public');
        }

        $recipe = Recipe::create($data);

        return redirect()->route('admin.recipes.edit', $recipe)->with('status', 'Receptas sukurtas');
    }

    public function edit(Recipe $recipe)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.recipes.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
            'prep_time' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'cook_time' => ['nullable', 'integer', 'min:0', 'max:10000'],
            'servings' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'difficulty' => ['nullable', 'string', 'max:50'],
            'price_level' => ['nullable', 'string', 'max:10'],

            'video_url' => ['nullable', 'string', 'max:2048'],
            'video_file' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:512000'],
            'remove_video' => ['nullable', 'boolean'],
        ]);

        // jei title pakeistas – atnaujinam slug (paprastai)
        if ($recipe->title !== $data['title']) {
            $slug = Str::slug($data['title']);
            $base = $slug;
            $i = 2;
            while (Recipe::where('slug', $slug)->where('id', '!=', $recipe->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        if ($request->boolean('remove_video')) {
            if ($recipe->video_path) {
                Storage::disk('public')->delete($recipe->video_path);
            }
            $data['video_path'] = null;
            $data['video_url'] = null;
        }

        if ($request->hasFile('video_file')) {
            if ($recipe->video_path) {
                Storage::disk('public')->delete($recipe->video_path);
            }
            $data['video_path'] = $request->file('video_file')->store('recipe-videos', 'public');
        }

        $recipe->update($data);

        return back()->with('status', 'Išsaugota');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->video_path) {
            Storage::disk('public')->delete($recipe->video_path);
        }
        $recipe->delete();

        return redirect()->route('admin.recipes.index')->with('status', 'Ištrinta');
    }

    public function show(Recipe $recipe)
    {
        return redirect()->route('admin.recipes.edit', $recipe);
    }
}