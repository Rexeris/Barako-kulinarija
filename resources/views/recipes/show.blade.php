<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-400">{{ $recipe->category?->name }}</div>
                <h2 class="font-semibold text-xl text-gray-100 leading-tight">{{ $recipe->title }}</h2>
            </div>
            <a href="{{ route('recipes.index') }}" class="underline text-gray-300 hover:text-white">← Atgal</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 space-y-6">

            @php
                $src = $recipe->video_path
                    ? asset('storage/' . $recipe->video_path)
                    : ($recipe->video_url ?: null);
            @endphp

            @if($src)
                <div class="bg-gray-900 border border-gray-800 p-4 rounded shadow">
                    <video class="w-full rounded" controls playsinline preload="metadata">
                        <source src="{{ $src }}">
                        Jūsų naršyklė nepalaiko video.
                    </video>
                </div>
            @endif

            <div class="bg-gray-900 border border-gray-800 p-6 rounded shadow">
                <p class="text-gray-200">{{ $recipe->description }}</p>

                <div class="flex flex-wrap gap-4 mt-4 text-sm text-gray-300">
                    @if($recipe->prep_time) <span>⏱ Paruošimas: {{ $recipe->prep_time }} min</span> @endif
                    @if($recipe->cook_time) <span>🍳 Gaminimas: {{ $recipe->cook_time }} min</span> @endif
                    @if($recipe->servings) <span>🍽 Porcijos: {{ $recipe->servings }}</span> @endif
                    @if($recipe->difficulty) <span>🔥 Sudėtingumas: {{ $recipe->difficulty }}</span> @endif
                    @if($recipe->price_level) <span>💶 Kaina: {{ $recipe->price_level }}</span> @endif
                </div>
            </div>

            <div class="bg-gray-900 border border-gray-800 p-6 rounded shadow">
                <h3 class="font-semibold text-lg mb-3 text-gray-100">Gaminimas</h3>
                <div class="prose prose-invert max-w-none">
                    {!! nl2br(e($recipe->instructions)) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
