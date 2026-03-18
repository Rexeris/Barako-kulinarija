@php
    $isEdit = !is_null($recipe);
    $oldCategory = old('category_id', $recipe->category_id ?? '');
@endphp

<div class="space-y-6 text-gray-100">

    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Kategorija</label>
        <select name="category_id" class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2">
            <option value="">— Be kategorijos —</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected((string)$oldCategory === (string)$c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Pavadinimas *</label>
        <input name="title" value="{{ old('title', $recipe->title ?? '') }}"
               class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2" required />
        @error('title')
            <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
        @enderror

        @if($isEdit)
            <div class="text-sm text-gray-400 mt-1">Slug: <span class="font-mono">{{ $recipe->slug }}</span></div>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Trumpas aprašymas</label>
        <textarea name="description" rows="3"
                  class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2">{{ old('description', $recipe->description ?? '') }}</textarea>
        @error('description')
            <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-300 mb-1">Gaminimo instrukcijos</label>
        <textarea name="instructions" rows="8"
                  class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2"
                  placeholder="1) ...&#10;2) ...">{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
        @error('instructions')
            <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Paruošimas (min)</label>
            <input type="number" name="prep_time" value="{{ old('prep_time', $recipe->prep_time ?? '') }}"
                   class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2" />
            @error('prep_time')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Gaminimas (min)</label>
            <input type="number" name="cook_time" value="{{ old('cook_time', $recipe->cook_time ?? '') }}"
                   class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2" />
            @error('cook_time')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Porcijos</label>
            <input type="number" name="servings" value="{{ old('servings', $recipe->servings ?? '') }}"
                   class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2" />
            @error('servings')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Sudėtingumas</label>
            <input name="difficulty" value="{{ old('difficulty', $recipe->difficulty ?? '') }}"
                   class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2" placeholder="easy / medium / hard" />
            @error('difficulty')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Kaina</label>
            <input name="price_level" value="{{ old('price_level', $recipe->price_level ?? '') }}"
                   class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2" placeholder="€ / €€ / €€€" />
            @error('price_level')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="border-t border-gray-800 pt-6 space-y-4">
        <div class="font-semibold text-gray-100">Video</div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Video URL (pvz. tiesioginis mp4)</label>
            <input name="video_url" value="{{ old('video_url', $recipe->video_url ?? '') }}"
                   class="w-full border border-gray-700 bg-gray-900 text-gray-100 rounded px-3 py-2"
                   placeholder="https://.../video.mp4" />
            @error('video_url')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Įkelti video failą (mp4/webm/mov)</label>
            <input type="file" name="video_file" class="w-full text-gray-200" />
            @error('video_file')
                <div class="text-pink-300 text-sm mt-1">{{ $message }}</div>
            @enderror
            <div class="text-sm text-gray-400 mt-1">Jei įkeli failą, jis bus rodomas iš storage.</div>
        </div>

        @if($isEdit && ($recipe->video_path || $recipe->video_url))
            @php
                $src = $recipe->video_path ? asset('storage/'.$recipe->video_path) : $recipe->video_url;
            @endphp

            <div class="space-y-2">
                <div class="text-sm font-medium text-gray-300">Dabartinis video:</div>
                @php
    $src = $recipe->video_path ? asset('storage/'.$recipe->video_path) : ($recipe->video_url ?: null);

    $youtubeId = null;
    if ($src) {
        // youtube.com/watch?v=ID arba youtu.be/ID
        if (preg_match('~(?:youtube\.com/watch\?v=|youtu\.be/)([A-Za-z0-9_-]{6,})~', $src, $m)) {
            $youtubeId = $m[1];
        }
    }
@endphp

@if($src)
    <div class="space-y-2">
        <div class="text-sm font-medium text-gray-300">Dabartinis video:</div>

        @if($youtubeId)
            <div class="aspect-video w-full rounded border border-gray-800 overflow-hidden">
                <iframe
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/{{ $youtubeId }}"
                    title="YouTube video"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
        @else
            <video src="{{ $src }}" controls playsinline class="w-full rounded border border-gray-800"></video>
        @endif

        <label class="inline-flex items-center gap-2 text-sm text-gray-300">
            <input type="checkbox" name="remove_video" value="1" class="rounded border-gray-600 bg-gray-900">
            Pašalinti video (URL ir failą)
        </label>
    </div>
@endif

                <label class="inline-flex items-center gap-2 text-sm text-gray-200">
                    <input type="checkbox" name="remove_video" value="1" class="rounded border-gray-700 bg-gray-900 text-pink-600 focus:ring-pink-500">
                    Pašalinti video (URL ir failą)
                </label>
            </div>
        @endif
    </div>

    <div class="flex items-center gap-3">
        <button class="px-5 py-2 bg-pink-600 text-white rounded hover:bg-pink-500">
            {{ $submitLabel ?? 'Išsaugoti' }}
        </button>

        <a href="{{ route('admin.recipes.index') }}" class="px-5 py-2 border border-gray-700 rounded hover:bg-gray-950 text-gray-100">
            Atšaukti
        </a>
    </div>

</div>
