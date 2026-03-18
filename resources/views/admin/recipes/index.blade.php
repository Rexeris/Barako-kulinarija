<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">Admin / Receptai</h2>
            <a href="{{ route('admin.recipes.create') }}"
               class="inline-flex items-center px-4 py-2 bg-pink-600 text-white rounded hover:bg-pink-500">
                + Naujas receptas
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 space-y-4">

            @if (session('status'))
                <div class="bg-green-900/30 border border-green-800 text-green-200 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-gray-900 border border-gray-800 shadow rounded">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-950 text-gray-300">
                            <tr>
                                <th class="text-left px-4 py-3">Pavadinimas</th>
                                <th class="text-left px-4 py-3">Kategorija</th>
                                <th class="text-left px-4 py-3">Video</th>
                                <th class="text-right px-4 py-3">Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse($recipes as $r)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-100">{{ $r->title }}</div>
                                        <div class="text-gray-400 font-mono text-xs">/{{ $r->slug }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-gray-200">
                                        {{ $r->category?->name ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-200">
                                        @if($r->video_path || $r->video_url)
                                            ✅
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.recipes.edit', $r) }}"
                                           class="inline-flex px-3 py-2 border border-gray-700 rounded hover:bg-gray-950 text-gray-100">
                                            Redaguoti
                                        </a>

                                        <a href="{{ route('recipes.show', $r->slug) }}"
                                           class="inline-flex px-3 py-2 border border-gray-700 rounded hover:bg-gray-950 text-gray-100 ml-2">
                                            Peržiūra
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-6 text-gray-300" colspan="4">
                                        Kol kas nėra receptų. Sukurk pirmą.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="px-4 py-4">
                    {{ $recipes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
