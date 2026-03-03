<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Receptai</h2>

            <form method="GET" action="{{ route('recipes.index') }}" class="flex gap-2">
                <input name="q" value="{{ $q }}" placeholder="Ieškoti..."
                       class="border rounded px-3 py-2 w-64" />
                <button class="border rounded px-3 py-2">Ieškoti</button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            @if($recipes->count() === 0)
                <div class="bg-white p-6 rounded shadow">Kol kas nėra receptų.</div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($recipes as $r)
                        <a href="{{ route('recipes.show', $r->slug) }}"
                           class="bg-white p-4 rounded shadow hover:shadow-md transition">
                            <div class="text-sm text-gray-500">{{ $r->category?->name }}</div>
                            <div class="text-lg font-semibold mt-1">{{ $r->title }}</div>
                            <div class="text-gray-700 mt-2 line-clamp-3">{{ $r->description }}</div>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $recipes->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>