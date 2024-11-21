<x-layout>
    <div class="grid grid-cols-5">
        <div></div>
        <div class="col-span-3 p-4">
            {{-- Header --}}
            <div class="grid grid-cols-6" id="ForumHeader">
                <div class="col-span-2"><a href="/" class="text-blue-800 font-bold hover:underline">Home</a> > <a
                        href="#" class="text-blue-800 font-bold hover:underline">Forums</a></div>
                <div class="col-span-2"></div>
                <div class="col-span-2 flex" id="Search Box">
                    <form action="" method="GET"
                        class="flex items-center border border-blue-300 rounded-lg bg-gradient-to-r from-blue-100 to-blue-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <input type="text" name="ask"
                            class="text-sm flex-grow px-3 py-1 rounded-l-lg text-gray-700 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                            placeholder="Search something..." id="">
                        <button
                            class="bg-blue-500 text-white rounded-r-lg p-2 hover:bg-blue-600 transition duration-300 ease-in-out">
                            <svg width="16" viewBox="0 0 15 15" class="text-grey-600">
                                <g fill="none" fill-rule="evenodd">
                                    <path d="M-2-2h20v20H-2z"></path>
                                    <path class="fill-current"
                                        d="M10.443 9.232h-.638l-.226-.218A5.223 5.223 0 0 0 10.846 5.6 5.247 5.247 0 1 0 5.6 10.846c1.3 0 2.494-.476 3.414-1.267l.218.226v.638l4.036 4.028 1.203-1.203-4.028-4.036zm-4.843 0A3.627 3.627 0 0 1 1.967 5.6 3.627 3.627 0 0 1 5.6 1.967 3.627 3.627 0 0 1 9.232 5.6 3.627 3.627 0 0 1 5.6 9.232z">
                                    </path>
                                </g>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            {{-- Body --}}
            <div class="space-y-4">
                @foreach ($forums as $forum)
                    <div
                        class="border border-gray-200 rounded-lg p-4 shadow-md hover:shadow-lg transition duration-300">
                        <div class="flex justify-between items-center">
                            <!-- Post Info -->
                            <div>
                                <a href="/forum/1" class="text-blue-600 text-xl font-bold hover:underline">
                                    {{ $forum->title }}
                                </a>
                                <p class="p-2 text-gray-600">{{ Str::limit($forum->content, '200', '...') }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    Posted by <span class="font-medium">{{ $forum->user()->first()->name }}</span> on
                                    {{ date('M, d, Y', strtotime($forum->created_at)) }}
                                </p>
                            </div>
                            <!-- Stats -->
                            <div class="flex items-center space-x-4 text-gray-500">
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15" />
                                    </svg>
                                    <span>{{ $forum->comments()->count() }}</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                    <span>0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Add more Post Cards similarly -->
            </div>
        </div>
        <div></div>
    </div>
</x-layout>
