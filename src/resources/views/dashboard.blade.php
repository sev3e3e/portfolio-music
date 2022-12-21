@once
    @push('scripts')
        @vite(['resources/js/modal.js'])
    @endpush
@endonce

<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    {{-- table --}}
                    <script>
                        function tableToggle(id) {
                            document.getElementById(id).classList.toggle("hidden");
                        }
                    </script>
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <caption
                                class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                Uploaded Songs
                                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Browse a list of
                                    Flowbite products designed to help you work and play, stay organized, get answers,
                                    keep in touch, grow your business, and more.</p>
                            </caption>
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Song name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Creator
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Description
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($songs as $song)
                                    <x-dashboard-table-item :song="$song" />
                                @endforeach
                                @once

                                @endonce
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('modal_preview_script')
</x-app-layout>
