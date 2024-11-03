<x-layout>
    <div class="flex min-h-screen bg-asokablue text-white">

        <!-- Main Content for Video Player on the Right -->
        <main class="flex-1 p-8 bg-white text-gray-900">
            <h1 class="text-3xl font-semibold mb-4">{{ $video->title }}</h1>
            <div class="aspect-w-16 aspect-h-9 bg-black rounded-md overflow-hidden border border-gray-300 shadow-md">
                <video controls class="w-60 mx-auto" loop>
                    <source src="{{ asset($video->video_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            <p class="mt-4 text-gray-600">
                {{ $video->description ?? 'No description available for this video.' }}
            </p>
        </main>

        <!-- Sidebar for Chapters on the Left -->
        <aside class="w-1/3 bg-asokablue text-white p-4 h-screen shadow-lg overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6 border-b border-gray-300 pb-2">Course Chapters</h2>
            <ul>
                @foreach ($chapters as $chapter)
                    <li class="mb-4">
                        <h3 class="text-lg font-medium mb-2">{{ $chapter->title }}</h3>
                        <ul class="pl-4 space-y-2">
                            @foreach ($chapter->videos as $video)
                                <li>
                                    <a href="/course/{{ $course->id }}/chapter/{{ $chapter->id }}/video/{{ $video->id }}"
                                        class="text-sm block px-3 py-2 rounded-lg bg-gray-200 text-gray-900 hover:bg-gray-300 hover:shadow-md transition-all duration-200">
                                        {{ $video->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</x-layout>
