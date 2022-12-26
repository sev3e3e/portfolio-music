@once

    @push('stylesheets')
        @vite(['resources/css/index.tailwind.css'])
    @endpush

    @push('scripts')
        @vite(['resources/js/index.js', 'resources/js/modal.js'])
    @endpush
@endonce

<x-app-layout>

    <body>
        <div id="background"
            class="flex flex-col w-full h-full min-h-screen sm:max-h-[calc(100vh_-_10rem)] sm:min-h-[calc(100vh_-_10rem)]  place-content-center  place-items-center text-white justify-center items-center">
            <video id="bg-video" preload="auto"
                class="absolute object-cover top-0 left-0 w-full h-full -z-10 bg-no-repeat brightness-75 blur-[1px]">
                {{-- <source id="bg-source" src={{ $movieSrc }}> --}}
                <source id="bg-source">
            </video>
            <audio id="audio">
                {{-- <source id="audio-source" src={{ $songSrc }} type="audio/mp3"> --}}
                <source id="audio-source">
            </audio>

            <div
                class="flex flex-col  bg-black bg-opacity-20 backdrop-blur-lg rounded drop-shadow-md sm:p-10 p-3 min-h-screen sm:min-h-full min-w-full sm:min-w-min">
                <div class="flex pb-3 gap-1 items-center justify-start">
                    <svg class="sm:w-20 sm:h-20 w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="butt " stroke-linejoin="butt " stroke-width="2"
                            d="M4 6h16M4 10h16M4 14h16M4 18h16">
                        </path>
                    </svg>
                    <h1 class="text-4xl sm:text-5xl tracking-tighter">
                        Portfolio music
                    </h1>
                </div>

                <div class="flex flex-col items-end w-full">
                    <h2 id="playingStatus" class="hidden text-4xl tracking-tighter p-2">next song is...</h2>
                    <p id="playingMusicName" class="text-3xl sm:text-5xl tracking-tighter py-2"></p>
                </div>
                <div class="flex flex-col items-end">

                </div>

                <div class="flex flex-col items-end w-full h-full">
                    <div class="flex gap-1 items-end">
                        <p class="text-lg">from</p>
                        <p id="creator" class=text-3xl></p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center p-0 m-0 gap-5">

                    <div class="flex items-center p-0 m-0 gap-3 sm:gap-1">
                        <button id="prevButton" class="opacity-10 cursor-default">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-14 h-14 sm:w-8 sm:h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953l7.108-4.062A1.125 1.125 0 0121 8.688v8.123zM11.25 16.811c0 .864-.933 1.405-1.683.977l-7.108-4.062a1.125 1.125 0 010-1.953L9.567 7.71a1.125 1.125 0 011.683.977v8.123z" />
                            </svg>
                        </button>
                        <button id="playButton">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-28 h-28 sm:w-20 sm:h-20">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.91 11.672a.375.375 0 010 .656l-5.603 3.113a.375.375 0 01-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112z" />
                            </svg>
                        </button>

                        <button id="pauseButton" hidden>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-28 h-28 sm:w-20 sm:h-20">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.25 9v6m-4.5 0V9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </button>

                        <button id="nextButton">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-14 h-14 sm:w-8 sm:h-8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062A1.125 1.125 0 013 16.81V8.688zM12.75 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062a1.125 1.125 0 01-1.683-.977V8.688z" />
                            </svg>
                        </button>
                    </div>
                    <div class="w-full sm:max-w-xl">
                        <input id="progress" type="range" value=0 min="0" max=""
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                    </div>
                </div>



                <div
                    class="flex flex-col gap-3 sm:flex-row sm:gap-2 justify-center items-center text-center tracking-wide py-10">
                    @auth
                    @else
                        <p class="text-center text-2xl sm:text-base">
                            Want to add music?

                        </p>
                        <a href="/register" class="uppercase font-bold text-lg underline ">Register</a>
                        <p>or</p>
                        <a href="/login" class="uppercase font-bold text-lg underline">Log in</a>
                    @endauth

                </div>
            </div>

            {{-- <input id="progress" type="range" value=0 min="0" max=""
                class="max-w-xl w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700 hidden"> --}}


        </div>
    </body>
</x-app-layout>
