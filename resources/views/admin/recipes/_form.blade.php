@php
    // patogūs default'ai create režimui
    $isEdit = !is_null($recipe);
    $oldCategory = old('category_id', $recipe->category_id ?? '');
@endphp

<div class="space-y-6">

    {{-- Kategorija --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kategorija</label>
        <select name="category_id" class="w-full border rounded px-3 py-2">
            <option value="">— Be kategorijos —</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected((string)$oldCategory === (string)$c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Pavadinimas --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Pavadinimas *</label>
        <input name="title" value="{{ old('title', $recipe->title ?? '') }}"
               class="w-full border rounded px-3 py-2" required />
        @error('title')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror

        @if($isEdit)
            <div class="text-sm text-gray-500 mt-1">Slug: <span class="font-mono">{{ $recipe->slug }}</span></div>
        @endif
    </div>

    {{-- Aprašymas --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Trumpas aprašymas</label>
        <textarea name="description" rows="3"
                  class="w-full border rounded px-3 py-2">{{ old('description', $recipe->description ?? '') }}</textarea>
        @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Instrukcijos --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Gaminimo instrukcijos</label>
        <textarea name="instructions" rows="8"
                  class="w-full border rounded px-3 py-2"
                  placeholder="1) ...&#10;2) ...">{{ old('instructions', $recipe->instructions ?? '') }}</textarea>
        @error('instructions')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- Meta --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Paruošimas (min)</label>
            <input type="number" name="prep_time" value="{{ old('prep_time', $recipe->prep_time ?? '') }}"
                   class="w-full border rounded px-3 py-2" />
            @error('prep_time')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Gaminimas (min)</label>
            <input type="number" name="cook_time" value="{{ old('cook_time', $recipe->cook_time ?? '') }}"
                   class="w-full border rounded px-3 py-2" />
            @error('cook_time')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Porcijos</label>
            <input type="number" name="servings" value="{{ old('servings', $recipe->servings ?? '') }}"
                   class="w-full border rounded px-3 py-2" />
            @error('servings')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sudėtingumas</label>
            <input name="difficulty" value="{{ old('difficulty', $recipe->difficulty ?? '') }}"
                   class="w-full border rounded px-3 py-2" placeholder="easy / medium / hard" />
            @error('difficulty')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kaina</label>
            <input name="price_level" value="{{ old('price_level', $recipe->price_level ?? '') }}"
                   class="w-full border rounded px-3 py-2" placeholder="€ / €€ / €€€" />
            @error('price_level')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- VIDEO --}}
    <div class="border-t pt-6 space-y-4">
        <div class="font-semibold text-gray-800">Video</div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Video URL (pvz. tiesioginis .mp4)</label>
            <input name="video_url" value="{{ old('video_url', $recipe->video_url ?? '') }}"
                   class="w-full border rounded px-3 py-2"
                   placeholder="https://.../video.mp4" />
            @error('video_url')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Įkelti video failą (mp4/webm/mov)</label>
            <input type="file" name="video_file" class="w-full" />
            @error('video_file')
                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
            <div class="text-sm text-gray-500 mt-1">Jei įkeli failą, jis bus rodomas iš storage.</div>
        </div>

        @if($isEdit && ($recipe->video_path || $recipe->video_url))
            @php
                $src = $recipe->video_path ? asset('storage/'.$recipe->video_path) : $recipe->video_url;
            @endphp

            <div class="space-y-2">
                <div class="text-sm font-medium text-gray-700">Dabartinis video:</div>
                <video src="{{ $src }}" controls class="w-full rounded border"></video>

                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remove_video" value="1" class="rounded border-gray-300">
                    Pašalinti video (URL ir failą)
                </label>
            </div>
        @endif
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-3">
        <button class="px-5 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
            {{ $submitLabel ?? 'Išsaugoti' }}
        </button>

        <a href="{{ route('admin.recipes.index') }}" class="px-5 py-2 border rounded hover:bg-gray-50">
            Atšaukti
        </a>
    </div>

</div>