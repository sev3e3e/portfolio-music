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

<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
    <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        {{ $song->name }}
    </th>
    <td class="py-4 px-6">
        {{ $song->creators[0]->name }}
    </td>
    <td class="py-4 px-6">
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
        <script>
            function t_modal_{{ $song->id }}() {
                document.getElementById("song-item-{{ $song->id }}").classList.toggle("hidden")
            }
        </script>
        <x-danger-button onclick='t_modal_{{ $song->id }}()'>
            Delete
        </x-danger-button>

        {{-- <x-js-modal id="song-item-{{ $song->id }}">
            <video class="max-w-2xl max-h-max" src="{{ $song->movie_source }}" controls></video>
        </x-js-modal> --}}
    </td>
</tr>
