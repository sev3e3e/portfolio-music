@once
    @push('scripts')
        @vite(['resources/js/modal.js'])
    @endpush
@endonce

<x-app-layout>

    <div class="py-12 flex justify-center items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg container">
                <h1 class="text-3xl sm:text-5xl p-4">Uploaded Songs</h1>
                <div class="p-2 text-gray-900 flex">

                    {{-- table --}}
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full flex flex-row sm:bg-white rounded-lg overflow-hidden sm:shadow-lg p-2">
                            {{-- <caption
                                class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                Uploaded Songs
                            </caption> --}}
                            {{-- <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 ">
                                <tr
                                    class="hidden flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                                    <th scope="col" class="py-3 px-6 ">
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
                            </thead> --}}
                            <tbody class="flex-1">
                                @foreach ($songs as $song)
                                    <div class="flex flex-col flex-nowrap  mb-2 sm:mb-0">
                                        <x-dashboard-table-item :song="$song" />
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stack('modal_preview_script')
</x-app-layout>
