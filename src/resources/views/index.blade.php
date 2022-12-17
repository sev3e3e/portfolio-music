<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portfolio Music</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    @vite(['resources/css/app.css', 'resources/js/index.js'])

</head>

<body class="antialiased">
    <div id="background" class="flex flex-col min-h-screen place-content-center  place-items-center text-white">
        <video id="bg-video" preload="auto"
            class="absolute object-cover top-0 left-0 w-full h-full -z-10 bg-no-repeat brightness-75 blur-[1px]">
            <source src={{ $movieSrc }}>
        </video>
        <audio id="audio">
            <source src={{ $songSrc }} type="audio/mp3">
        </audio>

        <div class="bg-black bg-opacity-20 backdrop-blur-lg rounded drop-shadow-md p-10">
            <div class="flex items-center">
                <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="butt " stroke-linejoin="butt " stroke-width="2"
                        d="M4 6h16M4 10h16M4 14h16M4 18h16">
                    </path>
                </svg>
                <h1 class="text-7xl tracking-tighter">
                    Portfolio-music
                </h1>
            </div>

            <div class="flex flex-col items-end">
                <h2 id="playingStatus" class="text-4xl tracking-tighter p-2">next song is...</h2>
            </div>
            <div class="flex flex-col items-end">
                {{-- <p id="playingMusicName" class="text-4xl tracking-tighter py-2">{{ $song->name }}</p> --}}
                <p id="playingMusicName" class="text-4xl tracking-tighter py-2">{{ $song->name }}</p>
            </div>

            <div class="flex items-center p-0 m-0 gap-5">

                <div class="flex items-center p-0 m-0 gap-1">
                    <button id="prevButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953l7.108-4.062A1.125 1.125 0 0121 8.688v8.123zM11.25 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953L9.567 7.71a1.125 1.125 0 011.683.977v8.123z" />
                        </svg>
                    </button>
                    <button id="playButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                        </svg>
                    </button>

                    <button id="pauseButton" hidden>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-20 h-20">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                    </button>

                    <button id="nextButton">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062A1.125 1.125 0 013 16.81V8.688zM12.75 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062a1.125 1.125 0 01-1.683-.977V8.688z" />
                        </svg>
                    </button>
                </div>

                <input id="progress" type="range" value=0 min="0" max=""
                    class="max-w-xl w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
            </div>

            <div class="flex flex-col items-end">
                <div class="flex gap-1 items-end">
                    <p class="text-lg">from</p>
                    {{-- <p class=text-3xl>{{ $song->creator }}</p> --}}
                    <p id="creator" class=text-3xl>
                        {{ $song->creators()->first()->name }}
                    </p>
                </div>
            </div>
        </div>

        <input id="progress" type="range" value=0 min="0" max=""
            class="max-w-xl w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 hidden">

        <div class="m-3 tracking-wide">
            @auth
                <div id="modal" class="hidden relative z-10" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true" data-transition-enter="ease-out duration-300" data-transition-enter-start="opacity-0"
                    data-transition-enter-end="opacity-100" data-transition-leave="ease-in duration-200"
                    data-transition-leave-start="opacity-100" data-transition-leave-end="opacity-0">
                    <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"></div>

                    <div class="fixed inset-0 z-10 overflow-y-auto">
                        <div id="modalpanel"
                            class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0"
                            data-transition-enter="ease-out duration-300"
                            data-transition-enter-start="opacity-0 translate-y-4"
                            data-transition-enter-end="opacity-100 translate-y-0 sm:scale-100"
                            data-transition-leave="ease-in duration-200"
                            data-transition-leave-start="opacity-100 translate-y-0 sm:scale-100"
                            data-transition-leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <div
                                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                            <path stroke="black" stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                                        </svg>
                                        <h3 class="text-xl font-medium tracking-wide text-gray-900 mt-1" id="modal-title">
                                            Add song</h3>
                                    </div>

                                    <div class="mt-4 ">
                                        <form action="{{ route('songs.store') }}" method="POST"
                                            enctype="multipart/form-data" class="flex flex-col text-black gap-3">
                                            @csrf

                                            <div>
                                                <x-input-label for="songName" :value="__('songName')" />
                                                <x-text-input id="songName" class="block mt-1 w-full" type="text"
                                                    name="songName" :value="old('songName')" required autofocus />
                                                <x-input-error :messages="$errors->get('songName')" class="mt-2" />
                                            </div>
                                            <div>
                                                <x-input-label for="songCreator" :value="__('songCreator')" />
                                                <x-text-input id="songCreator" class="block mt-1 w-full" type="text"
                                                    name="songCreator" :value="old('songCreator')" required />
                                                <x-input-error :messages="$errors->get('songCreator')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="songDesc" :value="__('songDesc')" />
                                                <x-text-input id="songDesc" class="block mt-1 w-full" type="text"
                                                    name="songDesc" :value="old('songDesc')" required />
                                                <x-input-error :messages="$errors->get('songDesc')" class="mt-2" />
                                            </div>

                                            <div>
                                                <x-input-label for="songAudio" :value="__('songAudio')" />
                                                <x-text-input accept="audio/*" id="songAudio" class="block mt-1 w-full"
                                                    type="file" name="songAudio" :value="old('songAudio')" required />
                                                <x-input-error :messages="$errors->get('songAudio')" class="mt-2" />
                                                <audio id="previewAudio" class="mt-2 w-full"></audio>
                                            </div>

                                            <div>
                                                <x-input-label for="songMedia" :value="__('songMedia')" />
                                                <x-text-input accept="video/*" id="songMedia" class="block mt-1 w-full"
                                                    type="file" name="songMedia" :value="old('songMedia')" required
                                                    autofocus />

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
                                                {{-- <button id="modalCancel" type="button"
                              class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button> --}}
                                            </div>
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full flex justify-center py-12" id="button">
                    <button id="modalopener"
                        class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 mx-auto transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm">Open
                        Modal</button>
                </div>
            @else
                <p>
                    Want to add music? Click <a href="/login" class="uppercase font-bold text-lg underline">here</a> to
                    Signin or Signup.
                </p>
            @endauth

        </div>
    </div>
</body>

{{-- <script src="{{ Vite::asset('resources/js/index.js') }}"></script> --}}

</html>
