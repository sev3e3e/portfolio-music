@props(['id' => 'modal', 'routename' => 'song.patch', 'method' => 'PATCH', 'song' => null, 'creators' => []])



<div class="mt-4 dark:text-white text-black">
    <form action="/song/{{ $song->id }}" method="POST" enctype="multipart/form-data" class="flex flex-col  gap-3">
        @method("$method")
        @csrf
        {!! Form::hidden('id', $song->id) !!}
        <div>
            <x-input-label for="songName" :value="__('songName')" />
            <x-text-input id="songName" class="block mt-1 w-full" type="text" name="songName" required
                :value="(old('songName') ? old('songName') : isset($song)) ? $song->name : ''" />
            <x-input-error :messages="$errors->get('songName')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="songCreator" :value="__('songCreator')" />
            <x-text-input id="songCreator" name="creator" list="creators" autocomplete="on" class="block mt-1 w-full"
                type="search" required :value="(old('songCreator') ? old('songCreator') : isset($song)) ? $song->creators[0]->name : ''" />

            <datalist id="creators">
                @foreach ($creators as $creator)
                    <option value="{{ $creator->name }}">
                @endforeach
            </datalist>
            <x-input-error :messages="$errors->get('songCreator')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="songDesc" :value="__('songDesc')" />
            <x-text-input id="songDesc" class="block mt-1 w-full" type="text" name="songDesc" :value="(old('songDesc') ? old('songDesc') : isset($song)) ? $song->description : ''" />
            <x-input-error :messages="$errors->get('songDesc')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="songAudio" :value="__('songAudio')" />
            <x-text-input accept="audio/mp3" id="songAudio" class="block mt-1 w-full" type="file" name="songAudio"
                :value="old('songAudio') ? old('songAudio') : ''" />
            <x-input-error :messages="$errors->get('songAudio')" class="mt-2" />
            <audio id="previewAudio" class="mt-2 w-full" controls>
                <source src={{ $song->audio_source }}>
            </audio>
        </div>

        <div>
            <x-input-label for="songMedia" :value="__('songMedia')" />
            <x-text-input accept="video/mp4" id="songMedia" class="block mt-1 w-full" type="file" name="songMedia"
                :value="old('songMedia') ? old('songMedia') : ''" />

            {{-- <x-input-error :messages="$errors->get('songMedia')" class="mt-2" /> --}}
            <video id="previewMedia" class="mt-2 w-full" controls>
                <source id="previewMediaSource" src={{ $song->movie_source }} />
            </video>
            <ul id="song-media-errors" class="text-sm text-red-600 space-y-1">

            </ul>
        </div>
        <div class="sm:flex">
            {{-- <x-primary-button /> --}}
            <button id="modalAdd" type="input"
                class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Add</button>
            <button id="modalCancel" type="button"
                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                data-micromodal-close>Cancel</button>
        </div>
    </form>
</div>
