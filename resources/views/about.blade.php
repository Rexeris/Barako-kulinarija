<x-app-layout>
    <div class="py-10">
        <div class="max-w-5xl mx-auto px-4 space-y-6">

            <section class="rounded-2xl border border-gray-800 bg-gray-900 p-8">
                <h1 class="text-3xl font-bold text-gray-100">Apie mus</h1>
                <p class="mt-3 text-gray-300">
                    „Barako kulinarija“ – vieta, kur sudėta tai, ko dažniausiai reikia studentui:
                    greiti, pigūs ir skanūs receptai, minimalus ingredientų kiekis ir aiškūs žingsniai.
                </p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="rounded-xl border border-gray-800 bg-gray-950 p-5">
                        <div class="text-pink-400 font-semibold">🍝 Paprasta</div>
                        <div class="mt-2 text-gray-300">Receptai be „kosmoso“ – realiai pagaminami namuose.</div>
                    </div>
                    <div class="rounded-xl border border-gray-800 bg-gray-950 p-5">
                        <div class="text-pink-400 font-semibold">💶 Pigu</div>
                        <div class="mt-2 text-gray-300">Orientuojamės į biudžetą ir sezoniškus produktus.</div>
                    </div>
                    <div class="rounded-xl border border-gray-800 bg-gray-950 p-5">
                        <div class="text-pink-400 font-semibold">⏱ Greita</div>
                        <div class="mt-2 text-gray-300">Dauguma receptų tinka darbo dienai po paskaitų.</div>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-xl font-semibold text-gray-100">Ką rasi puslapyje?</h2>
                    <ul class="mt-3 list-disc pl-5 text-gray-300 space-y-1">
                        <li>Receptus su aiškiais žingsniais ir laikais.</li>
                        <li>Video receptus (kai yra).</li>
                        <li>Patarimus kaip sutaupyti ir gaminti paprasčiau.</li>
                    </ul>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="{{ route('recipes.index') }}"
                       class="px-5 py-2 rounded bg-pink-600 hover:bg-pink-500 text-white font-semibold">
                        Žiūrėti receptus
                    </a>
                    <a href="{{ route('home') }}"
                       class="px-5 py-2 rounded border border-gray-700 hover:bg-gray-800 text-gray-100">
                        Į pagrindinį
                    </a>
                </div>
            </section>

            <section class="rounded-2xl border border-gray-800 bg-gray-900 p-8">
                <h2 class="text-xl font-semibold text-gray-100">Kontaktai</h2>
                <p class="mt-3 text-gray-300">
                    Jei turi idėją receptui ar nori prisidėti – parašyk.
                </p>
                <div class="mt-3 text-gray-300">
                    El. paštas: <span class="text-pink-400">austeja2bosaite@gmail.com</span>
                </div>
                <img src="{{ asset('images/670065941_975642918744596_2396024560487758951_n.jpg') }}"
                alt="Mūsų komanda"
                class="w-full max-w-4xl mx-auto mt-6 rounded-2xl border border-gray-800 shadow">
                <p class="text-center text-sm text-gray-400 mt-2">
                    Mes
                </p>
            </section>
        </div>
    </div>
</x-app-layout>