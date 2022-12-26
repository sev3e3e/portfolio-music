@once
    @push('modal_preview_script')
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
    @endpush
@endonce

<tr class="flex flex-col mb-2 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <td scope="row" class="py-4 px-6 font-medium text-gray-900  dark:text-white">
        {{ $song->name }}
    </td>
    <td class="py-4 px-6 font-medium text-gray-900  dark:text-white">
        {{ $song->creators[0]->name }}
    </td>
    <td class="py-4 px-6 font-medium text-gray-900  dark:text-white">
        {{ $song->description }}
    </td>
    <td class="flex flex-col py-4 px-6 text-right">
        <x-primary-button data-micromodal-trigger="dashboard-edit-modal-{{ $song->id }}">
            Edit</x-primary-button>
        <x-micromodal id="dashboard-edit-modal-{{ $song->id }}">
            <x-slot name="header">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-12 h-12">
                        <path stroke="black" stroke-linecap="round" stroke-linejoin="round"
                            d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                    </svg>
                    <h3 class="text-xl font-medium tracking-wide text-gray-900 mt-1" id="modal-title">
                        Edit song</h3>
                </div>
            </x-slot>
            <x-slot name="body">
                <x-song-edit-micromodal :song="$song" method="PATCH" />
            </x-slot>
        </x-micromodal>
        <x-danger-button data-micromodal-trigger="dashboard-delete-modal-{{ $song->id }}">
            Delete
        </x-danger-button>
        <x-micromodal id="dashboard-delete-modal-{{ $song->id }}">
            <x-slot name="header">
                <div class="text-black flex gap-2 justify-start items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="black" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>Are you sure?</p>

                </div>
            </x-slot>
            <x-slot name="body">
                <div class="text-center text-black">
                    <div class="flex flex-col gap-3 p-3">
                        <div class="text-2xl">{{ $song->name }}</div>
                        <div class="text-xl">{{ $song->creators[0]->name }}</div>
                    </div>
                    <video id="previewMedia" class="mt-2 w-full" preload="metadata">
                        <source id="previewMediaSource" src={{ $song->movie_source }} />
                    </video>
                    <div class="bg-red-300 text-black text-lg">
                        <p>この動作は取り消せません。本当に削除しますか？</p>
                    </div>
                </div>
                <form action="/song/{{ $song->id }}" method="POST"
                    class="flex gap-3 justify-end items-center p-4">
                    @method('DELETE')
                    @csrf

                    {!! Form::hidden('id', $song->id) !!}

                    <x-secondary-button data-micromodal-close>Cancel</x-secondary-button>
                    <x-danger-button type="input">
                        Delete
                    </x-danger-button>
                </form>
            </x-slot>
        </x-micromodal>
    </td>
</tr>
