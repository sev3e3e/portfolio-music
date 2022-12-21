<div class="flex w-full items-center justify-center">
    <!-- new card -->
    <div class="group relative flex h-[12rem] w-[50rem] overflow-hidden rounded-2xl bg-[#3a4448]">
        <!-- buttons right side -->
        <aside class="absolute right-0 flex h-full flex-col justify-center space-y-8 p-3">
            <!-- like icon -->
            {{-- <svg class="invisible h-7 w-7 text-stone-200 opacity-0 transition-all duration-200 hover:scale-[120%] hover:text-white group-hover:visible group-hover:opacity-100"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                </path>
            </svg> --}}
            <svg class="invisible h-7 w-7 text-stone-200 opacity-0 transition-all duration-200 hover:scale-[120%] hover:text-white group-hover:visible group-hover:opacity-100"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                    clip-rule="evenodd" />
            </svg>



            <!-- download icon -->
            {{-- <svg class="invisible h-7 w-7 text-stone-200 opacity-0 transition-all duration-200 hover:scale-[120%] hover:text-white group-hover:visible group-hover:opacity-100"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg> --}}
            <svg class="invisible h-7 w-7 text-stone-200 opacity-0 transition-all duration-200 hover:scale-[120%] hover:text-white group-hover:visible group-hover:opacity-100"
                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                <path
                    d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
            </svg>

        </aside>

        <!-- image (left side) -->
        <div class="absolute inset-y-0 left-0 w-48">
            <video src="{{ $song->movieSrc }}" preload="metadata" alt=""
                class="h-full w-full object-cover object-center opacity-95">
            </video>

            <div
                class="invisible absolute inset-0 flex h-full w-full items-center justify-center bg-[#0c0c0c]/70 opacity-0 transition-all duration-200 group-hover:visible group-hover:opacity-100">
                <svg class="h-w-14 w-14 cursor-pointer text-white transition-all duration-200 hover:text-yellow-400"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>

        <!-- right side -->
        <div
            class="absolute inset-y-0 left-44 w-[39rem] overflow-hidden rounded-2xl transition-all duration-200 group-hover:w-[36rem]">
            <!-- background image -->
            {{-- <div style="background-image: url('https://unsplash.it/id/1/640/425')"
                class="h-full w-full bg-cover bg-center">
                <div class="h-full w-full bg-[#455055]/80 transition-all duration-200 group-hover:bg-[#31383b]/80">
                </div>
            </div> --}}
            <div class="h-full w-full brightness-50 transition-all duration-200 group-hover:brightness-25">
                <video src="{{ $song->movieSrc }}" preload="metadata" alt=""
                    class="h-full w-full object-cover bg-cover bg-center">

                </video>
            </div>


            <!-- content -->
            <section class="absolute inset-0 flex flex-col justify-between p-4 text-white">
                <header class="space-y-1">
                    <div class="text-3xl font-medium">{{ $song->name }}</div>
                    <div class="font-medium text-2xl">
                        by {{ $song->creators[0]->name }}
                    </div>
                    <div class="text-lg">
                        uploaded by
                        <a href="#"
                            class="text-[#96bacc] transition-all hover:text-yellow-400">{{ Auth::user()->name }}</a>
                    </div>
                </header>
                {{--
                <div
                    class="invisible flex space-x-3 opacity-0 transition-all duration-200 group-hover:visible group-hover:opacity-100">
                    <span class="flex items-center space-x-1">
                        <!-- liked icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                        <div>33</div>
                    </span>

                    <!-- played icon -->
                    <span class="flex items-center space-x-1">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>75.7k</div>
                    </span>

                    <!-- verified icon -->
                    <span class="flex items-center space-x-1">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>25 Mar 2022</div>
                    </span>
                </div> --}}
            </section>
        </div>
    </div>
</div>
