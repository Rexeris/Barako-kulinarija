<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin / Receptai</h2>
            <a href="{{ route('admin.recipes.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                + Naujas receptas
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 space-y-4">

            @if (session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow rounded">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="text-left px-4 py-3">Pavadinimas</th>
                                <th class="text-left px-4 py-3">Kategorija</th>
                                <th class="text-left px-4 py-3">Video</th>
                                <th class="text-right px-4 py-3">Veiksmai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($recipes as $r)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900">{{ $r->title }}</div>
                                        <div class="text-gray-500">/{{ $r->slug }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $r->category?->name ?? '—' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($r->video_path || $r->video_url)
                                            ✅
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right whitespace-nowrap">
                                        <a href="{{ route('admin.recipes.edit', $r) }}"
                                           class="inline-flex px-3 py-2 border rounded hover:bg-gray-50">
                                            Redaguoti
                                        </a>

                                        <a href="{{ route('recipes.show', $r->slug) }}"
                                           class="inline-flex px-3 py-2 border rounded hover:bg-gray-50 ml-2">
                                            Peržiūra
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-4 py-6 text-gray-600" colspan="4">
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