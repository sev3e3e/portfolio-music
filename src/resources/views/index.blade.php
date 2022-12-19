<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Portfolio Music</title>

    <!-- Fonts -->
    {{-- <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/js/index.js'])
    @auth
        @vite(['resources/js/modal.js'])
    @endauth

</head>

<body class="antialiased">
    <div id="background" class="flex flex-col min-h-screen place-content-center  place-items-center text-white">
        <video id="bg-video" preload="auto"
            class="absolute object-cover top-0 left-0 w-full h-full -z-10 bg-no-repeat brightness-75 blur-[1px]">
            {{-- <source id="bg-source" src={{ $movieSrc }}> --}}
            <source id="bg-source">
        </video>
        <audio id="audio">
            {{-- <source id="audio-source" src={{ $songSrc }} type="audio/mp3"> --}}
            <source id="audio-source">
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
                <p id="playingMusicName" class="text-4xl tracking-tighter py-2"></p>
            </div>

            <div class="flex items-center p-0 m-0 gap-5">

                <div class="flex items-center p-0 m-0 gap-1">
                    <button id="prevButton" class="opacity-10 cursor-default">
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
                        {{-- {{ $song->creators()->first()->name }} --}}
                    </p>
                </div>
            </div>
        </div>

        <input id="progress" type="range" value=0 min="0" max=""
            class="max-w-xl w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 hidden">

        <div class="m-3 tracking-wide">
            @auth
                <x-add-song-modal :creators="$creators" />
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
