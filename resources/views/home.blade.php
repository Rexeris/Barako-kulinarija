<x-app-layout>
    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 space-y-8">

            <section class="rounded-2xl border border-gray-800 bg-gray-900 p-8">
                <h1 class="text-3xl font-bold text-gray-100">Barako kulinarija 🍲</h1>
                <p class="mt-2 text-gray-300">
                    Greiti, pigūs ir skanūs receptai studentui.
                </p>

                <form method="GET" action="{{ route('recipes.index') }}" class="mt-6 flex gap-2">
                    <input name="q" placeholder="Ieškok recepto..."
                           class="w-full rounded border border-gray-700 bg-gray-950 text-gray-100 placeholder-gray-400 px-4 py-3" />
                    <button class="px-5 py-3 rounded bg-pink-600 hover:bg-pink-500 text-white font-semibold">
                        Ieškoti
                    </button>
                </form>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('recipes.index') }}"
                       class="px-5 py-2 rounded border border-gray-700 hover:bg-gray-800 text-gray-100">
                        Visi receptai →
                    </a>
                    @auth
                        <a href="{{ route('admin.recipes.index') }}"
                           class="px-5 py-2 rounded border border-gray-700 hover:bg-gray-800 text-gray-100">
                            Admin →
                        </a>
                    @endauth
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-100">Naujausi receptai</h2>
                    <a class="text-pink-400 hover:text-pink-300 underline" href="{{ route('recipes.index') }}">
                        Visi →
                    </a>
                </div>

                @if($latestRecipes->isEmpty())
                    <div class="rounded border border-gray-800 bg-gray-900 p-6 text-gray-300">
                        Kol kas nėra receptų.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($latestRecipes as $r)
                            <a href="{{ route('recipes.show', $r->slug) }}"
                               class="rounded-xl border border-gray-800 bg-gray-900 p-5 hover:bg-gray-800 transition">
                                <div class="text-sm text-gray-400">{{ $r->category?->name ?? '—' }}</div>
                                <div class="mt-2 text-lg font-semibold text-gray-100">{{ $r->title }}</div>
                                <div class="mt-2 text-gray-300">
                                    {{ \Illuminate\Support\Str::limit($r->description ?? '', 110) }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>

        </div>
    </div>
</x-app-layout>