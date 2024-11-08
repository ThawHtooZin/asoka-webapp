<x-layout>
    <div class="container mx-auto p-6">
        <!-- Grid layout for main content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Course Image (spans 2 columns on large screens) -->
            <div class="lg:col-span-2">
                <div class="relative w-full h-[400px]">
                    <img src="{{ asset($course->image) }}" alt="{{ $course->name }}"
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 object-contain max-w-full max-h-full" />
                </div>

                <!-- Description Section -->
                <div class="border-4 border-gray-200 rounded-lg p-6 overflow-hidden lg:col-span-2 mt-4">
                    <h3 class="text-xl font-semibold mb-4">Description</h3>
                    <p class="text-gray-700 break-words">{{ $course->description }}</p>
                </div>
            </div>

            <div>
                <!-- About Course Section -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-semibold mb-4">About Course</h2>
                    <p class="mb-2"><strong>Name:</strong> {{ $course->name }}</p>
                    <p class="mb-2"><strong>People Enrolled:</strong> {{ $course->enrolled }}</p>
                    <p class="mb-2"><strong>Duration:</strong> {{ $course->duration }}</p>
                    <p class="mb-2 text-green-500"><strong>Price:</strong>
                        @if ($course->price == 0)
                            {{ 'FREE' }}
                        @else
                            {{ $course->price }}
                        @endif
                    </p>
                </div>

                {{-- Start Learning --}}
                @if (!empty($chapters[0]->videos()->first()->id))
                    @if ($course->price == 0)
                        <a href="/courses/{{ $course->id }}/chapters/<?php if (!empty($chapters[0])) {
                            echo $chapters[0]->id;
                        } else {
                            echo 0;
                        } ?>/videos/<?php if (!empty($video->id)) {
                            echo $video->id;
                        } else {
                            echo 0;
                        } ?>"
                            class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-green-500 text-white hover:bg-green-400 hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                            Start Learning
                        </a>
                    @else
                        <a href="/courses/{{ $course->id }}/buy"
                            class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-primary text-white hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                            Start Learning
                        </a>
                    @endif
                @else
                    <a href="/"
                        class="w-full inline-block text-lg px-6 py-3 mt-4 rounded-lg shadow-md bg-primary text-white hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 text-center">
                        Start Learning
                    </a>
                @endif




                {{-- Course Chapter Section --}}
                <div class="bg-gray-100 rounded-lg p-6 overflow-hidden mt-4 shadow-lg">
                    <h4 class="text-lg font-semibold mb-4">Course Chapters:</h4>
                    <ul class="space-y-2">
                        {{-- Uncomment and replace with dynamic data --}}
                        @if (!empty($chapters))
                            @foreach ($chapters as $chapter)
                                <li class="py-2 px-4 border-2 bg-white rounded-lg"><a
                                        href="/courses/{{ $course->id }}/chapters/{{ $chapter->id }}/videos/@if (!empty($chapter->videos()->first()->id)) {{ $chapter->videos()->first()->id }} @endif">{{ $chapter->title }}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layout>
