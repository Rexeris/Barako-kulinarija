<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Naujas receptas</h2>
            <a href="{{ route('admin.recipes.index') }}" class="underline">← Atgal</a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white shadow rounded p-6">
                <form method="POST" action="{{ route('admin.recipes.store') }}" enctype="multipart/form-data">
                    @csrf

                    @include('admin.recipes._form', [
                        'recipe' => null,
                        'categories' => $categories,
                        'submitLabel' => 'Sukurti'
                    ])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>