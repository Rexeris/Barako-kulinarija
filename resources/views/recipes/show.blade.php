<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">{{ $recipe->category?->name }}</div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $recipe->title }}</h2>
            </div>
            <a href="{{ route('recipes.index') }}" class="underline">← Atgal</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 space-y-6">
            <div class="bg-white p-6 rounded shadow">
                <p class="text-gray-700">{{ $recipe->description }}</p>
            </div>
                        @php
                $src = $recipe->video_path
                    ? asset('storage/' . $recipe->video_path)
                    : ($recipe->video_url ?: null);
            @endphp

            @if($src)
                <div class="bg-white p-4 rounded shadow">
                    <video class="w-full rounded" controls playsinline preload="metadata">
                        <source src="{{ $src }}">
                        Jūsų naršyklė nepalaiko video.
                    </video>
                </div>
            @endif
            <div class="bg-white p-6 rounded shadow">
                <h3 class="font-semibold text-lg mb-3">Gaminimas</h3>
                <div class="prose max-w-none">
                    {!! nl2br(e($recipe->instructions)) !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>