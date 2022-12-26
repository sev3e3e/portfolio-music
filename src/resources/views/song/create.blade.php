<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-xl font-medium text-gray-900">
                                {{ __('Add Song') }}
                            </h2>
                        </header>

                        <form action="{{ route('song.create') }}" method="POST" enctype="multipart/form-data"
                            class="flex flex-col gap-3">
                            @csrf
                            @method('POST')
                            <div>
                                <x-input-label for="song_name" :value="__('Name')" />
                                <x-text-input id="song_name" name="name" type="text" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->updatePassword->get('song_name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="song_creator" :value="__('Creator')" />
                                <x-text-input id="song_creator" name="creator" type="text"
                                    class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->updatesong_creator->get('song_creator')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="song_description" :value="__('Description')" />
                                <x-text-input id="song_description" name="description" type="text"
                                    class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->updatesong_creator->get('song_creator')" class="mt-2" />
                            </div>

                            <div class="border border-gray-300 rounded-lg shadow-md">
                                <div class="p-3">
                                    <x-input-label for="songAudio" :value="__('songAudio')" />
                                    <x-text-input accept="audio/mp3" id="songAudio" class="block mt-1 w-full"
                                        type="file" name="songAudio" :value="old('songAudio')" />
                                    <x-input-error :messages="$errors->get('songAudio')" class="mt-2" />
                                    <audio id="previewAudio" class="mt-2 w-full" controls>
                                        <source>
                                    </audio>
                                </div>
                            </div>

                            <div class="border border-gray-300 rounded-lg shadow-md">
                                <div class="p-3">
                                    <x-input-label for="songMedia" :value="__('songMedia')" />
                                    <x-text-input accept="video/mp4" id="songMedia" class="block mt-1 w-full"
                                        type="file" name="songMedia" :value="old('songMedia')" />

                                    {{-- <x-input-error :messages="$errors->get('songMedia')" class="mt-2" /> --}}
                                    <video id="previewMedia" class="mt-2 w-full" controls>
                                        <source id="previewMediaSource" src= />
                                    </video>
                                    <ul id="song-media-errors" class="text-sm text-red-600 space-y-1">

                                    </ul>
                                </div>
                            </div>

                            <x-danger-button type="submit">
                                {{ __('Add') }}</x-danger-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @once
        <script>
            var songAudio = document.getElementById("songAudio");
            var songMedia = document.getElementById("songMedia");

            songAudio.addEventListener("change", (e) => {
                var preview = document.getElementById("previewAudio");

                const file = songAudio.files[0];

                console.log(file);

                var reader = new FileReader();

                reader.addEventListener(
                    "load",
                    function() {
                        // 画像ファイルを base64 文字列に変換します
                        preview.src = reader.result;
                    },
                    false
                );

                if (file) {
                    preview.controls = true;
                    reader.readAsDataURL(file);
                }
            });

            songMedia.addEventListener("change", (e) => {
                var preview = document.getElementById("previewMedia");

                const file = songMedia.files[0];

                console.log(file);

                var reader = new FileReader();

                reader.addEventListener(
                    "load",
                    function() {
                        // 画像ファイルを base64 文字列に変換します
                        preview.src = reader.result;
                    },
                    false
                );

                if (file) {
                    preview.controls = true;
                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endonce
</x-app-layout>
