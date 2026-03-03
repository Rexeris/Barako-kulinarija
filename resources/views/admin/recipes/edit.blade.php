<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Redaguoti: {{ $recipe->title }}</h2>
            <a href="{{ route('admin.recipes.index') }}" class="underline">← Atgal</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 space-y-4">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('admin.recipes.update', $recipe) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @include('admin.recipes._form', [
                        'recipe' => $recipe,
                        'categories' => $categories,
                        'submitLabel' => 'Išsaugoti'
                    ])
                </form>
            </div>

            <div class="bg-white shadow rounded p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-semibold">Pavojinga zona</div>
                        <div class="text-sm text-gray-600">Ištrins receptą (ir įkeltą video, jei buvo).</div>
                    </div>

                    <form method="POST" action="{{ route('admin.recipes.destroy', $recipe) }}"
                          onsubmit="return confirm('Tikrai ištrinti?');">
                        @csrf
                        @method('DELETE')
                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Ištrinti
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>