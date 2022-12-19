<div id="modal" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    data-transition-enter="ease-out duration-300" data-transition-enter-start="opacity-0"
    data-transition-enter-end="opacity-100" data-transition-leave="ease-in duration-200"
    data-transition-leave-start="opacity-100" data-transition-leave-end="opacity-0">
    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div id="modalpanel" class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
            data-transition-enter="ease-out duration-300" data-transition-enter-start="opacity-0 translate-y-4"
            data-transition-enter-end="opacity-100 translate-y-0 sm:scale-100"
            data-transition-leave="ease-in duration-200"
            data-transition-leave-start="opacity-100 translate-y-0 sm:scale-100"
            data-transition-leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-12 h-12">
                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                        <h3 class="text-xl font-medium tracking-wide text-gray-900 mt-1" id="modal-title">
                            Add song</h3>
                    </div>

                    <div class="mt-4 ">
                        <form action="{{ route('songs.store') }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-col text-black gap-3">
                            @csrf

                            <div>
                                <x-input-label for="songName" :value="__('songName')" />
                                <x-text-input id="songName" class="block mt-1 w-full" type="text" name="songName"
                                    :value="old('songName')" required autofocus />
                                <x-input-error :messages="$errors->get('songName')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="songCreator" :value="__('songCreator')" />
                                <x-text-input id="songCreator" name="creator" list="creators" autocomplete="on"
                                    class="block mt-1 w-full" type="search" :value="old('songCreator')" required />

                                <datalist id="creators">
                                    @foreach ($creators as $creator)
                                        <option value="{{ $creator->name }}">
                                    @endforeach
                                </datalist>
                                <x-input-error :messages="$errors->get('songCreator')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="songDesc" :value="__('songDesc')" />
                                <x-text-input id="songDesc" class="block mt-1 w-full" type="text" name="songDesc"
                                    :value="old('songDesc')" required />
                                <x-input-error :messages="$errors->get('songDesc')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="songAudio" :value="__('songAudio')" />
                                <x-text-input accept="audio/mp3" id="songAudio" class="block mt-1 w-full" type="file"
                                    name="songAudio" :value="old('songAudio')" required />
                                <x-input-error :messages="$errors->get('songAudio')" class="mt-2" />
                                <audio id="previewAudio" class="mt-2 w-full"></audio>
                            </div>

                            <div>
                                <x-input-label for="songMedia" :value="__('songMedia')" />
                                <x-text-input accept="video/mp4" id="songMedia" class="block mt-1 w-full" type="file"
                                    name="songMedia" :value="old('songMedia')" required autofocus />

                                {{-- <x-input-error :messages="$errors->get('songMedia')" class="mt-2" /> --}}
                                <video id="previewMedia" class="mt-2 w-full">
                                    <source id="previewMediaSource" />
                                </video>
                                <ul id="song-media-errors" class="text-sm text-red-600 space-y-1">

                                </ul>
                            </div>
                            <div class="sm:flex sm:flex-row-reverse">
                                {{-- <x-primary-button /> --}}
                                <button id="modalAdd" type="input"
                                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">Add</button>
                                <button id="modalCancel" type="button"
                                    class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
